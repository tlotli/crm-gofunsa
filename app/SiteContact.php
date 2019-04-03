<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class SiteContact extends Model
{
    protected $fillable = [
    	'contact_name',
    	'contact_phone',
    	'contact_name',
    	'contact_email',
    	'user_id',
    	'site_id',
    ];
}
