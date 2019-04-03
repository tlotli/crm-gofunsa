<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Imports\BusinessOwnersImport;
use GoFunCrm\Imports\QuantitySoldImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Alert;
use Softon\SweetAlert\Facades\SWAL;

//use RealRashid\SweetAlert\Facades\Alert;

class ExcelFileUploadController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function business_owner_upload_view() {
		return view('uploads.business_owner');
	}

	public function business_owner_upload(Request $request) {
		Excel::import(new BusinessOwnersImport,request()->file('file'));

		SWAL::message('Success','Invoice successfully captured','success',[
			'timer'=>9000,
		]);

		return redirect()->back();
	}

	public function franchise_quantities_sold(Request $request) {
		Excel::import(new QuantitySoldImport,request()->file('file'));

		SWAL::message('Success','Franchise quantities sold uploaded','success',[
			'timer'=>9000,
		]);

		return redirect()->back();
	}
}
