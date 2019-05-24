<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $fillable = [
    	'user_id',
    	'event_id',
    ];
}
