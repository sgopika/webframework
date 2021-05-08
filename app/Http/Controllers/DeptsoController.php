<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Appdepartment;
use App\Appsection;
use DB;

class DeptsoController extends Controller
{
    public function deptsohome(Request $request)
    {
    	return view('deptsodashboard');
    }

    public function appdepartment(Request $request)
    {
    	return view('deptso.appdepartment');
    }
    public function varifieditems(Request $request)
    {
        return view('deptso.varifieditems');
    }
    public function appsection(Request $request)
    {
        return view('deptso.appsection');
    }
    public function appdepartmentlist(Request $request) {

    	/*$listdata = Activity::where('contributor_status',1)->where('moderator_status',0)->where('approve_status',0)->get();

    	return view('deptso.appdepartmentlist',compact('listdata'));*/
        if(Auth::user()->usertypes_id==16){
        $deptid = Auth::user()->departments_id;
        
            $listdata = DB::table('appdepartments')
                        ->select('id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','status')
                        ->where('contributor_status',1)
                        ->where('moderator_status','!=',2)
                        ->get(); 
              

            return view('deptso.appdepartmentlist',compact('listdata'));
        } 
        else if(Auth::user()->usertypes_id==14){
        $deptid = Auth::user()->departments_id;
        
            $listdata = DB::table('appdepartments')
                        ->select('id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','status')
                        ->where('moderator_status',2)
                        ->where('approve_status','!=',2)
                        ->get(); 
              

            return view('deptso.appdepartmentlist',compact('listdata'));
        }
    	
    	
    }
    public function appdepartmentview(Request $request, $id) {

       if($request->ajax())
        {
            if(Auth::user()->usertypes_id==14){
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s'),
                 
            );

            } else if(Auth::user()->usertypes_id==16){
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s'),
                
            );
           
            } 
            //dd($formdata);
           Appdepartment::whereId($id)->update($formdata); 
        }
        return response()->json(['success' => 'Data is successfully updated']); 
        
    }
    
    
    public function appdepartmentlistaprove(Request $request) {

        /*$listdata = Activity::where('contributor_status',1)->where('moderator_status',0)->where('approve_status',0)->get();

        return view('deptso.appdepartmentlist',compact('listdata'));*/
        if(Auth::user()->usertypes_id==14){
        $deptid = Auth::user()->id;
        
            $listdata = DB::table('appdepartments')
                        ->select('id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','moderator_timestamp','status')
                        ->where('moderator_status',2)
                        ->where('approve_userid',$deptid)
                        ->where('approve_status',2)
                        ->get(); 
              
        }
         else if(Auth::user()->usertypes_id==16){
        $deptid = Auth::user()->id;
        
            $listdata = DB::table('appdepartments')
                        ->select('id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','moderator_timestamp','status')
                        ->where('contributor_status',1)
                        ->where('moderator_userid',$deptid)
                        ->where('moderator_status',2)
                        ->get(); 
            
        } 
        return view('deptso.appdepartmentlistaprove',compact('listdata'));
        
    }
    public function contributedactupdate(Request $request)
    {
       
        if($request->ajax())
        {
            if(Auth::user()->usertypes_id==14){
            $formdata = array(
                'approve_remarks' => $request->moderator_remarks,
                'approve_status' =>  2,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s'),
                'lock_status' => 1
                
            );
            Appdepartment::whereId($request->hidden_id)->update($formdata);

            } else if(Auth::user()->usertypes_id==16){
            $formdata = array(
                'moderator_remarks' => $request->moderator_remarks,
                'moderator_status' =>  2,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s'),
                'lock_status' => 1
                
            );
            Appdepartment::whereId($request->hidden_id)->update($formdata);
            } 
            
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function appsectionlist(Request $request) {
        if(Auth::user()->usertypes_id==16){
        $listdata = DB::table('appsections')
                    ->select('id','ensectionname','malsectionname','status')
                    ->where('contributor_status',1)
                    ->where('moderator_status','<',2)
                    ->get();    

        
        } 
        else if(Auth::user()->usertypes_id==14){
        $listdata = DB::table('appsections')
                    ->select('id','ensectionname','malsectionname','status')
                    ->where('moderator_status',2)
                    ->where('approve_status','!=',2)
                    ->get();    

        } 
        return view('deptso.appsectionlist',compact('listdata'));
       
    }
    public function appsectionview(Request $request, $id)
    {

        if($request->ajax())
        {
            if(Auth::user()->usertypes_id==14){
                $formdata = array(
                   
                    'approve_status' =>  1,
                    'approve_userid' =>  Auth::user()->id,
                    'approve_timestamp' =>  date('Y-m-d H:i:s')
                    
                    
                );
            
            } else if(Auth::user()->usertypes_id==16){
                $formdata = array(
                    
                    'moderator_status' =>  1,
                    'moderator_userid' =>  Auth::user()->id,
                    'moderator_timestamp' =>  date('Y-m-d H:i:s')
                    
                    
                );
           
            } 
            Appsection::whereId($id)->update($formdata);

            
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function appsectionrevert(Request $request, $id)
    {

        if($request->ajax())
        {
            if(Auth::user()->usertypes_id==14){
                $formdata = array(
                   
                    'approve_status' =>  3,
                    'approve_userid' =>  Auth::user()->id,
                    'approve_timestamp' =>  date('Y-m-d H:i:s'),
                    'lock_status' => 1
                    
                );
            
            } else if(Auth::user()->usertypes_id==16){
                $formdata = array(
                    
                    'moderator_status' =>  3,
                    'moderator_userid' =>  Auth::user()->id,
                    'moderator_timestamp' =>  date('Y-m-d H:i:s'),
                    'lock_status' => 1
                    
                );
           
            } 
            Appsection::whereId($id)->update($formdata);

            
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function appsectionlistupdate(Request $request)
    {

        if($request->ajax())
        {
            if(Auth::user()->usertypes_id==14){
                $formdata = array(
                    'approve_remarks' => $request->moderator_remarks,
                    'approve_status' =>  2,
                    'approve_userid' =>  Auth::user()->id,
                    'approve_timestamp' =>  date('Y-m-d H:i:s'),
                    'lock_status' => 1
                    
                );
            
            } else if(Auth::user()->usertypes_id==16){
                $formdata = array(
                    'moderator_remarks' => $request->moderator_remarks,
                    'moderator_status' =>  2,
                    'moderator_userid' =>  Auth::user()->id,
                    'moderator_timestamp' =>  date('Y-m-d H:i:s'),
                    'lock_status' => 1
                    
                );
           
            } 
            Appsection::whereId($request->hidden_id)->update($formdata);

            
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function appsectionlistaproved(Request $request)
    {
       $deptid = Auth::user()->id;
        
        if(Auth::user()->usertypes_id==14){
        
            $listdata = DB::table('appsections')
                        ->select('id','ensectionname','malsectionname','moderator_timestamp','status')
                        ->where('moderator_status',2)
                        ->where('approve_userid',$deptid)
                        ->where('approve_status',2)
                        ->get(); 
              
        }
         else if(Auth::user()->usertypes_id==16){
        
            $listdata = DB::table('appsections')
                        ->select('id','ensectionname','malsectionname','moderator_timestamp','status')
                        ->where('contributor_status',1)
                        ->where('moderator_userid',$deptid)
                        ->where('moderator_status',2)
                        ->get(); 
            
        } 
        return view('deptso.appsectionlistaproved',compact('listdata'));
        
    }
}
