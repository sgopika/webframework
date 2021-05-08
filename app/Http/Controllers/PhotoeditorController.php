<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoeditorController extends Controller
{
    public function photoeditorhome(Request $request)
    {
    	return view('photoeditordashboard');
    }
}
