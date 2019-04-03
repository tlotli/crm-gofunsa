<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
    	'description',
    	'log_type',
    ];
}
