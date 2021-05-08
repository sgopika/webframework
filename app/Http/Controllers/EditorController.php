<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function editorhome(Request $request)
    {
    	return view('editordashboard');
    }
}
