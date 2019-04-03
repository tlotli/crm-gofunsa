<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\BusinessGroup;
use GoFunCrm\BusinessOwner;
use GoFunCrm\Charts\LineChart;
use GoFunCrm\FileUploads;
use GoFunCrm\Franchise;
use GoFunCrm\Log;
use GoFunCrm\Province;
use GoFunCrm\QuantitySold;
use GoFunCrm\SetPrice;
use GoFunCrm\Site;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Softon\SweetAlert\Facades\SWAL;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller
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
    	$sites = DB::table('sites')
		         ->join('business_groups' , 'business_groups.id' , '=' , 'sites.business_group_id')
		         ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		         ->join('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
		         ->select('business_owners.name AS owned_by' , 'business_owners.email AS owners_email' , 'business_owners.email AS owners_email' ,'business_owners.contact_number AS contact_number' ,'business_groups.name AS business_group_name' , 'franchises.name as franchise_name', 'business_groups.business_type AS business_type' , 'sites.name AS site_name' , 'sites.province AS province' , 'sites.status AS status' , 'sites.id AS id' , 'business_groups.id AS business_group_id')
		         ->get();
        return view('sites.index' , compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$franchise = Franchise::where('status' , 0)->get();
    	$business_groups = BusinessGroup::where('status' , 0)->get();
    	$business_owners = BusinessOwner::all();
    	$province = Province::all();


    	if(empty($business_groups) || empty($business_owners)) {
		    SWAL::message('Warning','Please create a business group or add business owners to the system before proceeding','warning',[
			    'timer'=>9000,
		    ]);
		    return redirect()->back();
	    }
	    else {
		    return view('sites.create' , compact('business_owners' , 'business_groups' ,'province', 'franchise'));
	    }

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
        	'franchise_id' => 'required',
        	'business_group_id' => 'required',
        	'address' => 'required',
        	'city' => 'required',
        	'province' => 'required',
        ],
	    [
	        'name.required' => 'Site name is required',
	        'franchise_id.required' => 'Please select the franchise to which the site belongs too',
	        'business_group_id.required' => 'Please select business group for the site',

	        'address.required' => 'City field is required',
	        'city.required' => 'Please provide an address for the site',
	        'province.required' => 'Please provide an address for the site',
	    ]);

        $site = new Site();
        $site->name = $request->name ;
        $site->franchise_id = $request->franchise_id ;
        $site->business_group_id = $request->business_group_id ;
        $site->address = $request->address ;
        $site->city = $request->city ;
        $site->province = $request->province ;
        $site->user_id = Auth::id() ;
        $site->status = 0 ;
        $site->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Added ' . $site->name ;
	    $log->log_type = 'Store Management';
	    $log->save();

	    SWAL::message('Success','Site was created','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('business_sites.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$visitations = DB::table('users')
		               ->join('visitations' , 'visitations.visisted_by' , '=' , 'users.id')
		               ->join('sites' , 'sites.id' , '=' , 'visitations.site_id')
		               ->where('sites.id' , $id)
		               ->select('visitations.date_visited AS date_visited' , 'users.name AS user_name' , 'visitations.reason_for_visit AS reason_for_visit' , 'visitations.notes AS notes')
		               ->get();

    	$site = DB::table('business_owners')
	            ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
		        ->where('sites.id' , $id)
	            ->select('sites.*' , 'business_owners.name AS owner_name')
	            ->first();

    	$soh = DB::table('users')
	             ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
	             ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
	             ->where('sites.id' , $id)
	             ->select('stock_on_hands.notes AS notes' , 'users.name AS captured_by' , 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' , 'stock_on_hands.id AS id')
		         ->orderBy('stock_on_hands.date_captured' ,'desc')
	             ->get();

    	$qs = DB::table('users')
	            ->join('quantity_solds' , 'quantity_solds.captured_by' , '=' , 'users.id')
	            ->join('sites' , 'sites.id' , '=' , 'quantity_solds.site_id')
	            ->where('sites.id' , $id)
	            ->select('quantity_solds.notes AS notes' , 'users.name AS captured_by' , 'quantity_solds.quantity_sold AS quantity_sold' , 'quantity_solds.date_captured AS date_captured' , 'quantity_solds.id AS id')
	            ->orderBy('quantity_solds.date_captured' ,'desc')
	            ->get();

    	$documents = DB::table('users')
	              ->join('file_uploads' , 'file_uploads.user_id' , '=' , 'users.id')
	              ->where('file_uploads.site_id' , $id)
	              ->select('file_uploads.*' , 'users.name AS user_name')
	              ->get();

	    return view('sites.show' , compact('site' , 'visitations' , 'soh' , 'qs' , 'chart' ,'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$site = Site::find($id);
	    $franchise = Franchise::where('status' , 0)->get();
	    $business_groups = BusinessGroup::where('status' , 0)->get();
	    $business_owners = BusinessOwner::all();
	    $province = Province::all();

	    return view('sites.edit' , compact('business_groups' , 'business_owners' ,'province','site' , 'franchise'));
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
        $site = Site::find($id);
        $site_name = $site->name ;

	    $this->validate($request , [
		    'name' => 'required',
		    'franchise_id' => 'required',
		    'business_group_id' => 'required',
		    'address' => 'required',
		    'city' => 'required',
		    'province' => 'required',
	    ],
		    [
			    'name.required' => 'Site name is required',
			    'franchise_id.required' => 'Please select the franchise to which the site belongs too',
			    'business_group_id.required' => 'Please select business group for the site',

			    'address.required' => 'City field is required',
			    'city.required' => 'Please provide an address for the site',
			    'province.required' => 'Please provide an address for the site',
		    ]);


	    $site->name = $request->name ;
	    $site->status = $request->status ;
	    $site->franchise_id = $request->franchise_id ;
	    $site->business_group_id = $request->business_group_id ;
	    $site->address = $request->address ;
	    $site->city = $request->city ;
	    $site->province = $request->province ;
	    $site->user_id = Auth::id() ;
//	    $site->status = 0 ;
	    $site->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Updated  ' . $site_name . ' created at ' . $site->updated_at ;
	    $log->log_type = 'Store Management';
	    $log->save();


	    SWAL::message('Success','Site was updated','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('business_sites.index'));
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

    public function reports($id) {


    	$find_site = Site::find($id)->first() ;
    	$site_id = $find_site->id;

	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->get();

//	   $soh_line_chart_ytd = DB::table('users')
//	                        ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
//	                        ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
//	                        ->where('sites.id' , $id)
//	                        ->where(DB::raw('YEAR(stock_on_hands.date_captured)' ) , Carbon::now()->year)
//	                        ->select( 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' )
//	                        ->groupBy('stock_on_hands.date_captured')
//			                ->orderBy('stock_on_hands.date_captured' , 'ASC')
//	                        ->get();
//
//	    $soh_line_mtd = DB::table('users')
//	                      ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
//	                      ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
//	                      ->where('sites.id' , $id)
//	                      ->where(DB::raw('MONTH(stock_on_hands.date_captured)' ) , Carbon::now()->month)
//	                      ->select( 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' )
//	                      ->latest('stock_on_hands.date_captured')
//	                      ->get();
//
//	    $soh_line_chart = Charts::multi('line', 'chartjs')
//					            ->title('Stock On Hand (YTD)')
//					            ->labels($soh_line_chart_ytd->pluck('date_captured')->toArray())
//					            ->dataset('Stock On Hand' ,$soh_line_chart_ytd->pluck('soh')->toArray())
////					            ->dataset('Stock Value' ,[$data_24])
//					            ->responsive(false);
//
//	    $soh_line_chart_mtd = Charts::multi('bar', 'chartjs')
//	                            ->title('Stock On Hand (MTD)')
//	                            ->labels($soh_line_mtd->pluck('date_captured')->toArray())
//	                            ->dataset('Stock On Hand' ,$soh_line_mtd->pluck('soh')->toArray())
//                                ->responsive(false);

		/////////////////////////////////////////////////////////////////////////Stock Sold///////////////////////////////////////////////////////////////////
	    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	    $stock_sold_to_date =  DB::table('quantity_solds')
	                           ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
		                       ->where('quantity_solds.site_id' , $id)
		                       ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
	                           ->select('quantity_solds.quantity_sold AS quantity_sold' , 'quantity_solds.date_captured AS date_captured')
		                       ->orderBy('date_captured' , 'ASC')
	                           ->get();


	    $stock_sold_to_date_chart = Charts::multi('line', 'chartjs')
	                            ->title('Stock Sold(YTD)')
	                            ->labels($stock_sold_to_date->pluck('date_captured')->toArray())
	                            ->dataset('Stock Sold' ,$stock_sold_to_date->pluck('quantity_sold')->toArray())
	                            ->responsive(false);

	    $stock_sold_to_date_month =  DB::table('quantity_solds')
	                                   ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
	                                   ->where('quantity_solds.site_id' , $id)
	                                   ->where(DB::raw('MONTH(quantity_solds.date_captured)' ) , DB::raw('MONTH(NOW())') )
		                               ->select( DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold' ) )
		                               ->get();


	    $stock_sold_to_date_chart_month = Charts::multi('bar', 'chartjs')
	                                            ->title('Stock Sold(MTD)')
	                                            ->labels($stock_sold_to_date_month->pluck('date_captured')->toArray())
	                                            ->dataset('Stock Sold' ,$stock_sold_to_date_month->pluck('quantity_sold')->toArray())
//	                                            ->dataset('Stock Sold Value' ,$stock_sold_to_date_month_value->pluck('quantity_sold')->toArray())
                                                ->responsive(false);

	    return view('sites.reports' , compact('chart' ,'soh_line_chart' ,'site' ,'soh_line_chart_mtd' ,'stock_sold_to_date_chart' , 'stock_sold_to_date_chart_month' , 'site_id' ,'stock_sold_to_date_month'));
    }


    public function site_search(Request $request , $id) {

    	$this->validate($request , [
    		'from' => 'required',
    		'to' => 'required',
	    ],
		[
	        'from.required' => 'Please provide start date',
	        'to.required' => 'Please provide end date',
		]
	    );

	    $site_id =  $id;
	    $from = $request->from ;
	    $to = $request->to ;

	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->get();


	    $soh_line_chart_ytd = DB::table('users')
	                            ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
	                            ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
	                            ->where('sites.id' , $id)
		                        -> where('stock_on_hands.date_captured' , '>=' , $request->from)
		                        -> where('stock_on_hands.date_captured' , '<=' , $request->to)
	                            ->select( 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' )
                                ->orderBy('stock_on_hands.date_captured' , 'ASC')
	                            ->get();


	    $soh_line_mtd = DB::table('users')
	                      ->join('stock_on_hands' , 'stock_on_hands.captured_by' , '=' , 'users.id')
	                      ->join('sites' , 'sites.id' , '=' , 'stock_on_hands.site_id')
	                      ->where('sites.id' , $id)
	                      ->where(DB::raw('MONTH(stock_on_hands.date_captured)' ) , Carbon::now()->month)
	                      ->select( 'stock_on_hands.soh AS soh' , 'stock_on_hands.date_captured AS date_captured' )
	                      ->latest('stock_on_hands.date_captured')
	                      ->get();

	    $soh_line_chart = Charts::multi('line', 'chartjs')
	                            ->title('Stock On Hand (YTD)')
	                            ->labels($soh_line_chart_ytd->pluck('date_captured')->toArray())
	                            ->dataset('Stock On Hand' ,$soh_line_chart_ytd->pluck('soh')->toArray())
	                            ->responsive(false);

	    $soh_line_chart_mtd = Charts::multi('bar', 'chartjs')
	                                ->title('Stock On Hand (MTD)')
	                                ->labels($soh_line_mtd->pluck('date_captured')->toArray())
	                                ->dataset('Stock On Hand' ,$soh_line_mtd->pluck('soh')->toArray())
	                                ->responsive(false);

	    /////////////////////////////////////////////////////////////////////////Stock Sold///////////////////////////////////////////////////////////////////
	    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	    $stock_sold_to_date =  DB::table('quantity_solds')
	                             ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
	                             ->where('quantity_solds.site_id' , $id)
	                             ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                         ->where('quantity_solds.date_captured' , '<=' , $request->to)
	                             ->select('quantity_solds.quantity_sold AS quantity_sold' , 'quantity_solds.date_captured AS date_captured')
		                         ->orderBy('date_captured' , 'ASC')
	                             ->get();


	    $stock_sold_to_date_chart = Charts::multi('line', 'chartjs')
	                                      ->title('Stock Sold(YTD)')
	                                      ->labels($stock_sold_to_date->pluck('date_captured')->toArray())
	                                      ->dataset('Stock Sold' ,$stock_sold_to_date->pluck('quantity_sold')->toArray())
	                                      ->responsive(false);


	    $stock_sold_to_date_month =  DB::table('quantity_solds')
	                                   ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
	                                   ->where('quantity_solds.site_id' , $id)
	                                   ->where(DB::raw('Month(quantity_solds.date_captured)' ) , Carbon::now()->month)
	                                   ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold' ))
//		                               ->groupBy('date_captured')
		                               ->orderBy('date_captured' , 'ASC')
	                                   ->get();

	    $stock_sold_to_date_chart_month = Charts::multi('bar', 'chartjs')
	                                            ->title('Stock Sold(MTD)')
	                                            ->labels($stock_sold_to_date_month->pluck('date_captured')->toArray())
	                                            ->dataset('Stock Sold' ,$stock_sold_to_date_month->pluck('quantity_sold')->toArray())
	                                            ->responsive(false);

	    return view('sites.report_search' , compact('chart' ,'soh_line_chart' ,'site' ,'soh_line_chart_mtd' ,'stock_sold_to_date_chart' , 'stock_sold_to_date_chart_month' , 'site_id'));
    }

    public function upload_files(Request $request ,$id) {
    	$this->validate($request , [
    		'documents' => 'required',
	    ]);

	    $photos = $request->file('documents');
	    $paths  = [];
	    foreach ($photos as $photo) {
		    $extension = $photo->getClientOriginalExtension();
		    $filename  = time(). '-' . $photo->getClientOriginalName()  ;
		    $paths[]   = $photo->storeAs('public/documents', $filename);

		    $documents = new FileUploads();
				    	$documents->document_name = $filename;
		                $documents->site_id = $id;
		                $documents->user_id = Auth::id();
		                $documents->save();
	    }

	    $log = new Log();
	    $log->description = Auth::user()->name . ' Uploaded the following document ' . $filename . ' at ' . $documents->created_at ;
	    $log->log_type = 'Uploads';
	    $log->save();

	    SWAL::message('Success','Documents where uploaded successfully','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('uploads' , ['id' => $id]));
    }

    public function uploads($id) {
	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->get();

	    $documents = DB::table('users')
	                   ->join('file_uploads' , 'file_uploads.user_id' , '=' , 'users.id')
	                   ->where('file_uploads.site_id' , $id)
	                   ->select('file_uploads.*' , 'users.name AS user_name')
	                   ->get();

	    return view('uploads.index' , compact('site' ,'documents'));
    }









    public function site_search_by_quater(Request $request , $id) {


	    $find_site = Site::find($id)->first() ;
	    $site_id = $id;


	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->get();





	    $stock_sold_to_date =  DB::table('quantity_solds')
	                             ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
	                             ->where('quantity_solds.site_id' , $id)
							     ->whereRaw( "YEAR(quantity_solds.date_captured)  =  $request->from ")
							     ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request->to ")
	                             ->select('quantity_solds.quantity_sold AS quantity_sold' , 'quantity_solds.date_captured AS date_captured')
		                         ->orderBy('date_captured' , 'ASC')
	                             ->get();


	    $stock_sold_to_date_chart = Charts::multi('line', 'chartjs')
	                                      ->title('Stock Sold(YTD)')
	                                      ->labels($stock_sold_to_date->pluck('date_captured')->toArray())
	                                      ->dataset('Stock Sold' ,$stock_sold_to_date->pluck('quantity_sold')->toArray())
	                                      ->responsive(false);


	    $stock_sold_to_date_month =  DB::table('quantity_solds')
	                                   ->join('sites' , 'sites.id' , '=' ,'quantity_solds.site_id')
	                                   ->where('quantity_solds.site_id' , $id)
									   ->where(DB::raw('Month(quantity_solds.date_captured)' ) , Carbon::now()->month)
									   ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold' ) )
//									   ->groupBy('date_captured')
									   ->orderBy('date_captured' , 'ASC')
									   ->get();

	    $stock_sold_to_date_chart_month = Charts::multi('bar', 'chartjs')
	                                            ->title('Stock Sold(MTD)')
	                                            ->labels($stock_sold_to_date_month->pluck('date_captured')->toArray())
	                                            ->dataset('Stock Sold' ,$stock_sold_to_date_month->pluck('quantity_sold')->toArray())
	                                            ->responsive(false);

	    return view('sites.report_search_quater' , compact('chart' ,'soh_line_chart' ,'site' ,'soh_line_chart_mtd' ,'stock_sold_to_date_chart' , 'stock_sold_to_date_chart_month' , 'site_id'));


    }


}
