<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Event;
use GoFunCrm\Log;
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
        return view('events.create');
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
        	'title' => 'required',
        	'start_date' => 'required',
        	'end_date' => 'required',
        	'location' => 'required',
        	'notes' => 'required',
        ],
	    [
	        	'title.required' => 'Please provide title',
	        	'start_date.required' => 'Please provide start date',
	        	'end_date.required' => 'Please provide end date',
		        'notes.required' => 'Please provide notes fo the event',
		        'location.required' => 'Please provide event location',
	    ]);


	    $address = Geocoder::getCoordinatesForAddress($request->location);

	    $event = new Event();
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
		$event->title = $request->title ;
		$event->location = $request->location ;
		$event->address_latitude = $address['lat'] ;
		$event->address_longitude = $address['lng'] ;
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
        $event = Event::find($id);
        return view('events.edit' , compact('event'));
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
		    'title' => 'required',
		    'start_date' => 'required',
		    'end_date' => 'required',
		    'notes' => 'required',
		    'location' => 'required',
	    ],
		    [
			    'title.required' => 'Please provide title',
			    'start_date.required' => 'Please provide start date',
			    'end_date.required' => 'Please provide end date',
			    'notes.required' => 'Please provide notes fo the event',
			    'location.required' => 'Please provide event location',
		    ]);

	    $address = Geocoder::getCoordinatesForAddress($request->location);


	    $event = Event::find($id);
	    $event_name = $event->title ;
	    $event->start_date = Carbon::parse($request->start_date);
	    $event->end_date = Carbon::parse($request->end_date);
	    $event->title = $request->title ;
	    $event->location = $request->location ;
	    $event->address_latitude = $address['lat'] ;
	    $event->address_longitude = $address['lng'] ;
	    $event->notes = $request->notes ;
	    $event->user_id = Auth::id() ;
	    $event->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Updated the following event  ' . $event_name;
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
				    $value->title   ,
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
    	$event = Event::find($id);
    	return view('events.event_detail' , compact('event'));
    }
}
