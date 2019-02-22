<?php

namespace Ddondola;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Messenger\Traits\Converser;
use Shoppie\Shop;
use Shoppie\Traits\Buyer;
use Shoppie\Traits\Seller;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Seller, Buyer, Converser, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'code', 'settings'
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
        'active' => 'bool'
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

    /**
     * Shops this user is following
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function following() {
        return $this->followings(Shop::class)->get();
    }

    /**
     * Shop following count
     *
     * @return int
     */
    public function followingCount() {
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
