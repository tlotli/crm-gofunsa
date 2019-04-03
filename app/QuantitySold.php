<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class QuantitySold extends Model
{
    protected $fillable = [
	    'captured_by',
	    'site_id',
	    'date_captured',
	    'notes',
	    'quantity_sold',
    ];
}
