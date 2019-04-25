<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Event;
use GoFunCrm\Log;
use GoFunCrm\Site;
use GoFunCrm\VisitationType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softon\SweetAlert\Facades\SWAL;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Spatie\Geocoder\Facades\Geocoder;


class EventsController extends Controller
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
    	$events = DB::table('users')
		          ->join('events' , 'events.user_id' , '=' , 'users.id')
		          ->select('users.name AS name' , 'events.start_date AS start_date' , 'events.end_date AS end_date' , 'events.created_at AS created_at' , 'events.title AS title' ,'events.id AS id')
	              ->get();
        return view('events.index' , compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$sites = Site::all();
        return view('events.create' , compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//    	dd($request->all());

        $this->validate($request , [
        	'title' => 'required',
        	'start_date' => 'required',
        	'end_date' => 'required',
        	'site_id' => 'required',
        	'event_type' => 'required',
//        	'event_type' => 'required',
        ],
	    [
	        	'title.required' => 'Please provide title',
	        	'start_date.required' => 'Please provide start date',
	        	'end_date.required' => 'Please provide end date',
//		        'notes.required' => 'Please provide notes fo the event',
		        'site_id.required' => 'Please select a site',
	    ]);

//	    $address = Geocoder::getCoordinatesForAddress($request->location);

	    $event = new Event();
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
		$event->title = $request->title ;
		$event->site_id = $request->site_id ;
		$event->event_type = $request->event_type ;
//		$event->address_latitude = $address['lat'] ;
//		$event->address_longitude = $address['lng'] ;
		$event->notes = $request->notes ;
		$event->user_id = Auth::id() ;
		$event->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Added the following event  ' . $event->title ;
	    $log->log_type = ' 	Events';
	    $log->save();

	    SWAL::message('Success','Event was successfully created','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('events.index'));
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
	    $sites = Site::all();
        $event = Event::find($id);
        return view('events.edit' , compact('event' , 'sites'));
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
//    	dd($request->all());

	    $this->validate($request , [
		    'title' => 'required',
		    'start_date' => 'required',
		    'end_date' => 'required',
		    'site_id' => 'required',
		    'event_type' => 'required',
//        	'event_type' => 'required',
	    ],
		    [
			    'title.required' => 'Please provide title',
			    'start_date.required' => 'Please provide start date',
			    'end_date.required' => 'Please provide end date',
//		        'notes.required' => 'Please provide notes fo the event',
			    'site_id.required' => 'Please select a site',
		    ]);

//	    $address = Geocoder::getCoordinatesForAddress($request->location);

	    $event = Event::find($id);
	    $event->start_date = Carbon::parse($request->start_date);
	    $event->end_date = Carbon::parse($request->end_date);
	    $event->title = $request->title ;
	    $event->site_id = $request->site_id ;
	    $event->event_type = $request->event_type ;
//		$event->address_latitude = $address['lat'] ;
//		$event->address_longitude = $address['lng'] ;
	    $event->notes = $request->notes ;
	    $event->user_id = Auth::id() ;
	    $event->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Updated the following event  ' . $event->title;
	    $log->log_type = ' 	Events';
	    $log->save();

	    SWAL::message('Success','Event was successfully updated','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('Site was successfully updated', 'Success')->autoclose(9000);
	    return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::destroy($id);

	    SWAL::message('Success','Event was successfully removed','success',[
		    'timer'=>9000,
	    ]);
//	    Alert::success('Event successfully removed', 'Success')->autoclose(9000);
	    return redirect(route('events.index'));
    }

    public function view_calendar() {
	    $events = [];
	    $data = Event::all();
	    if($data->count())
	    {
		    foreach ($data as $key => $value)
		    {
			    $events[] = Calendar::event(
				    $value->title . ' - ' . strtoupper($value->event_type)    ,
				    true,
				    new \DateTime($value->start_date),
				    new \DateTime($value->end_date),
				    null,
				    // Add color
				    [
					    'color' => 'rgba(255,255,102,0.3)',
					    'textColor' => '#000',
						'allDay' => false,
					    'url'   => route('calendar_detail', $value->id),
				    ]
			    );
		    }
	    }
	    $calendar = Calendar::addEvents($events)
	    ;
	    return view('events.view_calendar', compact('calendar'));
    }

    public function calendar_detail($id) {
//    	$event = Event::find($id);


    	$event = DB::table('sites')
		         ->join('events' , 'events.site_id' , '=' , 'sites.id')
		         ->where('events.id' , $id)
		         ->select('events.start_date AS start_date' , 'events.title AS title' , 'events.end_date AS end_date' , 'sites.name AS site_name' , 'sites.address AS address' ,'sites.address AS address' , 'sites.address_latitude AS address_latitude' ,'sites.address_longitude AS address_longitude' ,'events.notes AS notes' )
		         ->first();
//	             ->toArray();

//    	dd(json_encode($event));

    	return view('events.event_detail' , compact('event'));
    }
}
