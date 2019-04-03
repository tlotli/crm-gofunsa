<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\Permission;
use GoFunCrm\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;
class RolesController extends Controller
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
        $roles = DB::table('roles')
	             ->join('users' , 'users.id' , '=' , 'roles.created_by')
	             ->select('users.name AS created_by' , 'roles.name AS role_name'  , 'roles.id AS id' , 'users.last_updated_by AS last_updated_by' , 'roles.created_at AS created_at' )
                 ->get();

        return view('roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$permissions = Permission::all()->sortBy('name');
        return view('roles.create1' ,compact('permissions'));
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
			'name' => 'required|unique:roles',
			'permission_id' => 'required',
		],
			[
				'name.required' => 'Role name is required',
				'name.unique' => 'Role name already taken',
				'permission_id.required' => 'Please select permission type',
			]
		);

		$role = new Role();
		$role->name = $request->name ;
		$role->slug = str_slug($request->name) ;
		$role->created_by = Auth::id() ;
	    $role->save();

	    $role->permissions()->sync($request->permission_id);

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Created the following role ' . $role->name  . ' at ' . $role->created_at ;
	    $log->log_type = 'Roles';
	    $log->save();


	    SWAL::message('Success','You have successfully created a role','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('roles.index'));
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
        $role = Role::find($id);
	    $permissions = Permission::all();
        return view('roles.edit' , compact('role' ,'permissions'));
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
    	$role = Role::find($id);
    	$role_before = $role->name ;

        if($role->name == $request->name) {
	        $this->validate($request , [
		        'name' => 'required',
		        'permission_id' => 'required',
	        ],
		        [
			        'name.required' => 'Role name is required',
			        'name.unique' => 'Role name already taken',
			        'permission_id.required' => 'Please select permission type',
		        ]
	        );
        }
        else {
	        $this->validate($request , [
		        'name' => 'required',
		        'permission_id' => 'required',
	        ],
		        [
			        'name.required' => 'Role name is required',
			        'name.unique' => 'Role name already taken',
			        'permission_id.required' => 'Please select permission type',
		        ]
	        );
        }

	    $role->name = $request->name ;
	    $role->slug = str_slug($request->name) ;
	    $role->last_updated_by = Auth::id() ;
	    $role->save();

	    $log = new Log();
	    $log-> description = Auth::user()->name . ' Made changes to the following role ' . $role_before ;
	    $log->log_type = 'Roles';
	    $log->save();

	    $role->permissions()->sync($request->permission_id);

//	    Alert::success('Role was successfully created', 'Success')->autoclose(9000);


	    SWAL::message('Success','Role was successfully updated','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('roles.index'));
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
