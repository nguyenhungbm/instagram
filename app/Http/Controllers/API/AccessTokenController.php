<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
class AccessTokenController extends Controller
{
    public function generate_token()
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid =  env('PUSHER_APP_ID','AC4d77c8f248f512f494e2d7f8a77465cd');
        $apiKeySid = env('TWILIO_API_KEY_SID','SKf0fbe17ff19f5803453a908629e43398');
        $apiKeySecret = env('TWILIO_API_KEY_SECRET','dvR3C5vYTr1GadhkS0WvFPSrcub9xMgg');

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

}
