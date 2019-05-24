<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\SetDateFlag;
use GoFunCrm\Site;
use GoFunCrm\Task;
use GoFunCrm\User;
use GoFunCrm\Visitation;
//use Billow\Utilities\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Softon\SweetAlert\Facades\SWAL;
use Facades\Billow\Utilities\SMS;

class TasksController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function overdue_visitations_without_tasks() {
		$set_date_flag = SetDateFlag::first();

		$sites = DB::select("
			SELECT v.date_visited AS date_last_visited , sites.name AS site_name , sites.province AS province , sites.id AS site_id ,  v.id as visitation_id , visitation_types.name AS visitation_type , DATEDIFF(CURRENT_DATE ,v.date_visited ) AS number_of_days_since_visit , v.date_visited AS last_date_visited , v.notes AS notes , tasks.follow_up_visitation_id AS follow_up_visitation_id , tasks.status as task_status
			FROM visitations v 
			INNER JOIN sites
			ON sites.id = v.site_id
			INNER JOIN visitation_types  
			ON visitation_types.id = v.visitation_type_id
			LEFT JOIN tasks 
			ON tasks.site_id = sites.id
			WHERE v.date_visited = (SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id )
			AND  ( DATEDIFF(CURRENT_DATE , v.date_visited ) >= $set_date_flag->date_flag )
			AND (tasks.status = 1 OR  tasks.status IS NULL)
			ORDER BY DATEDIFF(CURRENT_DATE , v.date_visited ) DESC 
		");


//		return $sites ;

		return view('tasks.unsigned_tasks' , compact('sites'));
	}

	public function overdue_visitations_with_tasks() {
		$set_date_flag = SetDateFlag::first();
		$sites = DB::select("
			SELECT v.date_visited AS date_last_visited , sites.name AS site_name ,
			 sites.province AS province ,
			 sites.id AS site_id ,
			 visitation_types.name AS visitation_type ,
			 DATEDIFF(CURRENT_DATE ,v.date_visited ) AS number_of_days_since_visit ,
			 v.date_visited AS last_date_visited ,
			 v.notes AS notes , users.name AS assigned_to ,
			 tasks.status AS status ,
			 tasks.notes AS task_notes ,
			 tasks.visitation_id AS visitation_id ,
			 DATEDIFF(CURRENT_DATE ,tasks.created_at ) as number_days_since_task_was_created 
			 FROM visitations v 
			 INNER JOIN sites ON sites.id = v.site_id 
			 INNER JOIN visitation_types ON visitation_types.id = v.visitation_type_id 
			 LEFT JOIN tasks ON tasks.site_id = sites.id
			 INNER JOIN users
			 ON users.id = tasks.assigned_to
			 WHERE v.date_visited = (SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id ) 
			 AND tasks.site_id IS NOT NULL
			 ORDER BY number_days_since_task_was_created DESC
			 
			 
		");

		return view('tasks.assigned_tasks' , compact('sites' ));
	}


	public function create_visitations_without_tasks($id , $visitation_id) {
		$users = User::all();
		$visitation = Visitation::find($visitation_id);
		$site = Site::find($id);

		return view('tasks.create' , compact('users' , 'site' , 'visitation'));
	}


	public function store_visitations_without_tasks(Request $request , $id , $visitation_id) {

	    $this->validate($request , [
	    	'assigned_to' => 'required',
	    ],
		[
			'assigned_to.required' => 'Please assign a task to a user',
		]);

	    $get_previous_task = Task::where('visitation_id' , $visitation_id)->count();

	    if($get_previous_task > 0) {
	    	Task::where('visitation_id' , $visitation_id)->delete();
	    }

		$user = User::find($request->assigned_to);
		$site = Site::find($id);


	    $task = new Task();
	    $task->assigned_to = $request->assigned_to;
	    $task->site_id = $id;
	    $task->follow_up_visitation_id = $visitation_id;
	    $task->status = 0 ;
	    $task->notes = $request->notes ;
	    $task->assigned_by = Auth::id() ;
	    $task->save();

	    $get_assigned_users = User::find($request->assigned_to);
	    $task = Task::find($task->id);

		Mail::to($get_assigned_users)->send(new \GoFunCrm\Mail\AssignedToTask($task));

		$log = new Log();
		$log->description = Auth::user()->name . ' Assigned task to  '  . $user->name . ' to follow up on the following site ' .  $site->name ;
		$log->log_type = 'Task';
		$log->save();


//		$number = $user->telephone;
//		SMS::recipient($number)->content('Gofun ' . $task->notes)->send();

		SWAL::message('Success','Task successfully assigned','success',[
			'timer'=>9000,
		]);

		return redirect(route('overdue_visitations_without_tasks'));
	}



	public function tasks_assigned_to_users() {

		$set_date_flag = SetDateFlag::first();
		$auth_id = Auth::id();
		$sites = DB::select("
			SELECT v.date_visited AS date_last_visited , sites.name AS site_name , sites.province AS province , sites.id AS site_id , visitation_types.name AS visitation_type , DATEDIFF(CURRENT_DATE ,v.date_visited ) AS number_of_days_since_visit , v.date_visited AS last_date_visited , v.notes AS notes , users.name AS assigned_to , tasks.status AS status , tasks.notes AS task_notes
			 FROM visitations v 
			 INNER JOIN sites ON sites.id = v.site_id 
			 INNER JOIN visitation_types ON visitation_types.id = v.visitation_type_id 
			 LEFT JOIN tasks ON tasks.site_id = sites.id
			 INNER JOIN users
			 ON users.id = tasks.assigned_to
			 WHERE v.date_visited = (SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id ) 
			 AND tasks.site_id IS NOT NULL
			 AND tasks.status = 0 
			 AND tasks.assigned_to =  $auth_id
		");

		return view('tasks.user_assigned_tasks' , compact('sites' ));
	}



}
