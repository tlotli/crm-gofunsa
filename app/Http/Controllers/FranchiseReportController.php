<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\BusinessGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;

class FranchiseReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function reports() {
    	$number_of_franchises = DB::table('sites')
	                            ->rightJoin('franchises' , 'franchises.id' , '=' , 'sites.franchise_id')
	                            ->select(DB::raw('COUNT(sites.franchise_id) AS franchise_count') , 'franchises.name AS franchise_name')
		                        ->where('sites.status' , 0)
		                        ->groupBy('franchise_name')
	                            ->get();

	    $number_of_franchises_region = DB::select("
	        SELECT COUNT(sites.franchise_id) AS franchise_count , CONCAT(franchises.name , ' - ' , sites.province) AS franchise_name
			FROM sites LEFT JOIN franchises ON franchises.id = sites.franchise_id
			WHERE sites.status = 0 
			GROUP BY franchises.name , sites.province
			ORDER BY sites.province
	    ");

	    $sales_by_franchise = DB::table('franchises')
	                          ->leftJoin('sites' , 'sites.franchise_id' , '=' , 'franchises.id')
	                          ->leftJoin('quantity_solds' , 'sites.id' , '=' , 'quantity_solds.site_id')
		                      ->where('sites.status' , 0)
		                      ->where(DB::raw('YEAR(quantity_solds.date_captured)') , Carbon::now()->year)
		                      ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold') , 'franchises.name as franchise_name')
		                      ->groupBy('franchises.name')
	                          ->get();

	    $sales_by_franchise_trend = DB::select("	SELECT SUM(quantity_solds.quantity_sold) AS quantity_sold , CONCAT(MONTHNAME(quantity_solds.date_captured) , ' - ' , franchises.name ) AS sales_by_franchise
													   	FROM franchises
														LEFT JOIN sites
														ON (sites.franchise_id = franchises.id )
														LEFT JOIN quantity_solds    
														ON (sites.id = quantity_solds.site_id)
														WHERE sites.status = 0 
														AND YEAR(quantity_solds.date_captured) = YEAR(CURDATE()) 
														GROUP BY sales_by_franchise
														ORDER BY  quantity_sold ASC
											");


//	    return $sales_by_franchise_trend ;

	    $data_24 = '';
	    $mac_24 = array();
	    foreach ($number_of_franchises_region as $povp24) {
		    $data_24 = $data_24.$povp24->franchise_count.',';
		    $mac_24[] = $povp24->franchise_name;
	    }

	    $number_of_franchises_region_bar = Charts::multi('bar', 'chartjs')
	                            ->title('Number Of Franchises By Region')
	                            ->labels($mac_24)
	                            ->dataset('Number Of Franchises' ,[$data_24])
		                        ->colors(['#2879ff', '#e91e63', '#fec107'])
	                            ->responsive(false);


	    $number_of_franchises_pie = Charts::create('pie', 'chartjs')
	                                      ->title('Number Of Franchises')
		                                  ->labels($number_of_franchises->pluck('franchise_name')->toArray())
		                                  ->values($number_of_franchises->pluck('franchise_count')->toArray())
		                                    ->colors([
			                                    '#283593',
			                                    "#5553ce",
			                                    "#297ef6",
			                                    "#e52b4c",
			                                    "#ffa91c",
			                                    "#32c861"
			                                    ])
	                                      ->responsive(false);


	    $sales_by_franchise_donut = Charts::create('donut', 'chartjs')
	                                ->title('Sales By Franchise (YTD)')
	                                ->labels($sales_by_franchise->pluck('franchise_name')->toArray())
	                                ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                ->colors([
		                                '#283593',
		                                "#5553ce",
		                                "#297ef6",
		                                "#e52b4c",
		                                "#ffa91c",
		                                "#32c861"
	                                ])
	                                ->responsive(false);

	    $data_sales_by_franchise_trend = '';
	    $mac_sales_by_franchise_trend = array();
	    foreach ($sales_by_franchise_trend as $povp24) {
		    $data_sales_by_franchise_trend = $data_sales_by_franchise_trend.$povp24->quantity_sold.',';
		    $mac_sales_by_franchise_trend[] = $povp24->sales_by_franchise;
	    }

	    $data_sales_by_franchise_trend_bar = Charts::multi('bar', 'chartjs')
	                                             ->title('Monthly Sales By Franchise (YTD)')
	                                             ->labels($mac_sales_by_franchise_trend)
	                                             ->dataset('Sales By Franchise' ,[$data_sales_by_franchise_trend])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                             ->responsive(false);

	    return view('reports.franchisereport' , compact('number_of_franchises_region_bar' ,'number_of_franchises_pie' ,'sales_by_franchise_donut' ,'data_sales_by_franchise_trend_bar'));

    }

    public function filter_reports(Request $request) {


    	$this->validate($request , [
    		'from' => 'required',
    		'to' => 'required',
	    ],
	    [
	    	'from.required' => 'Start date is required',
	    	'to.required' => 'End date is required',
	    ]);

	    $request_from = $request->from ;
	    $request_to = $request->to ;

	    $number_of_franchises = DB::table('sites')
	                              ->leftJoin('franchises' , 'sites.franchise_id' , '=' , 'franchises.id')
	                              ->select(DB::raw('COUNT(sites.franchise_id) AS franchise_count') , 'franchises.name AS franchise_name')
	                              ->where('sites.status' , 0)
	                              ->groupBy('franchise_name')
	                              ->get();


	    $number_of_franchises_region = DB::table('sites')
		                                ->leftJoin('franchises' , 'franchises.id' , '=' ,'sites.franchise_id')
		                                ->select(DB::raw("CONCAT(franchises.name , ' - ' , sites.province) AS franchise_name") , DB::raw("COUNT(sites.business_group_id)  AS franchise_count") )
		                                ->where('sites.status' , 0)
									    ->groupBy('franchises.name')
									    ->get();


	    $sales_by_franchise = DB::table('franchises')
	                            ->leftJoin('sites' , 'sites.franchise_id' , '=' , 'franchises.id')
	                            ->leftJoin('quantity_solds' , 'sites.id' , '=' , 'quantity_solds.site_id')
	                            ->where('sites.status' , 0)
		                        ->where('quantity_solds.date_captured' , '>=' , $request_from)
		                        ->where('quantity_solds.date_captured' , '<=' , $request_to)
	                            ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold') , 'franchises.name as franchise_group_name')
	                            ->groupBy('franchises.name')
	                            ->get();




	    $sales_by_franchise_trend = DB::table('sites')
		                            ->leftJoin('franchises' , 'sites.franchise_id' , '=' , 'franchises.id' )
		                            ->leftJoin('quantity_solds' , 'sites.id' , '=' , 'quantity_solds.site_id')
		                            ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold' ) , DB::raw(" CONCAT(MONTHNAME(quantity_solds.date_captured) , ' - ' , franchises.name ) sales_by_franchise"))
								    ->where('sites.status' , 0)
								    ->where('quantity_solds.date_captured' , '>=' , $request_from)
								    ->where('quantity_solds.date_captured' , '<=' , $request_to)
								    ->groupBy("sales_by_franchise")
								    ->orderBy('quantity_sold', 'ASC')
								    ->get();


		$data_24 = '';
	    $mac_24 = array();
	    foreach ($number_of_franchises_region as $povp24) {
		    $data_24 = $data_24.$povp24->franchise_count.',';
		    $mac_24[] = $povp24->franchise_name;
	    }

	    $number_of_franchises_region_bar = Charts::multi('bar', 'chartjs')
	                                             ->title('Number Of Franchises By Region')
	                                             ->labels($mac_24)
	                                             ->dataset('Number Of Franchises' ,[$data_24])
	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                             ->responsive(false);


	    $number_of_franchises_pie = Charts::create('pie', 'chartjs')
	                                      ->title('Number Of Franchises')
	                                      ->labels($number_of_franchises->pluck('franchise_name')->toArray())
	                                      ->values($number_of_franchises->pluck('franchise_count')->toArray())
	                                      ->colors([
		                                      '#283593',
		                                      "#5553ce",
		                                      "#297ef6",
		                                      "#e52b4c",
		                                      "#ffa91c",
		                                      "#32c861"
	                                      ])
	                                      ->responsive(false);


	    $sales_by_franchise_donut = Charts::create('donut', 'chartjs')
	                                      ->title("Sales By Franchise " . ' From ' . $request_from  . ' To ' . $request_to)
	                                      ->labels($sales_by_franchise->pluck('franchise_group_name')->toArray())
	                                      ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                      ->colors([
		                                      '#283593',
		                                      "#5553ce",
		                                      "#297ef6",
		                                      "#e52b4c",
		                                      "#ffa91c",
		                                      "#32c861"
	                                      ])
	                                      ->responsive(false);

	    $data_sales_by_franchise_trend = '';
	    $mac_sales_by_franchise_trend = array();
	    foreach ($sales_by_franchise_trend as $povp24) {
		    $data_sales_by_franchise_trend = $data_sales_by_franchise_trend.$povp24->quantity_sold.',';
		    $mac_sales_by_franchise_trend[] = $povp24->sales_by_franchise;
	    }

	    $data_sales_by_franchise_trend_bar = Charts::multi('bar', 'chartjs')
	                                               ->title('Monthly Sales By Franchise'  . ' From ' . $request_from  . ' To ' . $request_to)
	                                               ->labels($mac_sales_by_franchise_trend)
	                                               ->dataset('Sales By Franchise' ,[$data_sales_by_franchise_trend])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                                   ->responsive(false);

	    return view('reports.search_franchisereport' , compact('number_of_franchises_region_bar' ,'number_of_franchises_pie' ,'sales_by_franchise_donut' ,'data_sales_by_franchise_trend_bar' , '$request_from' ,'$request_to'));

    }

    public function filter_franchise_reports_by_quater(Request $request) {

	    $this->validate($request , [
		    'from' => 'required',
	    ],
		    [
			    'from.required' => 'Date is required',
		    ]);

	    $request_from = $request->from ;
	    $request_to = $request->to ;

	    $number_of_franchises = DB::table('sites')
	                              ->leftJoin('franchises' , 'sites.franchise_id' , '=' , 'franchises.id')
	                              ->select(DB::raw('COUNT(sites.franchise_id) AS franchise_count') , 'franchises.name AS franchise_name')
	                              ->where('sites.status' , 0)
	                              ->groupBy('franchise_name')
	                              ->get();


	    $number_of_franchises_region = DB::table('sites')
	                                     ->leftJoin('franchises' , 'franchises.id' , '=' ,'sites.franchise_id')
	                                     ->select(DB::raw("CONCAT(franchises.name , ' - ' , sites.province) AS franchise_name") , DB::raw("COUNT(sites.business_group_id)  AS franchise_count") )
	                                     ->where('sites.status' , 0)
	                                     ->groupBy('franchises.name')
	                                     ->get();


	    $sales_by_franchise = DB::table('franchises')
	                            ->leftJoin('sites' , 'sites.franchise_id' , '=' , 'franchises.id')
	                            ->leftJoin('quantity_solds' , 'sites.id' , '=' , 'quantity_solds.site_id')
	                            ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold') , 'franchises.name as franchise_group_name')
		                        ->where('sites.status' , 0)
		                        ->whereRaw( "YEAR(quantity_solds.date_captured)  =  $request_from ")
		                        ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request_to ")
	                            ->groupBy('franchises.name')
	                            ->get();



//	    $sales_by_franchise = DB::select("
//
//	            SELECT SUM(quantity_solds.date_captured)
//				FROM quantity_solds
//				WHERE QUARTER(quantity_solds.date_captured) = QUARTER('$request_from')
//
//	    ");


//	    dd($sales_by_franchise)  ;



	    $sales_by_franchise_trend = DB::table('sites')
	                                  ->leftJoin('franchises' , 'sites.franchise_id' , '=' , 'franchises.id' )
	                                  ->leftJoin('quantity_solds' , 'sites.id' , '=' , 'quantity_solds.site_id')
	                                  ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS quantity_sold' ) , DB::raw(" CONCAT(MONTHNAME(quantity_solds.date_captured) , ' - ' , franchises.name ) sales_by_franchise"))
	                                  ->where('sites.status' , 0)
		                              ->whereRaw( "YEAR(quantity_solds.date_captured)  =  $request_from ")
		                              ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request_to ")
		                              ->groupBy("sales_by_franchise")
	                                  ->orderBy('quantity_sold', 'ASC')
	                                  ->get();


	    $data_24 = '';
	    $mac_24 = array();
	    foreach ($number_of_franchises_region as $povp24) {
		    $data_24 = $data_24.$povp24->franchise_count.',';
		    $mac_24[] = $povp24->franchise_name;
	    }

	    $number_of_franchises_region_bar = Charts::multi('bar', 'chartjs')
	                                             ->title('Number Of Franchises By Region')
	                                             ->labels($mac_24)
	                                             ->dataset('Number Of Franchises' ,[$data_24])
	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                             ->responsive(false);


	    $number_of_franchises_pie = Charts::create('pie', 'chartjs')
	                                      ->title('Number Of Franchises')
	                                      ->labels($number_of_franchises->pluck('franchise_name')->toArray())
	                                      ->values($number_of_franchises->pluck('franchise_count')->toArray())
	                                      ->colors([
		                                      '#283593',
		                                      "#5553ce",
		                                      "#297ef6",
		                                      "#e52b4c",
		                                      "#ffa91c",
		                                      "#32c861"
	                                      ])
	                                      ->responsive(false);


	    $sales_by_franchise_donut = Charts::create('donut', 'chartjs')
	                                      ->title('Sales By Franchise ' . ' Year ' . $request_from . ' - Quater ' . $request_to )
	                                      ->labels($sales_by_franchise->pluck('franchise_group_name')->toArray())
	                                      ->values($sales_by_franchise->pluck('quantity_sold')->toArray())
	                                      ->colors([
		                                      '#283593',
		                                      "#5553ce",
		                                      "#297ef6",
		                                      "#e52b4c",
		                                      "#ffa91c",
		                                      "#32c861"
	                                      ])
	                                      ->responsive(false);

	    $data_sales_by_franchise_trend = '';
	    $mac_sales_by_franchise_trend = array();
	    foreach ($sales_by_franchise_trend as $povp24) {
		    $data_sales_by_franchise_trend = $data_sales_by_franchise_trend.$povp24->quantity_sold.',';
		    $mac_sales_by_franchise_trend[] = $povp24->sales_by_franchise;
	    }

	    $data_sales_by_franchise_trend_bar = Charts::multi('bar', 'chartjs')
	                                               ->title('Monthly Sales By Franchise ' . ' Year ' . $request_from . ' - Quater ' . $request_to)
	                                               ->labels($mac_sales_by_franchise_trend)
	                                               ->dataset('Sales By Franchise' ,[$data_sales_by_franchise_trend])
//	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
                                                   ->responsive(false);

	    return view('reports.filter_reports_by_quater_franchise' , compact('number_of_franchises_region_bar' ,'number_of_franchises_pie' ,'sales_by_franchise_donut' ,'data_sales_by_franchise_trend_bar'));



    }
}
