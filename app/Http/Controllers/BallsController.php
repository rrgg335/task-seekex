<?php

namespace App\Http\Controllers;
use App\Models\{Ball,BallsInBuckets};
use Illuminate\Http\Request;

class BallsController extends Controller{

	public function index(){
		$balls = Ball::orderBy('volume','desc')->get();
		return view('balls.index',compact('balls'));
	}

	public function create(Request $request){
		$request->validate([
			'ball_name' => 'required|string|max:255',
			'ball_volume' => 'required|numeric|min:0.01'
		]);
		Ball::create([
			'name' => trim($request->ball_name),
			'volume' => floatval($request->ball_volume)
		]);
		BallsInBuckets::truncate();
		return redirect()->route('balls.index')->with('success','Ball Created Successfully. All Buckets have been emptied!');
	}

	public function delete($id){
		Ball::where('id',$id)->delete();
		BallsInBuckets::truncate();
		return redirect()->route('balls.index')->with('success','Ball deleted Successfully. All Buckets have been emptied!');
	}

}