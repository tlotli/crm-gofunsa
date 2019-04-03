<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name', 'created_by' , 'last_updated_by'
    ];

    public function permissions() {
    	return $this->belongsToMany('GoFunCrm\Permission', 'permission_roles')->withTimestamps();
    }

    public function users() {
    	return $this->belongsToMany('GoFunCrm\User' , 'role_users')->withTimestamps();
    }
}
