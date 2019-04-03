<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\SetPrice;
use Illuminate\Http\Request;
use Softon\SweetAlert\Facades\SWAL;

class PriceController extends Controller
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
    	$prices = SetPrice::first();

    	if(empty($prices)) {
            return view('product_price.create');
	    }
	    else {
			return redirect(route('set_price.edit' , ['id' => $prices->id]));
	    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $prices = SetPrice::first();
	    if(empty($prices)) {
		    return view('product_price.create');
	    }
	    else {
		    return redirect(route('set_price.edit' , ['id' => $prices->id]));
	    }
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
        	'price' => 'required|min:0',
        ],
	    [
	        'price.required' => 'Price is required',
	    ]);

        $price = new SetPrice();
        $price->price = $request->price ;
        $price->save();


	    SWAL::message('Success','Price successfully set','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('Price was successfully set', 'Success')->autoclose(9000);
	    return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    	$price = SetPrice::find($id);
	    return view('product_price.edit' , compact('price'));
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
		    'price' => 'required|min:0',
	    ],
		    [
			    'price.required' => 'Price is required',
		    ]);

	    $price = SetPrice::find($id);
	    $price->price = $request->price ;
	    $price->save();


	    SWAL::message('Success','Price successfully set','success',[
		    'timer'=>9000,
	    ]);

//	    Alert::success('Price was successfully set', 'Success')->autoclose(9000);
	    return redirect(route('set_price.edit' , ['id' => $price->id]));



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
