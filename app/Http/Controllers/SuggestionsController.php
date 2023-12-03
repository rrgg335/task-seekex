<?php

namespace App\Http\Controllers;
use App\Models\{Ball,BallsInBuckets,Bucket};
use Illuminate\Http\Request;

class SuggestionsController extends Controller{

	public function index(){
		$balls = Ball::orderBy('volume','desc')->get();
		return view('bucket-suggestion.index',compact('balls'));
	}

	public function create(Request $request){
		$success_message = '';
		$error_message = '';
		$request->validate([
			'ball_volume' => 'array',
			'ball_volume.*' => 'required|numeric|min:0'
		]);
		$remaining_balls = [];
		if(!empty($request->ball_volume)){
			foreach($request->ball_volume as $ball_key => $ball_volume){
				if(!empty($ball_volume)){
					$ball = Ball::where('id',$ball_key)->select('id','name','volume')->first()->toArray();
					$ball = (array)$ball;
					$ball['amount'] = $ball_volume;
					$ball['total_volume'] = floatval($ball_volume) * floatval($ball['volume']);
					$remaining_balls[] = $ball;
				}
			}
		}
		usort($remaining_balls,function($a,$b){
			if ($a['volume'] == $b['volume']){
				return 0;
			}
			return ($a['volume'] < $b['volume']) ? 1 : -1;
		});
		$total_volume = array_sum(array_column($remaining_balls,'total_volume'));
		$buckets = Bucket::orderBy('volume','desc')->get();


		// Add Empty Volume Column to Each Bucket
		$buckets = $buckets->map(function($bucket){
			$bucket->filled_volume = $bucket->filledVolume();
			$bucket->empty_volume = $bucket->emptyVolume();
			return $bucket;
		});

		// First Check if there is a bucket which can hold all the requested volume
		// We give first priority to already filled buckets so as to use least number of buckets

		if($buckets->where('empty_volume','>=',$total_volume)->count() > 0){
			$target_bucket = $buckets->where('empty_volume','>=',$total_volume)->sortByDesc('filled_volume')->first();
			$this->putBallsInBucket($target_bucket->id,$remaining_balls);
		}else{
			for($i=0;$i<count($remaining_balls);$i++){
				$amount_of_balls = $remaining_balls[$i]['amount'];
				for($j=0;$j<$amount_of_balls;$j++){
					$target_bucket = $buckets->where('empty_volume','>=',$remaining_balls[$i]['volume'])->sortByDesc('filled_volume')->first();
					if(!empty($target_bucket)){
						$success_message = 'Balls placed successfully';
						$this->putBallInBucket($target_bucket->id,[
							'id' => $remaining_balls[$i]['id'],
							'amount' => 1
						]);
						$remaining_balls[$i]['amount']--;
						$target_bucket->filled_volume += $remaining_balls[$i]['volume'];
						$target_bucket->empty_volume -= $remaining_balls[$i]['volume'];
					}
				}
			}
			$remaining_balls = array_filter($remaining_balls,function($remaining_ball){
				return !empty($remaining_ball['amount']);
			});
			if(!empty($remaining_balls)){
				$error_message = implode(', ',array_map(function($remaining_ball){
					return $remaining_ball['amount'].' '.$remaining_ball['name'].' Balls';
				},$remaining_balls)).' cannot be accommodated in any bucket since there is no available space.';
			}
		}
		return redirect()->route('current-placement.index')->with('success',$success_message)->with('error',$error_message);
	}
	private function putBallInBucket($bucket_id,$ball){
		if(BallsInBuckets::where('bucket_id',$bucket_id)->where('ball_id',$ball['id'])->exists()){
			BallsInBuckets::where('bucket_id',$bucket_id)->where('ball_id',$ball['id'])->increment('amount',intval($ball['amount']));
		}else{
			BallsInBuckets::create([
				'bucket_id' => $bucket_id,
				'ball_id' => $ball['id'],
				'amount' => intval($ball['amount'])
			]);
		}
	}
	private function putBallsInBucket($bucket_id,$balls){
		foreach($balls as $ball){
			$this->putBallInBucket($bucket_id,$ball);
		}
	}
}