<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Visitation extends Model
{
    protected $fillable = [
    	'date_visited',
    	'visisted_by',
//    	'reason_for_visit',
    	'site_id',
    	'notes',
    	'visitation_type_id',
    ];
}
