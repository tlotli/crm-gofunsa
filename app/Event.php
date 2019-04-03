<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'user_id',
        'notes',
        'location',
        'address_latitude',
        'address_longitude',

    ];
}
