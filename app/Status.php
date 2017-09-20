<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public  $table = 'status';
    public $fillable = ['status','requests', 'active'];
    public static $statuses = ['0'=>'Optimal', '1'=>'Bad', '2'=>'Emergency'];
    public static function get_all(){
        return Status::orderBy('id','DESC')->get();
    }
    public static function current_status(){
        return Status::where('active', '=', 1)->get();
    }

    public static function add_request($id){
        return Status::whereId($id)->increment('requests');

    }
    public function statusrequests()
    {
        return $this->hasMany('App\StatusRequest', 'status', 'status_id');
    }
    public static function clear_active(){
        return Status::where('active', '=', 1)->update(array('active' => 0));

    }
    public function getStatusNameAttribute()
    {
        $our_statuses = Status::$statuses;
        return $our_statuses[$this->status];
    }
}