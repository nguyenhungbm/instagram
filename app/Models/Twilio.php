<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Twilio extends Model
{
    use HasFactory;
    protected $table='twilios';
    protected $fillable = [
        'user_id','friend_id','token','chat','repeats','channelSid'
    ];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function friends(){
        return $this->belongsTo(User::class,'friend_id');
    }
}
