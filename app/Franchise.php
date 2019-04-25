<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $fillable = [
    	'name',
    ];


    public function sites() {
    	return $this->hasMany(Site::class);
    }

}
