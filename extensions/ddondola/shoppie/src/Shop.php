<?php

namespace Shoppie;

use Activity\Traits\Reviewable;
use Ddondola\Traits\Muddondozi;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Shoppie\Traits\Identifier;
use Laravolt\Avatar\Facade as Avatar;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Shop extends Model implements HasMedia
{
    use CanBeLiked, Identifier, Reviewable, Muddondozi, HasMediaTrait;

    protected $fillable = ['name', 'code', 'category_id', 'profile', 'settings', 'active'];

    protected $casts = [
        'profile' => 'array',
        'settings' => 'array',
        'active' => 'bool'
    ];

    protected $appends = ['averageRating', 'reviewCount', 'avatar', 'coverPicture', 'brandCount'];

    public function getAvatarAttribute() {
        return $this->avatar();
    }

    public function getCoverPictureAttribute() {
        return $this->coverPicture();
    }

    public function products() {
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function productIds() {
        return $this->products->pluck('id');
    }

    public function orderCount() {
        return $this->products()->has('orders')->get()->sum(function(Product $product) {
            return $product->orderCount();
        });
    }

    public function orderIds() {
        return $this->products()->has('orders')->get()->map(function(Product $product) {
            return $product->orderIds();
        })->flatten()->all();
    }

    public function orders() {
        return Order::query()->whereIn('id', $this->orderIds());
    }

    /**
     * Brands defined for this shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands() {
        return $this->hasMany(ProductBrand::class, 'shop_id');
    }

    /**
     * user that owns this shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(config('shoppie.seller'), 'user_id');
    }

    /**
     * Category shop belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(ShopCategory::class, 'category_id');
    }

    /**
     * Product categories this shop has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(ProductCategory::class, 'shop_id');
    }

    /**
     * Sub categories defined for this shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subcategories() {
        return $this->hasManyThrough(ProductSubCategory::class, ProductCategory::class, 'shop_id', 'category_id');
    }

    /**
     * @return int
     */
    public function categoriesCount() {
        return $this->categories()->count();
    }

    /**
     * @return int
     */
    public function subCategoriesCount() {
        return $this->subcategories()->count();
    }

    /**
     * @return int
     */
    public function productCount() {
        return $this->products()->count();
    }

    /**
     * @return int
     */
    public function brandCount() {
        return $this->brands()->count();
    }

    public function getBrandCountAttribute() {
        return $this->brandCount();
    }

    /**
     * @return int
     */
    public function likeCount() {
        return $this->likers->count();
    }

    public function avatar() {
        return [
            'url' => (string)Avatar::create($this->name)->toBase64()
        ];
    }

    public function coverPicture() {
        return [
            'url' => asset('/images/hero_in_shop_detail.jpg')
        ];
    }

    public function profile($item) {
        return collect($this->profile)->get($item, '');
    }

    public function settings($item) {
        return collect($this->settings)->get($item, '');
    }

    public function activeOffers() {
        return $this->products->filter(function (Product $product) {
            return $product->hasActiveOffer();
        });
    }

    public function currencyCode() {
        // todo think about letting owner choose own currency regardless of country
        return $this->owner->country->currencyCode();
    }

    public function contactIds() {
        return $this->likers->pluck('id');
    }
}
