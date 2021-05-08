<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appdepartment;

use Auth;
use DB;
use Carbon\Carbon;

class DeptasstController extends Controller
{
    public function deptassthome(Request $request)
    {
    	return view('deptasstdashboard');
    }

    // Department Details (Start) //

    public function appdepartmentlist(Request $request) {

        $deptid = Auth::user()->departments_id;
        $cntdata = DB::table('appdepartments')
                    ->where('departments_id',$deptid)
                    ->count(); 
        if($cntdata>0)
        {
	        $listdata = DB::table('appdepartments')
	                    ->select('id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','status')
	                    ->where('departments_id',$deptid)
	                    ->first(); 
	          

	        return view('deptasst.appdepartmentcreate',compact('listdata'));
    	} else {
    		return view('deptasst.appdepartmentcreate');
    	}
    }

    public function appdepartmentstore(Request $request)
    {
        
         $request->validate([
            
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'enabout'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malabout'  =>'required|min:3|max:1000',
            'enstructure'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malstructure'  =>'required|min:3|max:1000',
            'encontact'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontact'  =>'required|min:3|max:1000',
            'enrelatedlinks'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malrelatedlinks'  =>'required|min:3|max:1000',
            'enservices'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malservices'  =>'required|min:3|max:1000'


        ]);

        
        $chkrows= Appdepartment::where('entitle',$request->entitle)->exists() ? 1 : 0;
        if($chkrows==0){

        	$deptid = Auth::user()->departments_id;
            $now = Carbon::now();
        	$get_deptdet = DB::table('departments')->where('id',$deptid)->first();
           
                $resultsave = new Appdepartment([
                    'deptcategories_id'=>  $get_deptdet->deptcategories_id,
                    'departments_id' =>  $deptid,
                    'entitle'        =>  $request->entitle,
                    'maltitle'       =>  $request->maltitle,
                    'enabout'        =>  $request->enabout,
                    'malabout'       =>  $request->malabout,
                    'enstructure'    =>  $request->enstructure,
                    'malstructure'   =>  $request->malstructure,
                    'encontact'      =>  $request->encontact,
                    'malcontact'     =>  $request->malcontact,
                    'enrelatedlinks' =>  $request->enrelatedlinks,
                    'malrelatedlinks'=>  $request->malrelatedlinks,
                    'enservices'     =>  $request->enservices,
                    'malservices'    =>  $request->malservices,
                    'contributor_status'=>  '1',
                    'contributor_userid'=> Auth::user()->id,
                    'contributor_timestamp'=> $now ,
                    'users_id'       => Auth::user()->id
                ]);
                
                
                $resultsave->save();
                return redirect('deptasst/appdepartmentlist')->with('success', 'App Department Added!');
        } else {
        	return redirect('deptasst/appdepartmentlist')->with('errors', 'Already an App Department with same name exists.');
             
        }
            
            
            
        
        
        
    }

    
    /*public function deptlockstatus(Request $request, $id)
    {   if($request->ajax())
        { 

            
            dd($id);
        $cntdata = DB::table('appdepartments')
                    ->where('id',$id)->first();
                    $lockstatus = $cntdata->lock_status;dd($lockstatus);
        if ($lockstatus==1) {
                //return redirect('deptasst/appdepartmentcreate');
                return response()->json(['error' => 'Locked.']);
            }  
        else{
            return response()->json(['success' => 'App Department update.']);
        }
        }  

    }*/
    public function appsectionrevertedlist(Request $request) {

        $uid = Auth::user()->id;
       $listdata = DB::table('appsections')
                    ->select('id','ensectionname','malsectionname','moderator_status','approve_status','status','lock_status')
                    ->where('users_id', $uid)
                    ->where('moderator_status', 3)
                    ->orWhere('approve_status', 3)
                    ->get();    

        return view('deptasst.appsectionrevertedlist',compact('listdata'));
    }
    public function appdepartmentupdate(Request $request)
    {
        $request->validate([
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'enabout'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malabout'  =>'required|min:3|max:1000',
            'enstructure'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malstructure'  =>'required|min:3|max:1000',
            'encontact'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontact'  =>'required|min:3|max:1000',
            'enrelatedlinks'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malrelatedlinks'  =>'required|min:3|max:1000',
            'enservices'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malservices'  =>'required|min:3|max:1000'


        ]);
        
        $get_appdept = Appdepartment::whereId($request->hidden_id)->first();
        $lockstatus = $get_appdept->lock_status;
        if($lockstatus==0){
            $deptid = Auth::user()->departments_id;
            $now = Carbon::now();
            $get_deptdet = DB::table('departments')->where('id',$deptid)->first();
             $form_data = array(
                    'deptcategories_id'=>  $get_deptdet->deptcategories_id,
                    'departments_id' =>  $deptid,
                    'entitle'        =>  $request->entitle,
                    'maltitle'       =>  $request->maltitle,
                    'enabout'        =>  $request->enabout,
                    'malabout'       =>  $request->malabout,
                    'enstructure'    =>  $request->enstructure,
                    'malstructure'   =>  $request->malstructure,
                    'encontact'      =>  $request->encontact,
                    'malcontact'     =>  $request->malcontact,
                    'enrelatedlinks' =>  $request->enrelatedlinks,
                    'malrelatedlinks'=>  $request->malrelatedlinks,
                    'enservices'     =>  $request->enservices,
                    'malservices'    =>  $request->malservices,
                    'contributor_status'=>  '1',
                    'contributor_userid'=> Auth::user()->id,
                    'contributor_timestamp'=> $now ,
                    'users_id'       => Auth::user()->id
                );
              
        
            Appdepartment::whereId($request->hidden_id)->update($form_data);
            return redirect('deptasst/appdepartmentlist')->with('success', 'App Department Updated!');
        } else {
            return redirect('deptasst/appdepartmentlist')->with('errors', 'App Department Locked!');
        }
    		
            
         
            
        
                

    }

    
    // Department Details (end) //
	
	
	// Section Details(start) //
	
	
	
	// Section Details(end) //
}
