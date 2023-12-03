<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Models\BallsInBuckets;
class Ball extends Model{
	use UUID;
	public $incrementing = false;
	protected $table = 'balls';
	protected $primaryKey = 'id';
	protected $guarded = [];
	protected $hidden = [];
	public function buckets(){
		return $this->hasMany(BallsInBuckets::class,'ball_id','id');
	}
}