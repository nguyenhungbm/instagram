<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function friends(){
        return $this->belongsTo('App\Models\User', 'followed');
    }
    public static function checkFollow($follower, $followed){
        return static::where(['user_id'=>$follower, 'followed'=>$followed])->count(); 
    }
}
