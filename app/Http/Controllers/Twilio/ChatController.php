<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use App\Models\Twilio;
use App\Models\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Log;
use Str;
use Twilio\Rest\Client;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //https://www.twilio.com/blog/twilio-conversations-vue-js-part-two ( VueJs)
    // https://www.twilio.com/blog/add-chat-laravel-php-app-twilio-chat ( Laravel + Vuejs)
    // Lỗi Undefined index: name -> https://stackoverflow.com/questions/61177995/laravel-packagemanifest-php-undefined-index-name
    // Lỗi chỉ hiện tin nhắn của 1 bên : do khác channel đặt trong hàm "await client.getChannelByUniqueName(room);"
    public function index(Request $request)
    {
        $users = User::take(10)->get();
        $title = 'Chat';
        return view('twilio.messages.index', compact('users', 'title'));
    }

    public function list(Request $request)
    {
        $chat = Twilio::where('token', $request->channel)->whereNotNull('body')->get();
        return $chat;
    }

    public function chat(Request $request, $ids)
    {
        $authUser = $request->user();
        $otherUser = User::find(explode('-', $ids)[1]);
        $users = User::take(10)->get();
        $room = Twilio::where(function ($query) use ($otherUser) {
            $query->where('author', Auth::user()->email)->where('friend', $otherUser->email);
        })->orWhere(function ($query) use ($otherUser) {
            $query->where('author', $otherUser->email)->where('friend', Auth::user()->email);
        })->first();

        $twilio = new Client(Config::get('env.twilio_account_sid'), Config::get('env.twilio_account_token'));
        // Fetch channel or create a new one if it doesn't exist
        if (!$room) {
            $channel = $twilio->conversations->v1->conversations
                ->create([
                    "uniqueName" => $authUser->id . '-' . $otherUser->id,
                    "friendlyName" => $authUser->email . '-' . $otherUser->email
                ]);
            // add first user 
            $firstUser = $twilio->conversations->v1->conversations($channel->sid)
                ->participants
                ->create([
                        "identity" => $authUser->email
                    ]
                );

            // add second user 
            $secondUser = $twilio->conversations->v1->conversations($channel->sid)
                ->participants
                ->create([
                        "identity" => $otherUser->email
                    ]
                );
            $room = Twilio::create([
                'author' => Auth::user()->email,
                'friend' => $otherUser->email,
                'token' => Auth::user()->id . '-' . $otherUser->id,
                'channelSid' => $channel->sid
            ]);
        }

        $title = 'Chat';
        $otherUser->room = $room->token;
        $otherUser->channelSid = $room->channelSid;
        return view('twilio.chat', compact('users', 'otherUser', 'title'));
    }

    public function store(Request $request)
    {
        return Log::info($request->all());
        $message = Twilio::where('channelSid', $request->channelSid)->orderBy('id', 'desc')->first();
        if ($message->author == Auth::user()->email) {
            $friend = $message->friend;
        } else {
            $friend = $message->author;
        }
        $message->repeats = '0';
        $message->update();
        $chat = Twilio::create([
            'author' => Auth::user()->email,
            'friend' => $friend,
            'body' => $request->body,
            'token' => $message->token,
            'repeats' => 1,
            'channelSid' => $message->channelSid,
            'type' => $request->type
        ]);
        return 200;
    }
}
