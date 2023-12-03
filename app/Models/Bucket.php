<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Models\{Ball,BallsInBuckets};
class Bucket extends Model{
	use UUID;
	public $incrementing = false;
	protected $table = 'buckets';
	protected $primaryKey = 'id';
	protected $guarded = [];
	protected $hidden = [];
	public function ballPlacement(){
		return $this->hasMany(BallsInBuckets::class,'bucket_id','id');
	}
	public function balls(){
		return $this->hasManyThrough(Ball::class,BallsInBuckets::class);
	}
	public function filledVolume(){
		$filledVolume = 0;
		foreach($this->ballPlacement as $ballPlacement){
			$filledVolume += $ballPlacement->amount * $ballPlacement->ball->volume;
		}
		return $filledVolume;
	}
	public function emptyVolume(){
		return (floatval($this->volume) - floatval($this->filledVolume()));
	}
}