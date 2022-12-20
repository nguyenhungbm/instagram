<?php

namespace App\Http\Controllers\API\Twilio;

use App\Http\Controllers\Controller;
use App\Models\Twilio;
use Auth;
use Config;
use Illuminate\Http\Request;
use Log;
use Str;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
        $message = Twilio::where('channelSid', $request['ConversationSid'])->orderBy('id', 'desc')->first();
        if ($message->author == $request['Author']) {
            $friend = $message->friend;
        } else {
            $friend = $message->author;
        }
        $message->repeats = '0';
        $message->update();
        $url = 'https://mcs.us1.twilio.com/v1/Services/' . Config::get('env.twilio_service_id') . '/Media/';
        $chat = Twilio::create([
            'author' => $request['Author'],
            'friend' => $friend,
            'body' => $request['Body'] ?? $url . json_decode($request['Media'])[0]->Sid,
            'token' => $message->token,
            'repeats' => 1,
            'channelSid' => $message->channelSid,
            'type' => $request['Media'] ? json_decode($request['Media'])[0]->ContentType : 'text'
        ]);
        return 200;
    }
}
