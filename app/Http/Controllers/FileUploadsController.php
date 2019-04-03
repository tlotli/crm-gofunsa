<?php

namespace GoFunCrm\Http\Controllers;

use GoFunCrm\Exports\SiteExport;
use GoFunCrm\Franchise;
use GoFunCrm\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadsController extends Controller
{
    public function export(Request $request) {
	    $id  =  $request->franchise_id;
	    $franchise = Franchise::find($id);
	    $franchise_name = $franchise->name ;
	    $exporter = app()->makeWith(SiteExport::class, compact('id'));
	    return $exporter->download("$franchise_name.xlsx");
    }


    public function file_export_view() {
    	$franchises = Franchise::all();
    	return view('uploads.export_franchise_quantities' , compact('franchises'));
    }
}
