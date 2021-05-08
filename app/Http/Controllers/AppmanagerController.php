<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppmanagerController extends Controller
{
    public function appmanagerhome(Request $request)
    {
    	return view('appmanagerdashboard');
    }
}
