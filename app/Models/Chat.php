<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\BroadcastChat;

class Chat extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'created' => BroadcastChat::class
    ];
    protected $fillable = ['user_id', 'friend_id', 'chat', 'repeats', 'created_at', 'type'];
    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function friends(){
        return $this->belongsTo('App\Models\User', 'friend_id');
    }
}
