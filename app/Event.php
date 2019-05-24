<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'site_id',
        'event_type',
        'start_date',
        'end_date',
        'user_id',
        'notes',
        'address_latitude',
        'address_longitude',

    ];

    public function users() {
	    return $this->belongsToMany('GoFunCrm\User' , 'event_users')->withTimestamps();
    }
}
