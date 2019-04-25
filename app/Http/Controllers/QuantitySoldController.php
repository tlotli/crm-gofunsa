<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\QuantitySold;
use GoFunCrm\Site;
use GoFunCrm\StockOnHand;
use Illuminate\Http\Request;
use Softon\SweetAlert\Facades\SWAL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuantitySoldController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function capture_quantity_sold_list($id) {
//		$site = DB::table('sites')
//		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
//		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
//		          ->where('sites.id' , $id)
////		        ->select('sites.name AS site_name')
//                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
//		          ->get();

		$site  = Site::find($id);

		$qs = DB::table('users')
		        ->join('quantity_solds' , 'quantity_solds.captured_by' , '=' , 'users.id')
		        ->join('sites' , 'sites.id' , '=' , 'quantity_solds.site_id')
		        ->where('sites.id' , $id)
		        ->select('quantity_solds.notes AS notes' , 'users.name AS captured_by' , 'quantity_solds.quantity_sold AS quantity_sold' , 'quantity_solds.date_captured AS date_captured' , 'quantity_solds.id AS id')
		        ->orderBy('quantity_solds.date_captured' ,'desc')
		        ->get();

		return view('quantity_sold.index' , compact('site' ,'qs'));
	}

	public function capture_quantity_sold($id) {
//		$site = DB::table('sites')
//		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
//		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
//		          ->where('sites.id' , $id)
////		        ->select('sites.name AS site_name')
//                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
//		          ->get();

		$site  = Site::find($id);

		return view('quantity_sold.create' , compact('site'));
	}

	public function store_quantity_sold(Request $request , $id) {
		$this->validate($request , [
			'quantity_sold' => 'required',
			'date_captured' => 'required',
		],
			[
				'quantity_sold.required' => 'Please provide number of items sold',
				'date_captured.required' => 'Please the date that the stock was captured',
			]);

		$site = Site::find($id);

		$soh = new QuantitySold();
		$soh->captured_by = Auth::id();
		$soh->site_id = $id;
		$soh->date_captured = $request->date_captured;
		$soh->notes = $request->notes;
		$soh->quantity_sold = $request->quantity_sold;
		$soh->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' capture stock for the client ' . ' on ' . $soh->date_captured ;
		$log->log_type = 'Quantity Sold';
		$log->save();

		SWAL::message('Success','Stock sold captured','success',[
			'timer'=>9000,
		]);

		return redirect(route('capture_quantity_sold_list' , ['id' => $id]));
	}

	public function edit_quantity_sold($id , $site_id) {
		$site  = Site::find($id);

		$soh = QuantitySold::find($id);
		return view('quantity_sold.edit' , compact('site' , 'soh'));
	}

	public function update_quantity_sold(Request $request ,$id , $site_id) {
		$this->validate($request , [
			'quantity_sold' => 'required',
			'date_captured' => 'required',
		],
			[
				'soh.required' => 'Please provide stock on hand',
				'date_captured.required' => 'Please the date that the stock was captured',
			]);

		$soh = QuantitySold::find($id);
		$soh->captured_by = Auth::id();
		$soh->site_id = $site_id;
		$soh->date_captured = $request->date_captured;
		$soh->notes = $request->notes;
		$soh->quantity_sold = $request->quantity_sold;
		$soh->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' Updated number of stock sold '  . $soh->date_captured ;
		$log->log_type = 'Quantity Sold';
		$log->save();

		SWAL::message('Success','Stock sold updated','success',[
			'timer'=>9000,
		]);

		return redirect(route('capture_quantity_sold_list' , ['id' => $site_id]));
	}
}
