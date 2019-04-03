<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class BusinessOwner extends Model
{
    protected $fillable = [
    	'name',
    	'email',
//    	'slug',
    	'user_id',
    	'contact_number',
    ];
}
