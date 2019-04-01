<?php

namespace Ddondola;

use Activity\Traits\Actor;
use Activity\Traits\Reviewer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Laravolt\Avatar\Facade as Avatar;
use Messenger\Traits\Converser;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Shoppie\Traits\Buyer;
use Shoppie\Traits\Identifier;
use Shoppie\Traits\Seller;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Seller, Buyer, Converser, HasApiTokens, CanLike, CanFollow,
        CanBeFollowed, CanFavorite, Identifier, Reviewer, Actor;

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
        'profile' => 'array'
    ];

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
        return Avatar::create($this->name())->toBase64();
    }

    public function coverPicture() {
        return asset('images/hero-area.jpg');
    }

    public function viewFollower() {
        return $this->followerCount() . " " . ($this->followerCount() > 1 || $this->followerCount() == 0 ? "followers": "follower");
    }
}
