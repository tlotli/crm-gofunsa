<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class SetPrice extends Model
{
    protected $fillable = [
    	'price',
    	'status',
    	'user_id',
    	'last_updated_by',
    ];
}
