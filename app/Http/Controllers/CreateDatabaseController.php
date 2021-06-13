<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Jobs\CreateUser;
class CreateDatabaseController extends Controller
{
    public function create(Request $request)
    {
        CreateUser::dispatch();
        return 'success';
    }    
}