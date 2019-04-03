<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\SetDateFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softon\SweetAlert\Facades\SWAL;

class SetDateFlagController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function validateSetDate() {
		$set_date = SetDateFlag::first();

		if(empty($set_date)) {
			return redirect(route('set_date'));
		}
		else {
			return redirect(route('edit_date' , ['id' => $set_date->id]));
		}
	}

	public function set_date() {
		return view('visitation_date_flag.create');
	}

	public function store_date(Request $request) {

		$set_date_test = SetDateFlag::first();
		if(empty($set_date_test)) {

			$this->validate($request , [
				'date_flag' => 'required',
			],
			[
				'date_flag.required' => 'Visitation date flag is required',
			]);

			$set_date = new SetDateFlag();
			$set_date->user_id = Auth::id();
			$set_date->date_flag = $request->date_flag;
			$set_date->save();

			$log = new Log();
			$log->description = Auth::user()->name . ' Set the visitation date flag to ' . $set_date->date_flag . ' ' . $set_date->created_at  ;
			$log->log_type = 'Date Flag';
			$log->save();

			SWAL::message('Success','Date Successfully set','success',[
				'timer'=>9000,
			]);

			return redirect(route('validateSetDate'));
		}
		else {

			return redirect(route('edit_date' , ['id' => $set_date_test->id]));
		}
	}


	public function edit_date($id) {
		$set_date = SetDateFlag::find($id);
		return view('visitation_date_flag.edit' , compact('set_date'));
	}


	public function update_date(Request $request , $id) {

		$this->validate($request , [
			'date_flag' => 'required',
		],
		[
			'date_flag.required' => 'Visitation date flag is required',
		]);

		$set_date = SetDateFlag::find($id);
		$set_date->user_id = Auth::id();
		$set_date->date_flag = $request->date_flag;
		$set_date->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' Updated the visitation date flag to ' . $set_date->date_flag . ' ' . $set_date->created_at  ;
		$log->log_type = 'Date Flag';
		$log->save();

		SWAL::message('Success','Date successfully updated','success',[
			'timer'=>9000,
		]);

		return redirect(route('validateSetDate'));
	}

}
