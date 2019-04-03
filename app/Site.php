<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
    	'name',
    	'province',
    	'manager_number',
    	'manager_person',
    	'manager_email',
    	'merchandiser_name',
    	'merchandiser_contact_number',
    	'merchandiser_contact_email',
    	'business_group_id',
    	'business_owner_id',
    	'user_id',
    	'date_activated',
    	'status',
    	'address',
    	'city',
    ];
}
