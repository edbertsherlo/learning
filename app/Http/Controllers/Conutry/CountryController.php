<?php

namespace App\Http\Controllers\conutry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CountryModel;
use Illuminate\Support\Facades\DB;


class CountryController extends Controller
{
    public function country(Request $request){
		$uri = $request->path();
    	$headers = $request->header('token');
    	if($request->header('token') !==null){          // Check Token is Available
    		$method = $request->method();  				// Find Request Method
    		DB::enableQueryLog();
			$records = DB::table('student_register as sr')
			            ->join('student_family_id as sf', 'sr.reg_id', '=', 'sf.family_code')
			            ->select('sr.*', 'sf.family_code')
			            ->get();

			$query = DB::getQueryLog();
			//dd($query);
			$record = $records->toArray();		
			return response()->json($record);
    	} else {
			return response()->json('Please check header values',401);
    	}
	}
	public function getorder(Request $request){
		$uri = $request->path();

		// if($request->headers->has('Authorization')){
		// 	echo "yes Available";
		// } else{
		// 	echo "not Available";
		// }
		// return $request->header();die();

    	if($request->headers->has('Authorization')){          // Check Token is Available
    		$method = $request->method();  				// Find Request Method
    		DB::enableQueryLog();
			$records = DB::table('student_register as sr')
			            ->join('student_family_id as sf', 'sr.reg_id', '=', 'sf.family_code')
			            ->select('sr.*', 'sf.family_code')
			            ->get()->first();
			// echo "<pre>";
			// print_r($records);die();
			$query = DB::getQueryLog();
			//dd($query);
			// $record = $records->toArray();
			$response = array(
						'orderData' =>$records
						);		
			return response()->json($response);
    	} else {
			return response()->json('Please check header values',401);
    	}
	}
}
