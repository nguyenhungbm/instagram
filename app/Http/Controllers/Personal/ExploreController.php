<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;

class ExploreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $viewData = [
            'title' => 'Khám phá'
        ];
        return view('explore', $viewData);
    }
}
