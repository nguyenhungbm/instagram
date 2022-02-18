<?php

namespace App\Http\Controllers\API\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Twilio;
use Auth;
use Str;
use Log;
class ChatController extends Controller
{
    public function store(Request $request){
        Log::info($request->all());
        $message = Twilio::where('channelSid',$request['ConversationSid'])->orderBy('id','desc')->first();
        if($message->author == $request['Author']){
            $friend = $message->friend;
        }else{
            $friend = $message->author;
        }
        $message->repeats = '0';
        $message->update();
        $chat = Twilio::create([
            'author'    => $request['Author'],
            'friend'     => $friend, 
            'body'       => $request['Body'],
            'token'      => $message->token,
            'repeats'    => 1,
            'channelSid' => $message->channelSid,
            'type' => $request['Media'] ?? 'text'
        ]);
        return 200; 
    }
}
