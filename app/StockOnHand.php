<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class StockOnHand extends Model
{
    protected $fillable = [
        'captured_by',
        'site_id',
        'date_captured',
        'notes',
        'soh',
    ];
}
