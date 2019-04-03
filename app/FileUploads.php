<?php

namespace GoFunCrm;

use Illuminate\Database\Eloquent\Model;

class FileUploads extends Model
{
    protected $fillable = [
    	'document_name',
    	'user_id',
    	'site_id',
    ];
}
