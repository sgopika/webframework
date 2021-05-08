<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppclientController extends Controller
{
    public function appclienthome(Request $request)
    {
    	return view('appclientdashboard');
    }
}
