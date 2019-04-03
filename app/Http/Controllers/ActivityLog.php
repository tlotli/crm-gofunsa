<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use Illuminate\Http\Request;

class ActivityLog extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function activity_log() {
    	$logs = Log::paginate(100);
        return view('activity_log.activity' , compact('logs'));
    }
}
