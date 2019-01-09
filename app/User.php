<?php

namespace Ddondola;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Messenger\Traits\Converser;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Shoppie\Shop;
use Shoppie\Traits\Buyer;
use Shoppie\Traits\Seller;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Seller, Buyer, CanBeFollowed, CanFollow, CanFavorite, Converser, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'code'
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

    /**
     * Number of followers
     *
     * @return int
     */
    public function followerCount() {
        return $this->followers()->get()->count();
    }

    /**
     * User following
     *
     * @return int
     */
    public function userFollowingCount() {
        return $this->followings()->get()->count();
    }

    /**
     * Shop following
     *
     * @return int
     */
    public function shopFollowingCount() {
        return $this->followings(Shop::class)->get()->count();
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
}
