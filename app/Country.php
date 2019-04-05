<?php

namespace Ddondola;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name'];

    protected $appends = ['details'];

    public function users() {
        return $this->hasMany(User::class, 'country_id');
    }

    public function data() {
        return country($this->code);
    }

    public function getDetailsAttribute() {
        return $this->data()->getAttributes();
    }

    public function flag() {
        return $this->data()->getFlag();
    }
}
