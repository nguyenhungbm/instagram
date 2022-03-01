<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'message', 'user_id' , 'group_id', 'avatar'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function group(){
        return $this->belongsTo('App\Models\Group', 'group_id');
    }
}
