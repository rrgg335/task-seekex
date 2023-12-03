<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Models\{Ball,Bucket};
class BallsInBuckets extends Model{
	use UUID;
	public $incrementing = false;
	protected $table = 'balls_in_buckets';
	protected $primaryKey = 'id';
	protected $guarded = [];
	protected $hidden = [];
	public function bucket(){
		return $this->belongsTo(Bucket::class,'bucket_id','id');
	}
	public function ball(){
		return $this->belongsTo(Ball::class,'ball_id','id');
	}
}