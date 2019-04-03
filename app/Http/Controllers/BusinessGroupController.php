<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\BusinessGroup;
use GoFunCrm\BusinessOwner;
use GoFunCrm\Log;
use GoFunCrm\Province;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softon\SweetAlert\Facades\SWAL;

use Illuminate\Support\Facades\DB;

class BusinessGroupController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_groups = DB::table('business_groups')
	                       ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	                       ->leftJoin('users' , 'users.id' , '=' , 'business_groups.user_id')
	                       ->select('users.name AS user_name' , 'business_owners.name AS ceo' , 'business_groups.address AS address' ,  'business_groups.status AS status' , 'business_groups.contact_email AS contact_email'  , 'business_groups.name AS business_name' , 'business_groups.contact_number AS contact_number'  , 'business_groups.id AS id' , 'business_groups.created_at AS created_at' , 'business_groups.business_type AS business_type')
	                       ->get();

        return view('business_groups.index' , compact('business_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$province = Province::all();
    	$business_owners = BusinessOwner::all();

    	if($business_owners->count() < 1 ) {
		    SWAL::message('Warning','No owners exist in the system. Please create business owners before creating business groups ','warning',[
			    'timer'=>9000,
		    ]);
		    return redirect(route('business_owner.create'));
	    }
        return view('business_groups.create' , compact('province' ,'business_owners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
        	'name' => 'required',
	        'ceo_name' => 'required',
	        'address' => 'required',
	        'contact_number' => 'required|min:10|max:10',
	        'contact_email' => 'required|email',
	        'city' => 'required',
	        'province' => 'required',
        ],
	    [
	        'name.required' => 'Business group name is required',
	        'ceo_name.required' => 'Please provide the name of the CEO',
	        'address.required' => 'Address field is required',
	        'contact_number.required' => 'Contact number is required',
	        'contact_email.required' => 'Please provide a contact email',
	        'contact_email.email' => 'Please provide a valid email',
	        'city.required' => 'Please provide city name',
	        'province.required' => 'Please the name of the province',
	    ]);

        $business_group = new BusinessGroup();
        $business_group->name = $request->name ;
        $business_group->business_owner_id = $request->ceo_name ;
        $business_group->address = $request->address ;
        $business_group->contact_number = $request->contact_number ;
        $business_group->contact_email = $request->contact_email ;
        $business_group->province = $request->province ;
        $business_group->city = $request->city ;
        $business_group->address = $request->address ;
        $business_group->business_type = $request->business_type ;
        $business_group->user_id = Auth::id() ;
        $business_group->save();

        $log = new Log();
        $log->description = Auth::user()->name . ' Created the following business retail group ' . $business_group->name . ' ' . $business_group->created_at  ;
        $log->log_type = 'Retail Groups';
        $log->save();

	    SWAL::message('Success','Business retail group was created','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('business_group.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $province = Province::all();
	    $business_owners = BusinessOwner::all();
    	$business_group = BusinessGroup::find($id);
    	return view('business_groups.edit' , compact('business_group' , 'province' , 'business_owners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $business_group = BusinessGroup::find($id);
        $business_group_name =  $business_group->name ;

	    $this->validate($request , [
		    'name' => 'required',
		    'ceo_name' => 'required',
		    'address' => 'required',
		    'contact_number' => 'required|min:10|max:10',
		    'contact_email' => 'required|email',
		    'city' => 'required',
		    'province' => 'required',
	    ],
		    [
			    'name.required' => 'Business group name is required',
			    'ceo_name.required' => 'Please provide the name of the CEO',
			    'address.required' => 'Address field is required',
			    'contact_number.required' => 'Contact number is required',
			    'contact_email.required' => 'Please provide a contact email',
			    'contact_email.email' => 'Please provide a valid email',
			    'city.required' => 'Please provide city name',
			    'province.required' => 'Please the name of the province',
		    ]);

	    $business_group->name = $request->name ;
	    $business_group->business_owner_id = $request->ceo_name ;
	    $business_group->address = $request->address ;
	    $business_group->contact_number = $request->contact_number ;
	    $business_group->contact_email = $request->contact_email ;
	    $business_group->province = $request->province ;
	    $business_group->city = $request->city ;
	    $business_group->address = $request->address ;
	    $business_group->business_type = $request->business_type ;
	    $business_group->status = $request->status ;
	    $business_group->user_id = Auth::id() ;
	    $business_group->save();

	    $log = new Log();
	    $log->description = Auth::user()->name . ' Updated the following business retail group ' . $business_group->name . ' ' . $business_group->updated_at  ;
	    $log->log_type = 'Retail Groups';
	    $log->save();

	    SWAL::message('Success','Business retail group was updated','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('business_group.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function business_group_dashboard($id) {

	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('business_groups.id' , $id)
	              ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->first();

    	$business_group_id = $id;

    	$current_date = Carbon::now()->year ;

    	$sites_owned_by_group = DB::table('business_groups')
		                        ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
		                        ->where('business_groups.id' , $id)
		                        ->where('sites.status' , 0)
		                        ->select('business_groups.name AS group_name' , 'business_groups.business_type AS business_type' , DB::raw("COUNT(sites.id) AS number_of_sites") )
		                        ->groupBy('business_groups.name' , 'business_groups.business_type')
		                        ->get();

	    $sites_owned_by_group_by_franchise = DB::table('business_groups')
	                              ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                              ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                              ->where('business_groups.id' , $id)
		                          ->where('sites.status' , 0)
	                              ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , 'franchises.name AS franchise_name' )
	                              ->groupBy('franchise_name')
	                              ->get();

	    $sites_owned_by_group_by_region_franchise = DB::table('business_groups')
	                              ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                              ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                              ->where('business_groups.id' , $id)
		                          ->where('sites.status' , 0)
	                              ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , DB::raw("CONCAT(franchises.name , ' - ' , sites.province ) AS region" )   )
	                              ->groupBy('region')
		                          ->orderBy('sites.province' , 'ASC')
	                              ->get();

		$sales_by_franchise = DB::table('business_groups')
		                        ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
		                        ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
								->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                        ->where('business_groups.id' , $id)
								->where('sites.status' , 0)
		                        ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
								->select(   DB::raw("SUM(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
		                        ->groupBy('franchise_name')
		                        ->get();

	    $sales_average_by_franchise = DB::table('business_groups')
	                            ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                            ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                            ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                            ->where('business_groups.id' , $id)
	                            ->where('sites.status' , 0)
	                            ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
//		                        ->select(   DB::raw("SUM(quantity_solds.quantity_sold) AS quantity_sold") , DB::raw("CONCAT(franchises.name , ' - ' , sites.province ) AS region" )   )
                                ->select(   DB::raw("AVG(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
	                            ->groupBy('franchise_name')
	                            ->get();



	    $sales_by_sites = DB::select("
		        SELECT SUM(quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND( YEAR(quantity_solds.date_captured) = YEAR(NOW()) )
				AND sites.status = 0
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");


	    $sales_by_sites_average = DB::select("
	        SELECT AVG (quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND( YEAR(quantity_solds.date_captured) = YEAR(NOW()) )
				AND sites.status = 0
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");

	    $data_sales_by_sites = '';
	    $mac_sales_by_sites = array();
	    foreach ($sales_by_sites as $povp24) {
		    $data_sales_by_sites = $data_sales_by_sites.$povp24->quantity_sold.',';
		    $mac_sales_by_sites[] = $povp24->site_name;
	    }

	    $sales_by_sites_bar_chart = Charts::multi('bar', 'chartjs')
	                                               ->title('Sales By Sites (YTD)')
	                                               ->labels($mac_sales_by_sites)
	                                               ->dataset('Sales By Sites' ,[$data_sales_by_sites])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                                   ->responsive(false);

	    $data_sales_by_sites_average = '';
	    $mac_sales_by_sites_average = array();
	    foreach ($sales_by_sites_average as $povp24) {
		    $data_sales_by_sites_average = $data_sales_by_sites_average.$povp24->quantity_sold.',';
		    $mac_sales_by_sites_average[] = $povp24->site_name;
	    }

	    $sales_by_sites_average_bar_chart = Charts::multi('bar', 'chartjs')
	                                      ->title('Sales By Sites (YTD)')
	                                      ->labels($mac_sales_by_sites_average)
	                                      ->dataset('Sales By Sites' ,[$data_sales_by_sites_average])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                          ->responsive(false);

	    $sites_owned_by_group_by_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                ->title('Number Of Sites By Franchise')
	                                ->labels($sites_owned_by_group_by_franchise->pluck('franchise_name')->toArray())
	                                ->dataset('Franchise' ,$sites_owned_by_group_by_franchise->pluck('number_of_franchises')->toArray())
	                                ->responsive(false);

	    $sites_owned_by_group_by_region_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                                         ->title('Number Of Franchises By Region')
	                                                         ->labels($sites_owned_by_group_by_region_franchise->pluck('region')->toArray())
	                                                         ->dataset('Franchise' ,$sites_owned_by_group_by_region_franchise->pluck('number_of_franchises')->toArray())
	                                                         ->responsive(false);

	    $sales_by_franchise_bar_chart = Charts::create('donut', 'chartjs')
	                                                                ->title('Sales By Franchise (YTD)')
	                                                                ->labels($sales_by_franchise->pluck('franchise_name')->toArray())
	                                                                ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                                                ->responsive(false);

	    $sales_average_by_franchise_bar_chart = Charts::create('pie', 'chartjs')
	                                                ->title('Average Sales By Franchise (YTD)')
	                                                ->labels($sales_average_by_franchise->pluck('franchise_name')->toArray())
	                                                ->values($sales_average_by_franchise->pluck('quantity_sold')->toArray())
	                                                ->responsive(false);



	    $detail_reports = DB::table('business_groups')
	                       ->leftJoin('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
		                   ->leftJoin('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                       ->where('business_groups.id' , $id)
	                       ->where('sites.status' , 0)
	                       ->select(    'sites.name AS site_name' , 'sites.province AS province' , 'franchises.name as franchise_name' , 'sites.id AS site_id'   )
		                   ->groupBy('sites.name' , 'sites.province' , 'franchises.name' , 'sites.id')
	                       ->orderBy('province' , 'ASC')
	                       ->get();

	    return view('business_groups.dashboard' , compact('sites_owned_by_group_by_franchise_bar_chart' , 'sites_owned_by_group_by_region_franchise_bar_chart' ,'sales_by_franchise_bar_chart' , 'sales_average_by_franchise_bar_chart' , 'sales_by_sites_bar_chart'  , 'sales_by_sites_average_bar_chart' , 'detail_reports' ,'business_group_id' ,'site'));
    }

    public function business_group_dashboard_search(Request $request ,$id) {

	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('business_groups.id' , $id)
	              ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->first();

	    $this->validate($request , [
		    'from' => 'required',
		    'to' => 'required',
	    ],
		    [
			    'from.required' => 'Please provide start date',
			    'to.required' => 'Please provide end date',
		    ]
	    );

	    $from = $request->from ;
	    $to = $request->to ;
	    $business_group_id = $id;



	    $sites_owned_by_group = DB::table('business_groups')
	                              ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                              ->where('business_groups.id' , $id)
	                              ->where('sites.status' , 0)
	                              ->select('business_groups.name AS group_name' , 'business_groups.business_type AS business_type' , DB::raw("COUNT(sites.id) AS number_of_sites") )
	                              ->groupBy('business_groups.name' , 'business_groups.business_type')
	                              ->get();

	    $sites_owned_by_group_by_franchise = DB::table('business_groups')
	                                           ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                           ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                           ->where('business_groups.id' , $id)
	                                           ->where('sites.status' , 0)
	                                           ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , 'franchises.name AS franchise_name' )
	                                           ->groupBy('franchise_name')
	                                           ->get();

	    $sites_owned_by_group_by_region_franchise = DB::table('business_groups')
	                                                  ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                                  ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                                  ->where('business_groups.id' , $id)
	                                                  ->where('sites.status' , 0)
	                                                  ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , DB::raw("CONCAT(franchises.name , ' - ' , sites.province ) AS region" )   )
	                                                  ->groupBy('region')
	                                                  ->orderBy('sites.province' , 'ASC')
	                                                  ->get();

	    $sales_by_franchise = DB::table('business_groups')
	                            ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                            ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                            ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                            ->where('business_groups.id' , $id)
	                            ->where('sites.status' , 0)
		                        ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                        ->where('quantity_solds.date_captured' , '<=' , $request->to)
	                            ->select(   DB::raw("SUM(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
	                            ->groupBy('franchise_name')
	                            ->get();

	    $sales_average_by_franchise = DB::table('business_groups')
	                                    ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                    ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                    ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                                    ->where('business_groups.id' , $id)
	                                    ->where('sites.status' , 0)
		                                ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                                ->where('quantity_solds.date_captured' , '<=' , $request->to)
                                        ->select(   DB::raw("AVG(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
	                                    ->groupBy('franchise_name')
	                                    ->get();

	    $sales_by_sites = DB::select("
		        SELECT SUM(quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND sites.status = 0
				AND quantity_solds.date_captured >= '$from'
				AND quantity_solds.date_captured <= '$to'
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");





	    $sales_by_sites_average = DB::select("
	        SELECT AVG (quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND sites.status = 0
				AND quantity_solds.date_captured >= '$from'
				AND quantity_solds.date_captured <= '$to'
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");


	    $data_sales_by_sites = '';
	    $mac_sales_by_sites = array();
	    foreach ($sales_by_sites as $povp24) {
		    $data_sales_by_sites = $data_sales_by_sites.$povp24->quantity_sold.',';
		    $mac_sales_by_sites[] = $povp24->site_name;
	    }

	    $sales_by_sites_bar_chart = Charts::multi('bar', 'chartjs')
	                                      ->title('Sales By Sites')
	                                      ->labels($mac_sales_by_sites)
	                                      ->dataset('Sales By Sites' ,[$data_sales_by_sites])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                          ->responsive(false);

	    $data_sales_by_sites_average = '';
	    $mac_sales_by_sites_average = array();
	    foreach ($sales_by_sites_average as $povp24) {
		    $data_sales_by_sites_average  = $data_sales_by_sites_average . $povp24->quantity_sold . ',';
		    $mac_sales_by_sites_average[] = $povp24->site_name;
	    }


	    $sales_by_sites_average_bar_chart = Charts::multi('bar', 'chartjs')
	                                              ->title('Average Sales By Sites')
	                                              ->labels($mac_sales_by_sites_average)
	                                              ->dataset('Sales By Sites' ,[$data_sales_by_sites_average])
//	                                             ->colors(['#2879f
		    ->responsive(false);




	    $sites_owned_by_group_by_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                                         ->title('Number Of Sites By Franchise')
	                                                         ->labels($sites_owned_by_group_by_franchise->pluck('franchise_name')->toArray())
	                                                         ->dataset('Franchise' ,$sites_owned_by_group_by_franchise->pluck('number_of_franchises')->toArray())
	                                                         ->responsive(false);

	    $sites_owned_by_group_by_region_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                                                ->title('Number Of Franchises By Region')
	                                                                ->labels($sites_owned_by_group_by_region_franchise->pluck('region')->toArray())
	                                                                ->dataset('Franchise' ,$sites_owned_by_group_by_region_franchise->pluck('number_of_franchises')->toArray())
	                                                                ->responsive(false);

	    $sales_by_franchise_bar_chart = Charts::create('donut', 'chartjs')
	                                          ->title('Sales By Franchise (YTD)')
	                                          ->labels($sales_by_franchise->pluck('franchise_name')->toArray())
	                                          ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                          ->responsive(false);

	    $sales_average_by_franchise_bar_chart = Charts::create('pie', 'chartjs')
	                                                  ->title('Average Sales By Franchise (YTD)')
	                                                  ->labels($sales_average_by_franchise->pluck('franchise_name')->toArray())
	                                                  ->values($sales_average_by_franchise->pluck('quantity_sold')->toArray())
	                                                  ->responsive(false);

//	    $sales_by_sites_bar_chart = Charts::multi('bar', 'chartjs')
//	                                      ->title('Sales By Sites (YTD)')
//	                                      ->labels($sales_by_sites->pluck('site_name')->toArray())
//	                                      ->dataset('Sites' ,$sales_by_sites->pluck('quantity_sold')->toArray())
//	                                      ->responsive(false);
//
//	    $sales_by_sites_average_bar_chart = Charts::multi('bar', 'chartjs')
//	                                              ->title('Sales Average By Sites (YTD)')
//	                                              ->labels($sales_by_sites_average->pluck('site_name')->toArray())
//	                                              ->dataset('Sites' ,$sales_by_sites_average->pluck('quantity_sold')->toArray())
//	                                              ->responsive(false);

	    $detail_reports = DB::table('business_groups')
	                        ->leftJoin('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                        ->leftJoin('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                        ->where('business_groups.id' , $id)
	                        ->where('sites.status' , 0)
	                        ->select(    'sites.name AS site_name' , 'sites.province AS province' , 'franchises.name as franchise_name' , 'sites.id AS site_id'   )
	                        ->groupBy('sites.name' , 'sites.province' , 'franchises.name' , 'sites.id')
	                        ->orderBy('province' , 'ASC')
	                        ->get();



	    return view('business_groups.search_dashboard' , compact('sites_owned_by_group_by_franchise_bar_chart' , 'sites_owned_by_group_by_region_franchise_bar_chart' ,'sales_by_franchise_bar_chart' , 'site' , 'sales_average_by_franchise_bar_chart' , 'sales_by_sites_bar_chart'  , 'sales_by_sites_average_bar_chart' , 'detail_reports' ,'business_group_id' ,'business_group_id'));

    }



    public function filter_business_groups_report_by_quater(Request $request , $id) {

	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('business_groups.id' , $id)
	              ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->first();

	    $this->validate($request , [
		    'from' => 'required',
		    'to' => 'required',
	    ],
		    [
			    'from.required' => 'Please provide start date',
			    'to.required' => 'Please provide end date',
		    ]
	    );

	    $from = $request->from ;
	    $to = $request->to ;
	    $business_group_id = $id;



	    $sites_owned_by_group = DB::table('business_groups')
	                              ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                              ->where('business_groups.id' , $id)
	                              ->where('sites.status' , 0)
	                              ->select('business_groups.name AS group_name' , 'business_groups.business_type AS business_type' , DB::raw("COUNT(sites.id) AS number_of_sites") )
	                              ->groupBy('business_groups.name' , 'business_groups.business_type')
	                              ->get();

	    $sites_owned_by_group_by_franchise = DB::table('business_groups')
	                                           ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                           ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                           ->where('business_groups.id' , $id)
	                                           ->where('sites.status' , 0)
	                                           ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , 'franchises.name AS franchise_name' )
	                                           ->groupBy('franchise_name')
	                                           ->get();

	    $sites_owned_by_group_by_region_franchise = DB::table('business_groups')
	                                                  ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                                  ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                                  ->where('business_groups.id' , $id)
	                                                  ->where('sites.status' , 0)
	                                                  ->select(   DB::raw("COUNT(sites.franchise_id) AS number_of_franchises") , DB::raw("CONCAT(franchises.name , ' - ' , sites.province ) AS region" )   )
	                                                  ->groupBy('region')
	                                                  ->orderBy('sites.province' , 'ASC')
	                                                  ->get();

	    $sales_by_franchise = DB::table('business_groups')
	                            ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                            ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                            ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                            ->where('business_groups.id' , $id)
	                            ->where('sites.status' , 0)
	                            ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , '=' , $request->from)
	                            ->where(DB::raw('QUARTER(quantity_solds.date_captured)' ) , '=' , $request->to)
	                            ->select(   DB::raw("SUM(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
	                            ->groupBy('franchise_name')
	                            ->get();

	    $sales_average_by_franchise = DB::table('business_groups')
	                                    ->join('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                                    ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                                    ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                                    ->where('business_groups.id' , $id)
	                                    ->where('sites.status' , 0)
		                                ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , '=' , $request->from)
		                                ->where(DB::raw('QUARTER(quantity_solds.date_captured)' ) , '=' , $request->to)
	                                    ->select(   DB::raw("AVG(quantity_solds.quantity_sold) AS quantity_sold") , 'franchises.name AS franchise_name'    )
	                                    ->groupBy('franchise_name')
	                                    ->get();

	    $sales_by_sites = DB::select("
		        SELECT SUM(quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND sites.status = 0
				AND YEAR(quantity_solds.date_captured) = '$from'
				AND QUARTER(quantity_solds.date_captured) = '$to'
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");





	    $sales_by_sites_average = DB::select("
	        SELECT AVG (quantity_solds.quantity_sold) AS quantity_sold , sites.name AS site_name
				FROM sites
				LEFT JOIN business_groups
				ON sites.business_group_id = business_groups.id
				LEFT JOIN quantity_solds
				ON quantity_solds.site_id = sites.id
				WHERE business_groups.id = $id
				AND sites.status = 0
				AND YEAR(quantity_solds.date_captured) = '$from'
				AND QUARTER(quantity_solds.date_captured) = '$to'
				GROUP BY sites.name
				ORDER BY sites.name ASC
	    ");


	    $data_sales_by_sites = '';
	    $mac_sales_by_sites = array();
	    foreach ($sales_by_sites as $povp24) {
		    $data_sales_by_sites = $data_sales_by_sites.$povp24->quantity_sold.',';
		    $mac_sales_by_sites[] = $povp24->site_name;
	    }

	    $sales_by_sites_bar_chart = Charts::multi('bar', 'chartjs')
	                                      ->title('Sales By Sites')
	                                      ->labels($mac_sales_by_sites)
	                                      ->dataset('Sales By Sites' ,[$data_sales_by_sites])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                          ->responsive(false);

	    $data_sales_by_sites_average = '';
	    $mac_sales_by_sites_average = array();
	    foreach ($sales_by_sites_average as $povp24) {
		    $data_sales_by_sites_average  = $data_sales_by_sites_average . $povp24->quantity_sold . ',';
		    $mac_sales_by_sites_average[] = $povp24->site_name;
	    }


	    $sales_by_sites_average_bar_chart = Charts::multi('bar', 'chartjs')
	                                              ->title('Average Sales By Sites')
	                                              ->labels($mac_sales_by_sites_average)
	                                              ->dataset('Sales By Sites' ,[$data_sales_by_sites_average])
//	                                             ->colors(['#2879f
                                                  ->responsive(false);




	    $sites_owned_by_group_by_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                                         ->title('Number Of Sites By Franchise')
	                                                         ->labels($sites_owned_by_group_by_franchise->pluck('franchise_name')->toArray())
	                                                         ->dataset('Franchise' ,$sites_owned_by_group_by_franchise->pluck('number_of_franchises')->toArray())
	                                                         ->responsive(false);

	    $sites_owned_by_group_by_region_franchise_bar_chart = Charts::multi('bar', 'chartjs')
	                                                                ->title('Number Of Franchises By Region')
	                                                                ->labels($sites_owned_by_group_by_region_franchise->pluck('region')->toArray())
	                                                                ->dataset('Franchise' ,$sites_owned_by_group_by_region_franchise->pluck('number_of_franchises')->toArray())
	                                                                ->responsive(false);

	    $sales_by_franchise_bar_chart = Charts::create('donut', 'chartjs')
	                                          ->title('Sales By Franchise (YTD)')
	                                          ->labels($sales_by_franchise->pluck('franchise_name')->toArray())
	                                          ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                          ->responsive(false);

	    $sales_average_by_franchise_bar_chart = Charts::create('pie', 'chartjs')
	                                                  ->title('Average Sales By Franchise (YTD)')
	                                                  ->labels($sales_average_by_franchise->pluck('franchise_name')->toArray())
	                                                  ->values($sales_average_by_franchise->pluck('quantity_sold')->toArray())
	                                                  ->responsive(false);


	    $detail_reports = DB::table('business_groups')
	                        ->leftJoin('sites' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                        ->leftJoin('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                        ->where('business_groups.id' , $id)
	                        ->where('sites.status' , 0)
	                        ->select(    'sites.name AS site_name' , 'sites.province AS province' , 'franchises.name as franchise_name' , 'sites.id AS site_id'   )
	                        ->groupBy('sites.name' , 'sites.province' , 'franchises.name' , 'sites.id')
	                        ->orderBy('province' , 'ASC')
	                        ->get();

	    return view('business_groups.search_dashboard' , compact('sites_owned_by_group_by_franchise_bar_chart' , 'sites_owned_by_group_by_region_franchise_bar_chart' ,'sales_by_franchise_bar_chart' , 'site' , 'sales_average_by_franchise_bar_chart' , 'sales_by_sites_bar_chart'  , 'sales_by_sites_average_bar_chart' , 'detail_reports' ,'business_group_id' ,'business_group_id'));

    }




}
