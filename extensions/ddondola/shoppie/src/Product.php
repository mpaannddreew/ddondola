<?php

namespace Shoppie;

use Activity\Traits\Reviewable;
use \Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Shoppie\Repository\ProductOfferRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\StockRepository;
use Shoppie\Traits\Identifier;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Product extends Model implements HasMedia
{
    use CanBeFavorited, Identifier, Reviewable, HasMediaTrait;

    protected $fillable = ['name', 'code', 'brand_id', 'subcategory_id', 'description', 'price', 'active', 'settings'];

    protected $casts = [
        'active' => 'bool',
        'settings' => 'array',
        'price' => 'integer'
    ];

    protected $appends = ['averageRating', 'reviewCount', 'firstImageUrl'];

    protected $hidden = ['media', 'reviews'];

    /**
     * Shop this product belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    /**
     * Category this product belongs to
     *
     * @return ProductCategory
     */
    public function category() {
        return $this->subCategory->category;
    }

    /**
     * SubCategory this product belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory() {
        return $this->belongsTo(ProductSubCategory::class, 'subcategory_id');
    }

    /**
     * Brand this product belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand() {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    /**
     * Carts currently holding this product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_product',
            'product_id', 'cart_id')->as('cartPivot')
            ->withTimestamps()->using(CartProduct::class)->withPivot(['quantity', 'price', 'id']);
    }

    /**
     * Offer about this product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers() {
        return $this->hasMany(ProductOffer::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stock() {
        return $this->hasMany(Stock::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function stockIn() {
        return $this->stock()->where('in', 1)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function stockOut() {
        return $this->stock()->where('out', 1)->get();
    }

    /**
     * Product quantity
     *
     * @return int
     */
    public function quantity() {
        return app(StockRepository::class)->quantity($this);
    }

    /**
     * Check if product has stock
     *
     * @return bool
     */
    public function hasStock() {
        return $this->quantity() > 0;
    }

    /**
     * Orders products has
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders() {
        return $this->belongsToMany(Order::class, 'order_product',
            'product_id', 'order_id')->as('orderPivot')
            ->withTimestamps()->using(OrderProduct::class)
            ->withPivot(['price', 'quantity', 'id', 'receipt_confirmed', 'delivery_confirmed', 'cancelled', 'cancelled_by']);
    }

    public function orderIds() {
        return $this->orders->pluck('id');
    }

    public function orderCount() {
        return $this->orders()->count();
    }

    /**
     * Active product offer
     *
     * @return ProductOffer|null
     */
    public function activeOffer() {
        return $this->offers->first(function (ProductOffer $offer) {
            return $offer->isActive();
        });
    }

    /**
     * Check if product has active offer
     *
     * @return bool
     */
    public function hasActiveOffer() {
        return !is_null($this->activeOffer());
    }

    /**
     * Compute product discount percentage
     *
     * @return int|mixed
     */
    public function discount() {
        if($this->hasActiveOffer()) {
            return $this->activeOffer()->discount;
        }

        if ($this->shop->settings('discount')) {
            return $this->shop->settings('discount');
        }

        return 0;
    }

    /**
     * Compute product discounted price
     *
     * @return float|int
     */
    public function discountedPrice() {
        return (int)$this->price - ($this->price * ((int)$this->discount()/100));
    }

    /**
     * Get setting item
     *
     * @param $item
     * @return mixed
     */
    public function settings($item) {
        return collect($this->settings)->get($item, '');
    }

    public function currencyCode() {
        return $this->shop->currencyCode();
    }

    /**
     * First product image url
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function firstImageUrl() {
        if(!$this->hasMedia('products'))
            return media_placeholder();

        return media_url($this->getFirstMedia('products'));
    }

    public function getFirstImageUrlAttribute()
    {
        return $this->firstImageUrl();
    }

    /**
     * Product images
     *
     * @return array
     */
    public function productImages() {
        if(!$this->hasMedia('products'))
            return [
                ['url' => media_placeholder()]
            ];

        return $this->getMedia('products')->map(function (Media $media) {
            return ['url' => media_url($media)];
        })->all();
    }
}
