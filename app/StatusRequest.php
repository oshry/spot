<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class StatusRequest extends Model
{
    public $table = 'requests';
    public $fillable = ['status_id', 'code', 'percent'];
    public static function get_all(){
        $sreq = StatusRequest::orderBy('id','DESC')->get();
        return $sreq;
    }
    public static function get_curent_percents($id){
        return StatusRequest::where('status_id',$id)->sum('percent');
    }
    public static function current_odds($status_id){
        return StatusRequest::where('status_id', '=', $status_id)->get();
    }
    public function getStatusIdAttribute($value)
    {
        $our_statuses = Status::$statuses;
        return $our_statuses[$value];
    }
    public function status()
    {
        return $this->belongsTo('App\Status', 'status', 'status_id');
    }
//    public function status()
//    {
//        return $this->hasOne('App\Status', 'status', 'status_id');
//    }
}