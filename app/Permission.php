<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'permission_type_id',
    ];

    public function roles() {
    	return $this->belongsToMany('GoFunCrm\Role', 'permission_roles')->withTimestamps();
    }
}
