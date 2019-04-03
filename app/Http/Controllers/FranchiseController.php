<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Franchise;
use GoFunCrm\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\SweetAlert\Facades\SWAL;

class FranchiseController extends Controller
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
    	$franchises = DB::table('users')
		              ->rightJoin('franchises' , 'franchises.user_id' , '=' , 'users.id')
		              ->select('franchises.name AS franchise_name'  , 'franchises.status AS status' , 'franchises.created_at AS created_at' , 'users.name AS user_name' , 'franchises.id AS franchises_id')
		              ->get();

		return view('franchise.index' ,compact('franchises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('franchise.create');
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
        	'name' => 'required|unique:franchises',
        ],
	    [
	        'name.required' => 'Please provide franchise name',
	        'name.unique' => 'Franchise name must be unique',
	    ]);

        $franchise = new Franchise() ;
        $franchise->name = $request->name ;
        $franchise->user_id = Auth::id() ;
        $franchise->save();

	    $log = new Log();
	    $log->description = Auth::user()->name . ' Created the following franchise ' . $franchise->name . ' ' . $franchise->created_at  ;
	    $log->log_type = 'Franchise';
	    $log->save();

	    SWAL::message('Success','Franchise was created successfully','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('franchise.index'));
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
        $franchise = Franchise::find($id);
        return view('franchise.edit' , compact('franchise'));
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
	    $franchise = Franchise::find($id);
	    $franchise_name = $franchise->name;

	    $this->validate($request , [
		    'name' => 'required',
	    ],
		    [
			    'name.required' => 'Please provide franchise name',
			    'name.unique' => 'Franchise name must be unique',
		    ]);


	    $franchise->name = $request->name ;
	    $franchise->status = $request->status ;
	    $franchise->user_id = Auth::id() ;
	    $franchise->save();


	    $log = new Log();
	    $log->description = Auth::user()->name . ' Updated the following franchise ' . $franchise_name . ' ' . $franchise->updated_at  ;
	    $log->log_type = 'Franchise';
	    $log->save();

	    SWAL::message('Success','Franchise was updated successfully','success',[
		    'timer'=>9000,
	    ]);

	    return redirect(route('franchise.index'));

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
