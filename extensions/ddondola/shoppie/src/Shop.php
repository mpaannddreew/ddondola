<?php

namespace Shoppie;

use Activity\Traits\Reviewable;
use Bank\Traits\Holder;
use Ddondola\Traits\Muddondozi;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Shoppie\Repository\ShopRepository;
use Shoppie\Traits\Identifier;
use Laravolt\Avatar\Facade as Avatar;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Shop extends Model
{
    use CanBeLiked, Identifier, Reviewable, Muddondozi, HasMediaTrait, Holder;

    protected $fillable = ['name', 'code', 'category_id', 'profile', 'settings', 'active'];

    protected $casts = [
        'profile' => 'array',
        'settings' => 'array',
        'active' => 'bool'
    ];

    protected $appends = ['shop_category', 'averageRating', 'reviewCount'];

    public function getShopCategoryAttribute() {
        return $this->category->name;
    }

    public function getAverageRatingyAttribute() {
        return $this->averageRating();
    }

    public function getReviewCountAttribute() {
        return $this->reviewCount();
    }

    public function products() {
        return $this->hasManyThrough(Product::class, ProductBrand::class, 'shop_id', 'brand_id');
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
        return Order::whereIn('id', $this->orderIds());
    }

    /**
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
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subcategories() {
        return $this->hasManyThrough(ProductSubCategory::class, ProductCategory::class, 'shop_id', 'category_id');
    }

    /**
     * @return int
     */
    public function subCategoriesCount() {
        return $this->subcategories->count();
    }

    /**
     * @return int
     */
    public function productCount() {
        return $this->products->count();
    }

    /**
     * Deactivates shop
     *
     * @return boolean
     */
    public function deactivate()
    {
        return app(ShopRepository::class)->deactivateShop($this);
    }

    /**
     * Deactivates shop
     *
     * @return boolean
     */
    public function activate()
    {
        return app(ShopRepository::class)->activateShop($this);
    }

    /**
     * @return int
     */
    public function likeCount() {
        return $this->likers->count();
    }

    public function avatar() {
        return [
            'url' => Avatar::create($this->name)->toBase64()
        ];
    }

    public function avatars() {
        return [
            $this->avatar(), $this->avatar(), $this->avatar(), $this->avatar()
        ];
    }

    public function coverPicture() {
        return [
            'url' => asset('/images/hero_in_shop_detail.jpg')
        ];
    }

    public function coverPictures() {
        return [
            $this->coverPicture(), $this->coverPicture(), $this->coverPicture(), $this->coverPicture()
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
        return $this->owner->country->currencyCode();
    }

    public function contactIds() {
        return $this->likers->pluck('id');
    }

    /**
     * Defines account details
     *
     * $details = [
     *      'account_bank',
     *      'account_number',
     *      'business_name',
     *      'business_email,
     *      'business_contact',
     *      'business_contact_mobile',
     *      'business_mobile',
     *      'meta' => [],
     *      'split_type',
     *      'split_value'
     * ]
     *
     * @return array
     */
    public function accountDetails()
    {
        return [];
    }
}
