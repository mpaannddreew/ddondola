<?php

namespace Ddondola;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name'];

    public function users() {
        return $this->hasMany(User::class, 'country_id');
    }

    public function data() {
        return country($this->code);
    }

    public function details() {
        return json_encode($this->data()->getAttributes());
    }

    public function flag() {
        return $this->data()->getFlag();
    }

    public function currencyCode() {
        return collect($this->data()->getCurrency())->get('iso_4217_code');
    }
}
