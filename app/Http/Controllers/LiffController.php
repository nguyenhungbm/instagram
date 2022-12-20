<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiffController extends Controller
{
    public function login(Request $request)
    {
        return view('line.login');
    }

    public function chatbot(Request $request)
    {
        return view('line.chatbot');
    }
}
