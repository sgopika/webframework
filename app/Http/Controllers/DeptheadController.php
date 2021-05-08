<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeptheadController extends Controller
{
    public function deptheadhome(Request $request)
    {
    	return view('deptheaddashboard');
    }
}
