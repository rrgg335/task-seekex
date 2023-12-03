<?php

namespace App\Http\Controllers;
use App\Models\{Ball,BallsInBuckets,Bucket};
use Illuminate\Http\Request;

class PlacementController extends Controller{

	public function index(){
		$ballsinbuckets = BallsInBuckets::get();
		$ballsinbuckets = $ballsinbuckets->groupBy('bucket_id');
		//print_r($ballsinbuckets); die;
		return view('current-placement.index',compact('ballsinbuckets'));
	}

	public function clearAll(){
		BallsInBuckets::truncate();
		return redirect()->route('current-placement.index')->with('success','All Buckets have been emptied!');
	}

}