<?php

namespace App\Http\Controllers;
use App\Models\{Bucket,BallsInBuckets};
use Illuminate\Http\Request;

class BucketsController extends Controller{

	public function index(){
		$buckets = Bucket::orderBy('volume','desc')->get();
		return view('buckets.index',compact('buckets'));
	}

	public function create(Request $request){
		$request->validate([
			'bucket_name' => 'required|string|max:255',
			'bucket_volume' => 'required|numeric|min:0.01'
		]);
		Bucket::create([
			'name' => trim($request->bucket_name),
			'volume' => floatval($request->bucket_volume)
		]);
		BallsInBuckets::truncate();
		return redirect()->route('buckets.index')->with('success','Bucket Created Successfully. All Buckets have been emptied!');
	}

	public function delete($id){
		Bucket::where('id',$id)->delete();
		BallsInBuckets::truncate();
		return redirect()->route('buckets.index')->with('success','Bucket deleted Successfully. All Buckets have been emptied!');
	}
	
}