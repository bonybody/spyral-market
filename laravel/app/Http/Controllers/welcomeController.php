<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    //
    public function welcome(Request $request)
    {
        return view('welcomes.welcome');
    }
}
