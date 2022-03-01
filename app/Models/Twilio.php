<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Twilio extends Model
{
    use HasFactory;
    protected $table='twilio';
    protected $fillable = [
        'author', 'friend', 'token', 'body', 'repeats', 'channelSid', 'type'
    ];
}
