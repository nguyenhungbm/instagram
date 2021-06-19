<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
class TwilioController extends Controller
{
    public function sms(Request $request){
        $response =new VoiceResponse();
        $response->dial($request->phone);
        $response->say('Goodbye');
        return 1;
    }
    public function voice(Request $request){
        $response =new VoiceResponse();
        $response->sms($request->body,[
            'to'  => $request->phone
        ]);
        $response->say('Goodbye');
        return 1;
    }
}
