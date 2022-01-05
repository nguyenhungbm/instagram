<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use App\Models\User;
use Twilio\Rest\Client;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // https://www.twilio.com/blog/add-chat-laravel-php-app-twilio-chat
    public function chat(Request $request){
        $authUser = $request->user();
        $ids = $request->id;
        $otherUser = User::find($ids);
        $users = User::where('id', '<>', $authUser->id)->get();
        $twilio = new Client(\Config::get('env.twilio_account_sid'), \Config::get('env.twilio_account_token'));

        // Fetch channel or create a new one if it doesn't exist
        try {
                $channel = $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                        ->channels($ids)
                        ->fetch();
        } catch (\Twilio\Exceptions\RestException $e) { 
                $channel = $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                        ->channels
                        ->create([
                                'uniqueName' => $ids,
                                'type' => 'private',
                        ]);
        }

        // Add first user to the channel
        try {
                $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                        ->channels($ids)
                        ->members($authUser->email)
                        ->fetch();

                    } catch (\Twilio\Exceptions\RestException $e) {
                            $member = $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                                    ->channels($ids)
                                    ->members
                                    ->create($authUser->email);
                    }
            
                    // Add second user to the channel
                    try { 
                            $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                                    ->channels($ids)
                                    ->members($otherUser->email)
                                    ->fetch();
            
                    } catch (\Twilio\Exceptions\RestException $e) {
                            $twilio->chat->v2->services(\Config::get('env.twilio_service_id'))
                                    ->channels($ids)
                                    ->members
                                    ->create($otherUser->email);
                    }
        return view('twilio.chat',compact('users', 'otherUser'));
    }
}
