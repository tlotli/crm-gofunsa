<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class BusinessGroup extends Model
{
	protected $fillable = [
		'name',
		'ceo_name',
		'address',
		'contact_number',
		'contact_email',
		'user_id',
		'status',
		'city',
		'address',
		'province',
	];
}
