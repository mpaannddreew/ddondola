<?php

namespace Ddondola;

use Activity\Traits\Reviewer;
use Bank\Traits\Holder;
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
use Shoppie\Traits\Buyer;
use Shoppie\Traits\Seller;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Seller, Buyer, HasApiTokens, CanLike, CanFollow, Holder,
        CanBeFollowed, CanFavorite, Reviewer, Muddondozi, HasMediaTrait;

    public static $laracombee = ['first_name' => 'string', 'last_name' => 'string', 'email' => 'string'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'code', 'settings', 'profile', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['name'];

    protected $casts = [
        'settings' => 'array',
        'active' => 'bool',
        'profile' => 'array',
        'is_staff' => 'bool',
        'is_superuser' => 'bool'
    ];

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

    public function followingCount() {
        return $this->followings->count();
    }

    public function followerCount() {
        return $this->followers->count();
    }

    public function avatar() {
        return [
            'url' => Avatar::create($this->name())->toBase64()
        ];
    }

    public function avatars() {
        return [
            $this->avatar(), $this->avatar(), $this->avatar(), $this->avatar()
        ];
    }

    public function coverPicture() {
        return [
            'url' => asset('images/banner1.jpg')
        ];
    }

    public function coverPictures() {
        return [
            $this->coverPicture(), $this->coverPicture(), $this->coverPicture(), $this->coverPicture()
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

    public function contactIds() {
        return $this->followings->pluck('id')->merge($this->followers->pluck('id'));
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
}
