<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\Site;
use GoFunCrm\Task;
use GoFunCrm\Visitation;
use GoFunCrm\VisitationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;

class VisitationsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
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
        //
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



    public function visitations_list($id) {

    	$site = DB::table('sites')
		        ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
		        ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
		        ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
		        ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
		        ->get();

	    $visitations = DB::table('users')
	                     ->join('visitations' , 'visitations.visisted_by' , '=' , 'users.id')
	                     ->join('visitation_types' , 'visitation_types.id' , '=' , 'visitations.visitation_type_id')
	                     ->join('sites' , 'sites.id' , '=' , 'visitations.site_id')
	                     ->where('sites.id' , $id)
	                     ->select('visitations.date_visited AS date_visited' , 'visitation_types.name as visitation_type_name' , 'users.name AS user_name' , 'visitations.visitation_type_id AS visitation_type_id' , 'visitations.notes AS notes')
		                 ->orderBy('visitations.date_visited' , 'DESC')
	                     ->get();

	    return view('visitation.index' , compact('site' , 'visitations'));

    }


    public function create_visitation($id) {
	    $site = DB::table('sites')
	              ->join('business_groups' , 'sites.business_group_id' , '=' , 'business_groups.id')
	              ->join('business_owners' , 'business_owners.id' , '=' , 'business_groups.business_owner_id')
	              ->where('sites.id' , $id)
//		        ->select('sites.name AS site_name')
                  ->select('sites.name AS site_name' , 'business_groups.name AS owned_by' , 'business_groups.business_type AS business_type' , 'business_owners.name AS ceo' , 'sites.city AS city' , 'sites.address AS address' , 'sites.province AS province' ,'sites.id AS id')
	              ->get();

	    $visitation_types = VisitationType::all();

	    return view('visitation.create' , compact('site' , 'visitation_types'));
    }


	public function store_visitation(Request $request ,$id) {
    	$site = Site::find($id);

    	$this->validate($request , [
    		'visitation_type_id' => 'required',
    		'date_visited' => 'required',
    		'notes' => 'required',
	    ],
		[
			'visitation_type_id.required' => 'Visitation type is required',
			'date_visited.required' => 'Visitation date is required',
			'notes.required' => 'Please provide notes on visit',
		]);

		$sites = DB::select("
			SELECT v.date_visited AS date_last_visited , sites.name AS site_name , sites.province AS province , sites.id AS site_id , visitation_types.name AS visitation_type , DATEDIFF(CURRENT_DATE ,v.date_visited ) AS number_of_days_since_visit , v.date_visited AS last_date_visited , v.notes AS notes , users.name AS assigned_to , tasks.status AS status , tasks.notes AS task_notes , v.id AS visitation_id
			 FROM visitations v
			 INNER JOIN sites ON sites.id = v.site_id
			 INNER JOIN visitation_types ON visitation_types.id = v.visitation_type_id
			 LEFT JOIN tasks ON tasks.site_id = sites.id
			 INNER JOIN users
			 ON users.id = tasks.assigned_to
			 WHERE v.date_visited = (SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id )
			 AND tasks.site_id IS NOT NULL
			 AND tasks.status = 0
			 AND sites.id = $id
		");



		if(!empty($sites)) {

			foreach ($sites as $s) {

				$visitation                     = new Visitation();
				$visitation->visitation_type_id = $request->visitation_type_id;
				$visitation->date_visited       = $request->date_visited;
				$visitation->site_id            = $id;
				$visitation->visisted_by        = Auth::id();
				$visitation->notes              = $request->notes;
				$visitation->save();

				$task   = Task::where('site_id' , $s->site_id)->first();
				$task->status        = 1;
				$task->visitation_id = $visitation->id;
				$task->save();



				$log              = new Log();
				$log->description = Auth::user()->name . ' Visited the following site ' . $s->site_name . ' ' . $visitation->date_visited;
				$log->log_type    = 'Visitation';
				$log->save();

				SWAL::message( 'Success', 'Visitation successfully captured', 'success', [
					'timer' => 9000,
				] );

				return redirect( route( 'tasks_assigned_to_users' ) );
			}
		}
		else {
			$visitation = new Visitation();
			$visitation->visitation_type_id = $request->visitation_type_id ;
			$visitation->date_visited = $request->date_visited ;
			$visitation->site_id = $id ;
			$visitation->visisted_by = Auth::id() ;
			$visitation->notes = $request->notes ;
			$visitation->save();

			$log = new Log();
			$log->description = Auth::user()->name . ' Visited the following site ' . $site->name . $visitation->date_visited ;
			$log->log_type = 'Visitation';
			$log->save();

			SWAL::message('Success','Visitation successfully captured','success',[
				'timer'=>9000,
			]);

			return redirect(route('visitations_list' , ['id' => $id]));
		}
	}


	public function get_all_visitations() {
		$visitations = DB::select("
			SELECT DATEDIFF(CURRENT_DATE ,v.date_visited ) AS days_last_visited , sites.name AS site_name , sites.id AS site_id , visitation_types.name AS type_of_visitation , v.notes AS notes , v.date_visited AS date_visited 
			FROM visitations v 
			INNER JOIN sites 
			ON sites.id = v.site_id
			INNER JOIN  visitation_types
			ON visitation_types.id = v.visitation_type_id
			WHERE v.date_visited = 
			(SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id )
			ORDER BY v.date_visited ASC

		");

    	return view('quick_access.visitations' , compact('visitations'));

	}


	public function visitations_detail($id) {

    	$visitation = DB::table('visitations')
		              ->join('sites' , 'sites.id' , '=' , 'visitations.site_id')
		              ->join('tasks' , 'tasks.visitation_id' , '=' , 'visitations.id')
		              ->join('users' ,  'users.id' , '=' , 'tasks.assigned_to')
		              ->join('visitation_types' ,  'visitation_types.id' , '=' , 'visitations.visitation_type_id')
		              ->where('visitations.id' , $id)
		              ->select('sites.name AS site_name' ,'visitations.date_visited AS date_visited' , 'visitations.notes AS notes' , 'users.name AS user_name' , 'visitation_types.name as visitation_type')
		              ->first();

    	return view('visitation.visitation_detail' , compact('visitation'));

	}

}
