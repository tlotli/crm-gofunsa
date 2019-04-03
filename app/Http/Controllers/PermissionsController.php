<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Permission;
use GoFunCrm\PermissionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;
use Alert;

class PermissionsController extends Controller
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
	    $permission_types = DB::table('permissions')
	                          ->join('permission_types' , 'permission_types.id' , '=' , 'permissions.permission_type_id')
	                          ->select('permissions.name AS permission_name' , 'permission_types.name AS permission_type_name' , 'permissions.id AS permission_id')
	                          ->orderBy('permission_types.name')
	                          ->get();

        return view('permissions.index' , compact('permission_types'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $permission_type = PermissionType::all();
    	return view('permissions.create' ,compact('permission_type'));
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
        	'name' => 'required|unique:permissions',
	        'permission_id' => 'required',
        ],
	    [
	        'name.required' => 'Please provide permission name',
	        'name.unique' => 'Permission name already taken',
	        'permission_id.required' => 'Please select permission type',
	    ]);

        $permission = new Permission();
        $permission->name = str_slug($request->name);
        $permission->permission_type_id = $request->permission_id;
        $permission->save();

	    Alert::success('Permission was successfully created', 'Success')->autoclose(9000);
	    return redirect(route('permissions.index'));
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
	    $permission_type = PermissionType::all();
    	$permission = Permission::find($id);
        return view('permissions.edit' , compact('permission' , 'permission_type'));
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
	    $permission = Permission::find($id);

	    if($permission->name == $request->name) {
		    $this->validate($request , [
			    'name' => 'required',
			    'permission_id' => 'required',
		    ],
			    [
				    'name.required' => 'Please provide permission name',
				    'permission_id.required' => 'Please select permission type',
			    ]);

		    $permission->name = str_slug($request->name);
		    $permission->permission_type_id = $request->permission_id;
		    $permission->save();

		    Alert::success('Permission was successfully update', 'Success')->autoclose(9000);
		    return redirect(route('permissions.index'));
	    }
	    else {
		    $this->validate($request , [
			    'name' => 'required|unique:permissions',
			    'permission_id' => 'required',
		    ],
			[
				    'name.required' => 'Please provide permission name',
				    'name.unique' => 'Permission name already taken',
				    'permission_id.required' => 'Please select permission type',
			]);

		    $permission->name = str_slug($request->name);
		    $permission->permission_type_id = $request->permission_id;
		    $permission->save();

		    Alert::success('Permission was successfully update', 'Success')->autoclose(9000);
		    return redirect(route('permissions.index'));
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
	    Alert::success('Permission was successfully update', 'Success')->autoclose(9000);
	    return redirect(route('permissions.index'));
    }
}
