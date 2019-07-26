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
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Product extends Model
{
    use CanBeFavorited, Identifier, Reviewable, HasMediaTrait;

    protected $fillable = ['name', 'code', 'brand_id', 'subcategory_id', 'description', 'price', 'active', 'settings'];

    protected $casts = [
        'active' => 'bool',
        'settings' => 'array'
    ];

    protected $appends = ['product_brand', 'product_category', 'product_sub_category', 'averageRating', 'reviewCount'];

    public function getProductBrandAttribute() {
        return $this->brand->name;
    }

    public function getProductCategoryAttribute() {
        return $this->category()->name;
    }

    public function getProductSubCategoryAttribute() {
        return $this->subCategory->name;
    }

    /**
     * Shop this product belongs to
     *
     * @return Shop
     */
    public function shop() {
        return $this->category()->shop;
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
     * Get stock for this product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stock() {
        return $this->hasMany(Stock::class, 'product_id');
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
     * Add stock to product
     *
     * @param $quantity
     * @param Model $by
     * @param null $note
     * @return Stock
     */
    public function addStock($quantity, $note = null, Model $by) {
        return app(StockRepository::class)->add($this, $quantity, $note, $by);
    }

    /**
     * Reduce stock of product
     *
     * @param $quantity
     * @param Model|null $by
     * @param null $note
     * @return Stock|null
     */
    public function subStock($quantity, $note = null, Model $by = null) {
        return app(StockRepository::class)->sub($this, $quantity, $note, $by);
    }

    /**
     * Product quantity
     *
     * @return int
     */
    public function quantity() {
        return $this->stock->sum(function (Stock $stock) {
            return $stock->isOut() ? -(int)$stock->quantity : (int)$stock->quantity;
        }) - $this->stockOut();
    }

    /**
     * Stock amount in carts
     *
     * @return int
     */
    public function stockInCarts() {
        return $this->carts->sum(function (Cart $cart) {
            return $cart->cartPivot->quantity;
        });
    }

    /**
     * Stock amount in orders
     *
     * @return int
     */
    public function stockInOrders() {
        return $this->orders->sum(function (Order $order) {
            // todo factor in cancelled orders
            return $order->orderPivot->quantity;
        });
    }

    /**
     * Sum stock in both carts and orders
     *
     * @return int
     */
    public function stockOut() {
        return $this->stockInCarts() + $this->stockInOrders();
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
     * Is product active
     *
     * @return bool
     */
    public function active() {
        return $this->hasStock();
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
            ->withPivot(['price', 'quantity', 'id', 'receipt_confirmed', 'delivery_confirmed']);
    }

    public function orderIds() {
        return $this->orders->pluck('id');
    }

    public function orderCount() {
        return $this->orders->count();
    }

    public function isPublished() {
        return $this->active;
    }

    /**
     * Publish product
     *
     * @return bool
     */
    public function publish() {
        return app(ProductRepository::class)->publish($this);
    }

    /**
     * Un publish product
     *
     * @return bool
     */
    public function unPublish() {
        return app(ProductRepository::class)->unPublish($this);
    }

    /**
     * Create new product offer
     *
     * @param $discount
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @return ProductOffer
     */
    public function newOffer($discount, Carbon $start_date, Carbon $end_date) {
        return app(ProductOfferRepository::class)->create($this, $discount, $start_date, $end_date);
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

        if ($this->shop()->settings('discount')) {
            return $this->shop()->settings('discount');
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

    public function settings($item) {
        return collect($this->settings)->get($item, '');
    }

    public function forEdit() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categoryId' => strtolower($this->category()->id),
            'subCategoryId' => strtolower($this->subcategory->id),
            'brandId' => strtolower($this->brand->id),
            'price' => $this->price,
            'description' => $this->description,
            'status' => $this->active,
            'settings' => $this->settings,
            'shopId' => strtolower($this->brand->shop->id)
        ];
    }

    /**
     * Edit a product
     *
     * @param ProductSubCategory $category
     * @param ProductBrand $brand
     * @param $productData
     * @return \Illuminate\Database\Eloquent\Model|Product
     */
    public function editProduct(ProductSubCategory $category = null, ProductBrand $brand = null, $productData) {
        return app(ProductRepository::class)->update($this, $category, $brand, $productData);
    }

    public function currencyCode() {
        return $this->shop()->currencyCode();
    }

    private function sampleImage() {
        return [
            'url' => asset("images/product/9.jpg")
        ];
    }

    public function productImages() {
        return [$this->sampleImage(), $this->sampleImage(), $this->sampleImage()];
    }
}
