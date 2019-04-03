<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\BusinessOwner;
use GoFunCrm\Charts\BarChart;
use GoFunCrm\Log;
use GoFunCrm\StockOnHand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;

class BusinessOwnerController extends Controller
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
        $business_owners = DB::table('users')
	                       ->rightJoin('business_owners' , 'business_owners.user_id' , '=' , 'users.id')
	                       ->select('users.name AS user_name' , 'business_owners.*')
	                       ->get();

        return view('business_owners.index' , compact('business_owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business_owners.create');
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
			'email' => 'required|email',
			'contact_number' => 'required|max:10',
		],
		[
			'name.required' => 'Business owner name is required',
			'email.unique' => 'Business owner email already taken',
			'email.required' => 'Email is required',
			'contact_number.required' => 'Contact number is required',
			'contact_number.unique' => 'Contact number must be unique',
			'contact_number.min' => 'Contact number must be 10 characters',
			'contact_number.max' => 'Contact number must be 10 characters',
		]);

		$business_owner = new BusinessOwner();
		$business_owner->user_id = Auth::id();
		$business_owner->name = $request->name;
		$business_owner->email = $request->email;
		$business_owner->contact_number = $request->contact_number;
		$business_owner->save();

	    $log = new Log();
	    $log->description = Auth::user()->name . ' Created the following business owner ' . $business_owner->name ;
	    $log->log_type = 'Business Contacts';
	    $log->save();

	    SWAL::message('Success','Business owner was  added','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('Business owner was successfully added', 'Success')->autoclose(9000);
	    return redirect(route('business_owner.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {




///////////////////////////////////////////////////////Businesses Owned By Province//////////////////////////////////////////////////////////////////////////

	    $no_business_owned =  DB::table('business_owners')
	                            ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                            ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	                            ->where('business_owners.id' , $id)
	                            ->select(DB::raw('COUNT(sites.name) AS site_count') , 'sites.province as province')
	                            ->groupBy('sites.province')
	                            ->get() ;

	    $chart = new BarChart();
	    $chart->labels($no_business_owned->pluck('province')->toArray());
	    $dataset = $chart->dataset('Number of Businesses by Province' , 'bar' , $no_business_owned->pluck('site_count')->toArray());

	    $dataset->backgroundColor( collect(['#e35c25','#b3c914', '#cd1b18', '#f120a3', '#a40c43', '#a0dec9', '#6ae52e', '#5ef87b', '#c71475', '#95aab4', '#7668d1', '#895f93']));
	    $dataset->color( 'rgba(236, 103, 148, 0.3)');

	    $chart->options([
		    'tooltip' => [
			    'show' => true // or false, depending on what you want.
		    ],
	    ]);
	    $chart->displayLegend(true);
	    $chart->barWidth(0.5);
	    $chart->width(100);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////Businesses Owned By Franchise//////////////////////////////////////////////////////////////////////////

	    $no_business_group =  DB::table('business_owners')
	                            ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                            ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	                            ->where('business_owners.id' , $id)
	                            ->select(DB::raw('COUNT(sites.name) AS site_count') , 'business_groups.name as group_name')
	                            ->groupBy('business_groups.name')
	                            ->get() ;

	    $chart1 = new BarChart();
	    $chart1->labels($no_business_group->pluck('group_name')->toArray());
	    $dataset1 = $chart1->dataset('Number Of Franchises' , 'bar' , $no_business_group->pluck('site_count')->toArray());

	    $dataset1->backgroundColor( collect(['#e35c25','#b3c914', '#cd1b18', '#f120a3', '#a40c43', '#a0dec9', '#6ae52e', '#5ef87b', '#c71475', '#95aab4', '#7668d1', '#895f93']));
	    $dataset1->color( 'rgba(236, 103, 148, 0.3)');

	    $chart1->options([
		    'tooltip' => [
			    'show' => true // or false, depending on what you want.
		    ],
	    ]);
	    $chart1->displayLegend(true);
	    $chart1->barWidth(0.5);
	    $chart1->width(100);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////Stock Sold TO Date//////////////////////////////////////////////////////////////////////////

	    $stock_sold_to_date = DB::table('business_owners')
	                           ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                           ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                           ->select(DB::raw('SUM(quantity_solds.quantity_sold) quantity_sold')  , 'sites.name AS site_name')
		                       ->where('business_owners.id' , $id)
		                       ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
	                           ->groupBy('sites.name' , 'business_owners.name')
	                           ->get();


	    $chart2 = new BarChart();
	    $chart2->labels($stock_sold_to_date->pluck('site_name')->toArray());
	    $dataset2 = $chart2->dataset('Stock Sold (YTD)' , 'pie' , $stock_sold_to_date->pluck('quantity_sold')->toArray());

	    $dataset2->backgroundColor( collect(['#e35c25','#b3c914', '#cd1b18', '#f120a3', '#a40c43', '#a0dec9', '#6ae52e', '#5ef87b', '#c71475', '#95aab4', '#7668d1', '#895f93']));
	    $dataset2->color( 'rgba(236, 103, 148, 0.3)');

//	    $chart2->options([
//		    'tooltip' => [
//			    'show' => true // or false, depending on what you want.
//		    ],
//	    ]);
//	    $chart2->displayLegend(true);
	    $chart2->barWidth(0.5);
	    $chart2->width(100);


////////////////////////////////////////////////////////////////////////////////////////// Units Sold MTD /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	    $stock_sold_mtd = DB::table('business_owners')
	                            ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                            ->leftJoin('quantity_solds' , 'quantity_solds.site_id' , '=' , 'sites.id')
	                            ->select(DB::raw('SUM(quantity_solds.quantity_sold) quantity_sold')  , 'sites.name AS site_name')
	                            ->where('business_owners.id' , $id)
	                            ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
	                            ->where(DB::raw('MONTH(quantity_solds.date_captured)' ) , Carbon::now()->month)
	                            ->groupBy('sites.name' , 'business_owners.name')
	                            ->get();


	    $chart3 = new BarChart();
	    $chart3->labels($stock_sold_mtd->pluck('site_name')->toArray());
	    $dataset3 = $chart3->dataset('Stock Sold (YTD)' , 'pie' , $stock_sold_mtd->pluck('quantity_sold')->toArray());

	    $dataset3->backgroundColor( collect(['#e35c25','#b3c914', '#cd1b18', '#f120a3', '#a40c43', '#a0dec9', '#6ae52e', '#5ef87b', '#c71475', '#95aab4', '#7668d1', '#895f93']));
	    $dataset3->color( 'rgba(236, 103, 148, 0.3)');

//	    $chart2->options([
//		    'tooltip' => [
//			    'show' => true // or false, depending on what you want.
//		    ],
//	    ]);
//	    $chart2->displayLegend(true);
	    $chart3->barWidth(0.5);
	    $chart3->width(100);


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// Units ON Hold YTD /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	    $stock_in_hand_ytd_gauteng = DB::table('business_owners')
	                           ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                           ->leftJoin('stock_on_hands' , 'stock_on_hands.site_id' , '=' , 'sites.id')
	                           ->select('stock_on_hands.soh AS soh'  , 'sites.name AS site_name' ,'stock_on_hands.date_captured AS date_captured')
	                           ->where('business_owners.id' , $id)
	                           ->where('sites.province' , 'Gauteng')
//	                           ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
//	                           ->groupBy('sites.name' , 'business_owners.name')
	                           ->get();

	    $stock_in_hand_ytd_kzn = DB::table('business_owners')
	                                   ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                                   ->leftJoin('stock_on_hands' , 'stock_on_hands.site_id' , '=' , 'sites.id')
	                                   ->select('stock_on_hands.soh AS soh'  , 'sites.name AS site_name' ,'stock_on_hands.date_captured AS date_captured')
	                                   ->where('business_owners.id' , $id)
	                                   ->where('sites.province' , 'Kwazulu-Natal')
//	                           ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
//	                           ->groupBy('sites.name' , 'business_owners.name')
                                       ->get();

	    $stock_in_hand_ytd_kzn = DB::table('business_owners')
	                               ->join('sites' , 'sites.business_owner_id' , '=' , 'business_owners.id')
	                               ->leftJoin('stock_on_hands' , 'stock_on_hands.site_id' , '=' , 'sites.id')
	                               ->select('stock_on_hands.soh AS soh'  , 'sites.name AS site_name' ,'stock_on_hands.date_captured AS date_captured')
	                               ->where('business_owners.id' , $id)
	                               ->where('sites.province' , 'Kwazulu-Natal')
//	                           ->where(DB::raw('YEAR(quantity_solds.date_captured)' ) , Carbon::now()->year)
//	                           ->groupBy('sites.name' , 'business_owners.name')
                                   ->get();


	    $chart4 = new BarChart();
	    $chart4->labels($stock_in_hand_ytd_gauteng->pluck('date_captured')->toArray());
	    $dataset4 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset5 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_kzn->pluck('soh')->toArray());
	    $dataset6 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset7 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset8 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset9 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset10 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset11 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());
	    $dataset12 = $chart4->dataset('Stock Sold (YTD)' , 'line' , $stock_in_hand_ytd_gauteng->pluck('soh')->toArray());







	    $dataset4->backgroundColor( collect(['#e35c25','#b3c914', '#cd1b18', '#f120a3', '#a40c43', '#a0dec9', '#6ae52e', '#5ef87b', '#c71475', '#95aab4', '#7668d1', '#895f93']));
	    $dataset4->color( 'rgba(236, 103, 148, 0.3)');

//	    $chart2->options([
//		    'tooltip' => [
//			    'show' => true // or false, depending on what you want.
//		    ],
//	    ]);
//	    $chart2->displayLegend(true);
	    $chart4->barWidth(0.5);
	    $chart4->width(100);



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $business_owner =  BusinessOwner::find($id) ;
        return view('business_owners.show' , compact('business_owner', 'chart' ,'chart1' ,'chart2' , 'chart3' , 'chart4'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business_owner = BusinessOwner::find($id);
        return view('business_owners.edit' , compact('business_owner'));
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
	    $this->validate($request , [
		    'name' => 'required',
		    'email' => 'required|email',
		    'contact_number' => 'required|min:10:max:10',
	    ],
		[
			    'name.required' => 'Business owner name is required',
			    'email.unique' => 'Business owner email already taken',
			    'email.required' => 'Email is required',
			    'contact_number.required' => 'Contact number is required',
			    'contact_number.unique' => 'Contact number must be unique',
			    'contact_number.min' => 'Contact number must be 10 characters',
			    'contact_number.max' => 'Contact number must be 10 characters',
		]);

	    $business_owner = BusinessOwner::find($id);
	    $business_owner->user_id = Auth::id();
	    $business_owner->name = $request->name;
	    $business_owner->email = $request->email;
	    $business_owner->contact_number = $request->contact_number;
	    $business_owner->save();

	    $log = new Log();
	    $log->description = Auth::user()->name . ' Updated the following business owner information' . $business_owner->name . ' at ' . $business_owner->updated_at ;
	    $log->log_type = 'Business Contacts';
	    $log->save();

	    SWAL::message('Success','Business owner was  updated','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('Business owner was successfully added', 'Success')->autoclose(9000);
	    return redirect(route('business_owner.index'));

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
}
