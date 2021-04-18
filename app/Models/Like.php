<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory; 
    public static function checkLove($postId){
        if(static::where(['r_post'=>$postId,'r_user_id'=>\Auth::user()->id ])->exists())
            return '2';
        return '';
    }
    public function users(){
        return $this->belongsTo(User::class,"r_user_id");
    }
}
