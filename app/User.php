<?php

namespace Ddondola;

use Activity\Traits\Reviewer;
use Ddondola\Traits\Muddondozi;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Laravolt\Avatar\Facade as Avatar;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Shoppie\Shop;
use Shoppie\Traits\Buyer;
use Shoppie\Traits\Seller;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, Seller, Buyer, HasApiTokens, CanLike, CanFollow,
        CanBeFollowed, CanFavorite, Reviewer, Muddondozi, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'code', 'settings', 'profile', 'active', 'is_staff', 'is_superuser'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'media'
    ];

    protected $appends = ['name', 'avatar', 'coverPicture', /*'followerCount', 'followingCount'*/];

    protected $casts = [
        'settings' => 'array',
        'active' => 'bool',
        'profile' => 'array',
        'is_staff' => 'bool',
        'is_superuser' => 'bool'
    ];

    public function admin() {
        return $this->is_staff && $this->is_superuser;
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * return user's name
     *
     * @return string
     */
    public function name() {
        return $this->first_name . " " . $this->last_name;
    }

    public function getNameAttribute()
    {
        return $this->name();
    }

    public function getCoverPictureAttribute()
    {
        return $this->coverPicture();
    }

    public function getAvatarAttribute()
    {
        return $this->avatar();
    }

    public function getFollowerCountAttribute()
    {
        return $this->followerCount();
    }

    public function getFollowingCountAttribute()
    {
        return $this->followingCount();
    }

    public function followingCount() {
        return $this->followings()->count();
    }

    public function followerCount() {
        return $this->followers()->count();
    }

    public function avatar() {
        return [
            'url' => (string)Avatar::create($this->name())->toBase64()
        ];
    }

    public function coverPicture() {
        return [
            'url' => asset('images/bg/user_1.jpg')
//            'url' => asset('images/banner1.jpg')
//            'url' => asset('images/bg/background.jpg')
        ];
    }

    public function viewFollower() {
        return $this->followerCount() . " " . ($this->followerCount() > 1 || $this->followerCount() == 0 ? "followers": "follower");
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = \Illuminate\Support\Str::uuid()->toString();
        });
    }

    public function getRouteKeyName()
    {
        return "code";
    }

    public function contacts() {
        return $this->followings()->pluck('id')->merge($this->followers()->pluck('id'))->all();
    }

    /**
     * @return array
     */
    protected function communityReviewIds()
    {
        return $this->followings->flatMap(function (User $user) {
            return $user->reviewIds();
        });
    }

    public function profile($item) {
        return collect($this->profile)->get($item, '');
    }

    public function settings($item) {
        return collect($this->settings)->get($item, '');
    }

    public function resolveProfile() {
        return [
            'phone_number' => $this->profile('phone_number'),
            'about' => $this->profile('about'),
            'address' => $this->profile('address'),
            'email' => $this->email
        ];
    }

    public function productIdsForCommunityLikedShop() {
        return $this->followings->flatMap(function (User $user) {
            return $user->productIdsForLikedShop();
        });
    }

    public function productIdsForLikedShop() {
        return $this->likes(Shop::class)->get()->flatMap(function (Shop $shop) {
            return $shop->productIds();
        })->all();
    }

    public function setUp()
    {
        $this->createAccount();
        $this->createCart();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user',
            'user_id', 'role_id')->as('rolePivot')
            ->withTimestamps()->using(RoleUser::class);
    }
}
