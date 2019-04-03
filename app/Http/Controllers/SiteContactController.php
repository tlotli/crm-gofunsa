<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\Site;
use GoFunCrm\SiteContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;

class SiteContactController extends Controller
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

		$site_contacts = SiteContact::where('site_id'  , $id)->get();
		return view('site_contacts.index' , compact('site' , 'site_contacts'));
	}


	public function site_create_contacts($id) {
		$site = DB::table('sites')
		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		          ->where('sites.id' , $id)
		          ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		          ->get();

		return view('site_contacts.create' , compact('site'));
	}


	public function site_store_contacts(Request $request , $id) {
		$this->validate($request , [
			'contact_name' => 'required',
			'contact_phone' => 'required',
			'contact_email' => 'required',
			'position' => 'required',
		],
		[
			'contact_name.required' => 'Contact name is required',
			'contact_phone.required' => 'Contact phone is required',
			'contact_email.required' => 'Contact email is required',
			'position.required' => 'Position is required',
		]);

		$site_contact = new SiteContact();
		$site_contact->contact_name = $request->contact_name ;
		$site_contact->contact_phone = $request->contact_phone ;
		$site_contact->contact_email = $request->contact_email ;
		$site_contact->position = $request->position ;
		$site_contact->user_id = Auth::id() ;
		$site_contact->site_id = $id ;
		$site_contact->save() ;

		$site = Site::find($id);

		$log = new Log();
		$log->description = Auth::user()->name . ' Created the following contact '  . $site->created_at . ' for the site ' . $site->name ;
		$log->log_type = 'Site Contacts';
		$log->save();

		SWAL::message('Success','Contact successfully created','success',[
			'timer'=>9000,
		]);

		return redirect(route('site_contacts' , ['id' => $id]));
	}


	public function edit_site_contact($id , $site_id) {

		$site = DB::table('sites')
		          ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		          ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		          ->where('sites.id' , $site_id)
		          ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		          ->get();

		$site_contact = SiteContact::find($id);
		return view('site_contacts.edit' , compact('site_contact' , 'site'));
	}


	public function update_site_contact(Request $request ,$id , $site_id) {

		$this->validate($request , [
			'contact_name' => 'required',
			'contact_phone' => 'required',
			'contact_email' => 'required',
			'position' => 'required',
		],
		[
				'contact_name.required' => 'Contact name is required',
				'contact_phone.required' => 'Contact phone is required',
				'contact_email.required' => 'Contact email is required',
				'position.required' => 'Position is required',
		]);

		$site_contact = SiteContact::find($id);

		$site_contact_name =  $site_contact->contact_name ;

		$site_contact->contact_name = $request->contact_name ;
		$site_contact->contact_phone = $request->contact_phone ;
		$site_contact->contact_email = $request->contact_email ;
		$site_contact->position = $request->position ;
		$site_contact->user_id = Auth::id() ;
		$site_contact->site_id = $site_id ;
		$site_contact->save() ;

		$site = Site::find($site_id);

		$log = new Log();
		$log->description = Auth::user()->name . ' Updated the following contact '  . $site_contact_name . ' at ' . $site_contact->updated_at ;
		$log->log_type = 'Site Contacts';
		$log->save();

		SWAL::message('Success','Contact successfully updated','success',[
			'timer'=>9000,
		]);

		return redirect(route('site_contacts' , ['id' => $site_id]));
	}


	public function get_all_contacts() {

		$contacts = DB::table('site_contacts')
					->join('sites' , 'sites.id' , '=' , 'site_contacts.site_id')
					->select('sites.name AS site_name' , 'sites.province' , 'site_contacts.contact_name as contact_name' , 'site_contacts.position as position'  , 'site_contacts.contact_phone as contact_phone' , 'site_contacts.contact_email as contact_email' ,  'sites.id as site_id')
					->get();

		return view('quick_access.users' , compact('contacts')) ;

	}


}
