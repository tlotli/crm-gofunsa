<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Event;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('home');

	    $events = [];
	    $data = Event::all();
	    if($data->count())
	    {
		    foreach ($data as $key => $value)
		    {
			    $events[] = Calendar::event(
				    $value->title,
				    true,
				    new \DateTime($value->start_date),
				    new \DateTime($value->end_date),
				    null,
				    // Add color
				    [
					    'color' => 'rgba(255,255,102,0.3)',
					    'textColor' => '#000',
//					    'eventTextColor' => '#000',
//					    'eventColor' => '#378006',
					    'allDay' => false,
//					    'timeFormat' => 'H(:mm)',

//
////					    'overlap'=> false,
//					'rendering'=> 'background',
//					'color'=> 'rgba(234, 108, 65, 0.3)'


				    ]
			    );
		    }
	    }
	    $calendar = Calendar::addEvents($events);
	    return view('events.view_calendar', compact('calendar'));

    }
}
