<?php

namespace Ddondola;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'tag', 'description'];

    public function users() {
        return $this->belongsToMany(User::class, 'role_user',
            'role_id', 'user_id')->as('rolePivot')
            ->withTimestamps()->using(RoleUser::class);
    }
}
