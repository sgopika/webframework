<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivestreamingController extends Controller
{
    public function livestreaminghome(Request $request)
    {
    	return view('livestreamingdashboard');
    }
}
