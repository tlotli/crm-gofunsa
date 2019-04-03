<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class SetDateFlag extends Model
{
    protected $fillable = [
        'date_flag',
        'user_id',
    ];
}
