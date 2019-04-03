<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
    	'notes',
    	'date_invoiced',
    	'who_invoiced',
    	'vat',
    	'quantity',
    	'status',
    	'site_id',
    	'user_id',
    	'invoice_attachment',
    ];
}
