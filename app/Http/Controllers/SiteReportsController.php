<?php

namespace GoFunCrm\Http\Controllers;

use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteReportsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


    public function reports() {

    	$top_ten_highest_sales = DB::table('sites')
		                         ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                         ->where(DB::raw("YEAR(quantity_solds.date_captured)") , Carbon::now()->year)
		                         ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
		                         ->groupBy('sites.name')
		                         ->limit(10)
		                         ->orderBy('sum_quantity_sold' , 'ASC')
	                             ->get();

	    $top_ten_lowest_sales = DB::table('sites')
	                               ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                               ->where(DB::raw("YEAR(quantity_solds.date_captured)") , Carbon::now()->year)
	                               ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
	                               ->groupBy('sites.name')
	                               ->limit(10)
	                               ->orderBy('sum_quantity_sold' , 'DESC')
	                               ->get();

	    $sales_by_sites = DB::table('sites')
		                  ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                  ->join('business_groups' , 'business_groups.id' , '=' , 'sites.business_group_id')
		                  ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold' ) , 'sites.name AS site_name' , 'sites.id AS site_id' , 'business_groups.id AS business_groups_id', 'sites.province AS site_province' ,'business_groups.name AS business_group_name' )
		                  ->groupBy('sites.name' , 'sites.province' )
		                  ->orderBy('sum_quantity_sold' , 'DESC')
	                      ->get();



//	    return $sales_by_sites ;

	    $top_ten_highest_sales_bar = Charts::multi('bar', 'chartjs')
	                                             ->title('Highest Top Ten Sales By Sites (YTD)')
	                                             ->labels($top_ten_highest_sales->pluck('site_name')->toArray())
	                                             ->dataset('Sales' ,$top_ten_highest_sales->pluck('sum_quantity_sold')->toArray())
	                                             ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                             ->responsive(false);

	    $top_ten_lowest_sales_bar = Charts::multi('bar', 'chartjs')
	                                       ->title('Lowest Top Ten Sales By Sites (YTD)')
	                                       ->labels($top_ten_lowest_sales->pluck('site_name')->toArray())
	                                       ->dataset('Sales' ,$top_ten_lowest_sales->pluck('sum_quantity_sold')->toArray())
	                                       ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                       ->responsive(false);

    	return view('reports.site_reports' , compact('top_ten_highest_sales_bar' ,'top_ten_lowest_sales_bar' , 'sales_by_sites'));

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

	    $top_ten_highest_sales = DB::table('sites')
	                               ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                           ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                           ->where('quantity_solds.date_captured' , '<=' , $request->to)
	                               ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
	                               ->groupBy('sites.name')
	                               ->limit(10)
	                               ->orderBy('sum_quantity_sold' , 'ASC')
	                               ->get();

	    $top_ten_lowest_sales = DB::table('sites')
	                              ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                          ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                          ->where('quantity_solds.date_captured' , '<=' , $request->to)
	                              ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
	                              ->groupBy('sites.name')
	                              ->limit(10)
	                              ->orderBy('sum_quantity_sold' , 'DESC')
	                              ->get();

	    $sales_by_sites = DB::table('sites')
	                        ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                        ->join('business_groups' , 'business_groups.id' , '=' , 'sites.business_group_id')
		                    ->where('quantity_solds.date_captured' , '>=' , $request->from)
		                    ->where('quantity_solds.date_captured' , '<=' , $request->to)
		                    ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold' ) , 'sites.name AS site_name' , 'sites.id AS site_id' , 'business_groups.id AS business_groups_id', 'sites.province AS site_province' ,'business_groups.name AS business_group_name' )
	                        ->groupBy('sites.name' , 'sites.province' )
	                        ->orderBy('sum_quantity_sold' , 'DESC')
	                        ->get();





	    $top_ten_highest_sales_bar = Charts::multi('bar', 'chartjs')
	                                       ->title('Highest Top Ten Sales By Sites (YTD)')
	                                       ->labels($top_ten_highest_sales->pluck('site_name')->toArray())
	                                       ->dataset('Sales' ,$top_ten_highest_sales->pluck('sum_quantity_sold')->toArray())
	                                       ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                       ->responsive(false);

	    $top_ten_lowest_sales_bar = Charts::multi('bar', 'chartjs')
	                                      ->title('Lowest Top Ten Sales By Sites (YTD)')
	                                      ->labels($top_ten_lowest_sales->pluck('site_name')->toArray())
	                                      ->dataset('Sales' ,$top_ten_lowest_sales->pluck('sum_quantity_sold')->toArray())
	                                      ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                      ->responsive(false);

	    return view('reports.search_site_reports' , compact('top_ten_highest_sales_bar' ,'top_ten_lowest_sales_bar' , 'sales_by_sites'));

    }



    public function filter_site_reports_by_quater(Request $request) {

	    $this->validate($request , [
		    'from' => 'required',
		    'to' => 'required',
	    ],
		    [
			    'from.required' => 'Start date is required',
			    'to.required' => 'End date is required',
		    ]);

	    $top_ten_highest_sales = DB::table('sites')
	                               ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                               ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , '=' , $request->from)
		                           ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request->to ")
	                               ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
	                               ->groupBy('sites.name')
	                               ->limit(10)
	                               ->orderBy('sum_quantity_sold' , 'ASC')
	                               ->get();

	    $top_ten_lowest_sales = DB::table('sites')
	                              ->join('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
		                          ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , '=' , $request->from)
		                          ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request->to ")
	                              ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold') , 'sites.name AS site_name')
	                              ->groupBy('sites.name')
	                              ->limit(10)
	                              ->orderBy('sum_quantity_sold' , 'DESC')
	                              ->get();

	    $sales_by_sites = DB::table('sites')
	                        ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                        ->join('business_groups' , 'business_groups.id' , '=' , 'sites.business_group_id')
	                        ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , '=' , $request->from)
		                    ->whereRaw( "QUARTER(quantity_solds.date_captured)  =  $request->to ")
	                        ->select(DB::raw('SUM(quantity_solds.quantity_sold) AS sum_quantity_sold' ) , 'sites.name AS site_name' , 'sites.id AS site_id' , 'business_groups.id AS business_groups_id', 'sites.province AS site_province' ,'business_groups.name AS business_group_name' )
	                        ->groupBy('sites.name' , 'sites.province' )
	                        ->orderBy('sum_quantity_sold' , 'DESC')
	                        ->get();


	    $top_ten_highest_sales_bar = Charts::multi('bar', 'chartjs')
	                                       ->title('Highest Top Ten Sales By Sites ' . ' By ' . 'Quater ' . $request->to . ' - ' . $request->from)
	                                       ->labels($top_ten_highest_sales->pluck('site_name')->toArray())
	                                       ->dataset('Sales' ,$top_ten_highest_sales->pluck('sum_quantity_sold')->toArray())
	                                       ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                       ->responsive(false);

	    $top_ten_lowest_sales_bar = Charts::multi('bar', 'chartjs')
	                                      ->title('Lowest Top Ten Sales By Sites'  . ' By ' . 'Quater ' . $request->to . ' - ' . $request->from)
	                                      ->labels($top_ten_lowest_sales->pluck('site_name')->toArray())
	                                      ->dataset('Sales' ,$top_ten_lowest_sales->pluck('sum_quantity_sold')->toArray())
	                                      ->colors(['#2879ff', '#e91e63', '#fec107'])
	                                      ->responsive(false);

	    return view('reports.filtered_reports_by_quater' , compact('top_ten_highest_sales_bar' ,'top_ten_lowest_sales_bar' , 'sales_by_sites'));




    }





}
