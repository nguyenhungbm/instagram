<?php

namespace App\Http\Controllers;

use App\Models\User;
use File;
use Redirect;
use Response;
use Socialite;
use Validator;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);
        return redirect()->to('/');
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'c_name' => $getInfo->name,
                'email' => $getInfo->email,
                'avatar' => $getInfo->avatar,
                'user' => $getInfo->name,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'is_active' => 1
            ]);
        }
        return $user;
    }
}