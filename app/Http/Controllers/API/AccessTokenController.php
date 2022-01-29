<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use App\Models\User;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\ChatGrant;
use App\Models\Room;
use Auth;
use Str;
class AccessTokenController extends Controller
{
    public function generate_token_video()
    {
        // Substitute your Twilio Account SID and API Key details 

        $accountSid     = \Config::get('env.twilio_account_sid');
        $apiKeySid      = \Config::get('env.twilio_api_key_sid');
        $apiKeySecret   = \Config::get('env.twilio_api_key_secret');

        $identity = uniqid();
        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity,
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);

        // Serialize the token as a JWT
        echo $token->toJWT();
    }
    public function generate_token_chat(Request $request){
        $token = new AccessToken(
            \Config::get('env.twilio_account_sid'),
            \Config::get('env.twilio_api_key_sid'),
            \Config::get('env.twilio_api_key_secret'),
            3600,
            $request->email
        );

        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid(\Config::get('env.twilio_service_id'));

        $token->addGrant($chatGrant);

        return response()->json([
            'token' => $token->toJWT()
        ]);
    }
    public function room(Request $request){
        $token ='';
        $id = $request->other;
        $user = $request->user;
        $room = Room::where(function ($query) use ($id,$user) {
            $query->where('user_id', $user)->where('friend_id', $id);
        })->orWhere(function ($query) use ($id,$user) {
            $query->where('user_id', $id)->where('friend_id', $user);
        })->first();
        $first = User::find($user);
        $second = User::find($id);
        if($room){
            $token = $room->token;
        }else{
            $token = $first->user.$user.'-'.$second->user.$id;
            Room::create([
                'user_id'   => $user, 
                'friend_id' => $id,
                'token'     => $token
            ]);
        }
        return $token;
    }
}
