<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    // https://www.twilio.com/blog/create-video-conference-app-laravel-php-vue-js
    public function video()
    {
        return view('twilio.video');
    }

}
