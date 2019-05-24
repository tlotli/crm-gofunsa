<?php

namespace GoFunCrm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telephone', 'status', 'position' , 'created_by' , 'last_updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
    	return $this->belongsToMany('GoFunCrm\Role' , 'role_users');
    }


	public function events() {
		return $this->belongsToMany('GoFunCrm\Event', 'event_users')->withTimestamps();
	}

}
