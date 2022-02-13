<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use App\Models\User;
use App\Models\Twilio;
use Twilio\Rest\Client;
use Auth;
use Str;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // https://www.twilio.com/blog/add-chat-laravel-php-app-twilio-chat
    // Lỗi Undefined index: name -> https://stackoverflow.com/questions/61177995/laravel-packagemanifest-php-undefined-index-name
    // Lỗi chỉ hiện tin nhắn của 1 bên : do khác channel đặt trong hàm "await client.getChannelByUniqueName(room);"
    public function index(Request $request)
    {
        $users = User::take(10)->get();
        $title = 'Chat';
        return view('twilio.messages.index', compact('users','title')); 
    }
    public function list(Request $request)
    {
        $chat = Twilio::where('channelSid',$request->channelSid)->whereNotNull('chat')->get();  
        foreach($chat as $list){
            $list->body = $list->chat;
        }
        return $chat; 
    }
    public function chat(Request $request, $ids)
    {
        $authUser = $request->user();
        $otherUser = User::find(explode('-', $ids)[1]);
        $users = User::take(10)->get();
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
                    'type' => 'public',
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
        $title = 'Chat';
        $room = Twilio::where(function ($query) use ($otherUser) {
            $query->where('user_id', '=', Auth::id())->where('friend_id', '=', $otherUser->id);
        })->orWhere(function ($query) use ($otherUser) {
            $query->where('user_id', '=', $otherUser->id)->where('friend_id', '=', Auth::id());
        })->first();
        if(!$room){
            $room = Twilio::create([
                'user_id'    => Auth::id(), 
                'friend_id'  => $otherUser->id,
                'token'      => Auth::id().'-'.$otherUser->id,
                'channelSid' => $channel->serviceSid
            ]);
        }
        $otherUser->room = $room->token;
        $otherUser->channelSid = $channel->serviceSid;
        return view('twilio.chat', compact('users', 'otherUser','title','channel'));
    }

    public function store(Request $request){
        $message = Twilio::where('channelSid',$request->channelSid)->first();
        if($message->user_id == Auth::id()){
            $friend = $message->friend_id;
        }else{
            $friend = $message->user_id;
        }
        $message->repeats = '0';
        $message->update();
        $chat = Twilio::create([
            'user_id'    => Auth::id(),
            'friend_id'  => $friend,
            'chat'       => $request->chat,
            'token'      => $message->token,
            'repeats'    => 1,
            'channelSid' => $message->channelSid
        ]);
        return 200;
    }
}
