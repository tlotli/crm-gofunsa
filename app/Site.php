<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
	    'name',
	    'gofun_bc',
	    'retail_group_bc',
	    'retailer',
	    'retailer_name',
	    'retailer_contact_no',
	    'manager_1',
	    'manager_2',
	    'address',
	    'city',
	    'province',
	    'surburb',
	    'landline',
	    'cellphone',
	    'alternative',
	    'email_1',
	    'email_2',
	    'notes',
	    'user_id',
	    'franchise_id',
	    'status',
	    'on_board',
	    'address_latitude',
	    'address_longitude',
    ];

    public function franchise() {
    	return $this->belongsTo(Franchise::class)->withDefault();
    }

}
