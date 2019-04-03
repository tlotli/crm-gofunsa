<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Invoice;
use GoFunCrm\Log;
use GoFunCrm\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;

class InvoiceController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index($id) {
		$site = DB::table('sites')
		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		          ->where('sites.id' , $id)
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		          ->get();

		$invoices = DB::table('users')
					->rightJoin('invoices' , 'invoices.user_id' , '=' ,'users.id')
					->join('sites' , 'sites.id' , '=' , 'invoices.site_id')
					->where('sites.id' , $id)
					->select('users.name AS user_name' , 'invoices.*')
					->get();

		return view('invoices.index' , compact('site' , 'invoices'));
	}

	public function invoice_create($id) {

		$site = DB::table('sites')
		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		          ->where('sites.id' , $id)
		          ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		          ->get();

		return view('invoices.create' ,compact('site'));
	}

	public function invoice_store(Request $request , $id) {
		$this->validate($request , [
			'who_invoiced' => 'required',
			'date_invoiced' => 'required',
			'quantity' => 'required',
			'vat' => 'required',
			'notes' => 'required',
		],
		[
			'who_invoiced.required' => 'Please provide the name of the person that issued the invoice',
			'date_invoiced.required' => 'Please provide the date that the invoice was requested',
			'quantity.required' => 'Please provide the quantity ordered',
			'vat.required' => 'Vat is required',
			'notes.required' => 'Provide an explanation for the invoice',
		]);

		if($request->hasFile('invoice_attachment')) {
			 $invoice_attachment = $request->invoice_attachment->store('public/invoices') ;
		}
		else {
			$invoice_attachment = '';
		}

		$invoice = new Invoice();
		$invoice->who_invoiced = $request->who_invoiced;
		$invoice->date_invoiced = $request->date_invoiced;
		$invoice->status = $request->status;
		$invoice->quantity = $request->quantity;
		$invoice->vat = $request->vat;
		$invoice->notes = $request->notes;
		$invoice->invoice_attachment = $invoice_attachment;
		$invoice->user_id = Auth::id();
		$invoice->site_id = $id;
		$invoice->save();

		$site = Site::find($id);

		$log = new Log();
		$log->description = Auth::user()->name . ' Created an invoice at '  . $invoice->created_at . ' for the client ' . $site->name ;
		$log->log_type = 'Invoice';
		$log->save();

		SWAL::message('Success','Invoice successfully captured','success',[
			'timer'=>9000,
		]);

		return redirect(route('invoices.index' , ['id' => $id]));
	}

	public function edit_invoice($id , $site_id) {
		$site = DB::table('sites')
		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		          ->where('sites.id' , $site_id)
		          ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		          ->get();

		$invoice = Invoice::find($id);
		return view('invoices.edit' , compact('site' ,'invoice'));
	}


	public function update_invoice(Request $request , $id , $site_id) {
		$invoice = Invoice::find($id);
		$invoice_id = $invoice->id ;

		$this->validate($request , [
			'who_invoiced' => 'required',
			'date_invoiced' => 'required',
			'quantity' => 'required',
			'vat' => 'required',
			'notes' => 'required',
		],
			[
				'who_invoiced.required' => 'Please provide the name of the person that issued the invoice',
				'date_invoiced.required' => 'Please provide the date that the invoice was requested',
				'quantity.required' => 'Please provide the quantity ordered',
				'vat.required' => 'Vat is required',
				'notes.required' => 'Provide an explanation for the invoice',
			]);

		if($request->hasFile('invoice_attachment')) {
			$invoice_attachment = $request->invoice_attachment->store('public/invoices') ;
		}
		else {
			$invoice_attachment = $invoice->invoice_attachment;
		}

		$invoice->who_invoiced = $request->who_invoiced;
		$invoice->date_invoiced = $request->date_invoiced;
		$invoice->status = $request->status;
		$invoice->quantity = $request->quantity;
		$invoice->vat = $request->vat;
		$invoice->notes = $request->notes;
		$invoice->invoice_attachment = $invoice_attachment;
		$invoice->user_id = Auth::id();
		$invoice->site_id = $site_id;
		$invoice->save();

		$site = Site::find($site_id);

		$log = new Log();
		$log->description = Auth::user()->name . ' Updated invoice '  . $invoice_id . ' for the client ' . $site->name ;
		$log->log_type = 'Invoice';
		$log->save();

		SWAL::message('Success','Invoice successfully captured','success',[
			'timer'=>9000,
		]);

		return redirect(route('invoices.index' , ['id' => $site_id]));
	}


	public function get_all_invoices() {
		$invoices = DB::table('invoices')
					->join('sites' , 'invoices.site_id' , '=' , 'sites.id')
					->select('invoices.*' , 'sites.name AS site_name' , 'sites.id AS site_id'  , 'sites.province AS province')
					->get();

		return view('quick_access.invoices' , compact('invoices'));
	}


}
