<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Log;
use GoFunCrm\Role;
use GoFunCrm\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Softon\SweetAlert\Facades\SWAL;
class UsersController extends Controller
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
    	$users = DB::table('users')
	            ->join('role_users' , 'role_users.user_id' , '=' , 'users.id')
	            ->join('roles' , 'role_users.role_id' , '=' , 'roles.id')
    	        ->select('users.name AS name', 'users.email AS email' , 'users.status AS status' , 'users.id AS id' , 'roles.name AS role_name' ,  'users.Position AS position'  , 'users.name AS created_by')
    	        ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::all();
        return view('users.create' , compact('roles'));
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
        	'email' => 'required|unique:users',
        	'telephone' => 'required|min:10|max:10|unique:users',
        	'position' => 'required',
	        'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->created_by = Auth::id();
        $user->telephone = $request->telephone;
        $user->status = $request->status;
        $user->Position = $request->position;
        $user->password = Hash::make($request->password);
        $user->save() ;

        $user->roles()->sync($request->role_id);

        $log = new Log();
        $log->description = Auth::user()->name . ' created added the following user ' . $user->name ;
        $log->log_type =  'Users' ;
        $log->save();

	    SWAL::message('Success','User successfully created','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('users.index'));
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
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit' , compact('user' ,'roles'));
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
	    $user = User::find($id);

	    if($user->email == $request->email) {
		    $this->validate($request , [
			    'name' => 'required',
			    'email' => 'required',
			    'telephone' => 'required|min:10|max:10',
			    'position' => 'required',
		    ]);
	    }
	    else {
		    $this->validate($request , [
			    'name' => 'required',
			    'email' => 'required|unique:users',
			    'telephone' => 'required|min:10|max:10',
			    'position' => 'required',
		    ]);
	    }

	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->last_updated_by = Auth::id();
	    $user->telephone = $request->telephone;
	    $user->status = $request->status;
	    $user->Position = $request->position;
	    $user->save() ;

	    $user->roles()->sync($request->role_id);

	    $log = new Log();
	    $log->description = Auth::user()->name . ' updated details of the following user ' . $user->name ;
	    $log->log_type =  'Users' ;
	    $log->save();

	    SWAL::message('Success','User information updated','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('User information successfully updated', 'Success')->autoclose(9000);
	    return redirect(route('users.index'));
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


	public function reset_password($id)
	{
		$user = User::find($id);
		return view('users.reset_password' , compact('user'));
	}


	public function change_password(Request $request ,$id)
	{

		$this->validate($request , [
			'password' => 'required|string|min:6|confirmed',
		]);

		$user = User::find($id);
		$user->password = Hash::make($request->password);
		$user->save();

		$log = new Log();
		$log->description = Auth::user()->name . ' updated the password for the following user ' . $user->name ;
		$log->log_type =  'Users' ;
		$log->save();

//		Alert::success('User created successfully', 'Success')->autoclose(9000);



		SWAL::message('Success','User password updated','success',[
			'timer'=>9000,
		]);

		return redirect(route('users.index'));

//		return $request->all();



	}


	public function logout() {
		Auth::logout();

		SWAL::message('Success','You have  logged out',[
			'timer'=>9000,
		]);

		return redirect('/');
	}

}
