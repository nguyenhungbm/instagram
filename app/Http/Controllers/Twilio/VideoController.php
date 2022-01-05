<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class VideoController extends Controller
{
    // https://www.twilio.com/blog/create-video-conference-app-laravel-php-vue-js
    public function video(){
        return view('twilio.video');
    }
   
}
