<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    	'assigned_by',
    	'assigned_to',
    	'site_id',
    	'visitation_id',
    	'status',
    	'notes',
    	'follow_up_visitation_id',
    ];



    public function visitations() {
    	return $this->hasMany('GoFunCrm\Visitation');
    }

}
