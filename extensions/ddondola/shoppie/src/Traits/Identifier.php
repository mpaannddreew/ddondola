<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-04
 * Time: 5:16 PM
 */

namespace Shoppie\Traits;


trait Identifier
{
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