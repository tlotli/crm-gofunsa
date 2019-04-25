<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\Site;
use GoFunCrm\StockOnHand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;
use Softon\SweetAlert\Facades\SWAL;


class SOHController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function soh_list($id) {

//		$site = DB::table('sites')
//		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
//		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
//		          ->where('sites.id' , $id)
////		        ->select('sites.name AS site_name')
//                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
//		          ->get();


		$site = Site::find($id);

		$soh = DB::table('users')
		         ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
		         ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
		         ->where('sites.id' , $id)
		         ->select('stock_on_hands.notes AS notes' , 'users.name AS captured_by' , 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' , 'stock_on_hands.id AS id')
		         ->orderBy('stock_on_hands.date_captured' ,'desc')
		         ->get();

		return view('stocks.index' , compact('site' , 'soh'));

	}

	public function capture_soh($id) {
		$site = Site::find($id);
		return view('stocks.create' , compact('site'));
	}


	public function store_soh(Request $request , $id) {

		$this->validate($request , [
			'soh' => 'required',
			'date_captured' => 'required',
		],
		[
			'soh.required' => 'Please provide stock on hand',
			'date_captured.required' => 'Please the date that the stock was captured',
		]);

		$site = Site::find($id);

		$soh = new StockOnHand();
		$soh->captured_by = Auth::id();
		$soh->site_id = $id;
		$soh->date_captured = $request->date_captured;
		$soh->notes = $request->notes;
		$soh->soh = $request->soh;
		$soh->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' Captured stock on hand ' . $site->name . ' on the ' . $soh->date_captured ;
		$log->log_type = '';
		$log->save();


		SWAL::message('Success','Stock successfully captured','success',[
			'timer'=>9000,
		]);

//		Alert::success('Site visit stock on hand captured', 'Success')->autoclose(9000);
		return redirect(route('soh_list' , ['id' => $id]));
	}


	public function edit_soh($id , $site_id) {

		$site = Site::find($id);

		$soh = StockOnHand::find($id);
		return view('stocks.edit' , compact('site' , 'soh'));
	}

	public function update_soh(Request $request ,$id , $site_id) {

//		$site = Site::find($site_id);

		$this->validate($request , [
			'soh' => 'required',
			'date_captured' => 'required',
		],
		[
			'soh.required' => 'Please provide stock on hand',
			'date_captured.required' => 'Please the date that the stock was captured',
		]);

		$soh = StockOnHand::find($id);
		$soh->captured_by = Auth::id();
		$soh->site_id = $site_id;
		$soh->date_captured = $request->date_captured;
		$soh->notes = $request->notes;
		$soh->soh = $request->soh;
		$soh->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' Updated stock on hand '  . $soh->date_captured ;
		$log->log_type = '';
		$log->save();


		SWAL::message('Success','Stock successfully updated','success',[
			'timer'=>9000,
		]);

//		Alert::success('Site visit stock on hand captured', 'Success')->autoclose(9000);
		return redirect(route('soh_list' , ['id' => $site_id]));
	}
}
