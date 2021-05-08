<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usertype;
use App\Component;
use App\Componentpermission;
use App\Menulinktype;
use App\Contenttype;
use App\Filetype;
use App\Communicationtype;
use App\Staffcategory;
use App\Office;
use App\Department;
use App\Designation;
use App\Sitesetting;
use App\Language;
use App\Sitecontrollabel;
use App\User;
use App\Deptcategory;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminhome(Request $request)
    {
    	return view('admindashboard');
    }


 public function sendalert($number, $message)
    {


//                $number = $mobile;
        $link = curl_init();
        curl_setopt($link , CURLOPT_URL, "http://api.esms.kerala.gov.in/fastclient/SMSclient.php?username=cmtenpoint&password=cmten123&message=".$message."&numbers=".$number."&senderid=KLMGOV");
        curl_setopt($link , CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($link , CURLOPT_HEADER, 0);
       // curl_exec($link);
      //  curl_close($link );
        return $output = curl_exec($link);
        curl_close($link );


    }
    /////////////////////User Type(start)////////////////////////////////////
	
	
	public function usertypelist(Request $request)
    {
           $listdata = DB::table('usertypes')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.usertypelist',compact('listdata'));
    }

    public function usertypestore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Usertype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Usertype([
	                'entitle'        =>  $request->name
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already an User Type with same name exists.']);
	        }    
        }
        
    }

    public function usertypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Usertype::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function usertypeupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Usertype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name
	            );
	            Usertype::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already an User Type with same name exists.']);
	        }    
        }
        
    }

    public function usertypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Usertype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function usertypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('usertypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('usertypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('usertypes')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	/////////////////////User Type(end)////////////////////////////////////
    /////////////////////Component(start)////////////////////////////////////
    
    
    public function componentlist(Request $request)
    {
           $listdata = DB::table('components')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.componentlist',compact('listdata'));
    }

    public function componentstore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'order'  =>'required|integer'

        ]);

        if($request->ajax())
        {
            $userid=Auth::user()->id;
            $chkrows= Component::where('entitle',$request->name)->where('order',$request->order)->exists() ? 1 : 0;
            if($chkrows==0){



                $resultsave = new Component([
                    'entitle'   =>  $request->name,
                    'order'    =>  $request->order,
                    'users_id' => $userid
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            }    
        }
        
    }

    public function componentedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Component::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function componentupdate(Request $request)
    {
         $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'order'  =>'required|integer'

        ]);
        if($request->ajax())
        {
             $userid=Auth::user()->id;

        $chkrows= Component::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


                $form_data = array(
                    'entitle'   =>  $request->name,
                    'order'    =>  $request->order,
                    'users_id' => $userid
                );
                
                Component::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            }    
        }
        
    }

    public function componentdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Component::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function componentstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('components')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('components')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('components')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    /////////////////////Component(end)////////////////////////////////////
     /////////////////////Component  Permission(start)////////////////////////////////////
    
    
    public function componentpermissionlist(Request $request)
    {

       
           $listdata = DB::table('componentpermissions')
           ->join('components','components.id','=','componentpermissions.components_id')
            ->join('usertypes','usertypes.id','=','componentpermissions.usertypes_id')
            ->select('componentpermissions.id as id','components.entitle as componenttitle','componentpermissions.usertypes_id as usertypes_id','componentpermissions.status as status')
            ->get();
         $usertype     = DB::table('usertypes')->orderBy('id','asc')->get();

        return view('admin.componentpermissionlist',compact('listdata','usertype'));
    }

    public function permissioncreate(Request $request)
    {
        if($request->ajax())
        {
              
            
            $usertype     = DB::table('usertypes')->orderBy('id','asc')->get();
            $component    = DB::table('components')->orderBy('id','asc')->get();
            
            return response()->json(['usertype' => $usertype, 'component' => $component]);
        }
    }


    public function componentpermissionstore(Request $request)
    {
        $request->validate([
            'componentid'  =>'required',
            'usertypeid'  =>'required'

        ]);

        if($request->ajax())
        {
            $usertypeid=implode(',', $request->usertypeid);

            $userid=Auth::user()->id;
            $chkrows= Componentpermission::where('components_id',$request->componentid)->exists() ? 1 : 0;
            if($chkrows==0){



                $resultsave = new Componentpermission([
                    'components_id'   =>  $request->componentid,
                    'usertypes_id'    =>  $usertypeid,
                    'users_id' => $userid
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a permission set  with same user type exists.']);
            }    
        }
        
    }

    public function componentpermissionedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentpermission::find($id);
            $usertype     = DB::table('usertypes')->orderBy('id','asc')->get();
            $component    = DB::table('components')->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'usertype' => $usertype, 'component' => $component]);
        }

    }

    public function componentpermissionupdate(Request $request)
    {
          $request->validate([
            'componentid'  =>'required',
            'usertypeid'  =>'required'

        ]);
        if($request->ajax())
        {
            $usertypeid=implode(',', $request->usertypeid);
             $userid=Auth::user()->id;

        $chkrows= Componentpermission::where('components_id',$request->componentid)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
        
            if($chkrows==0){


                $form_data = array(
                    'components_id'   =>  $request->componentid,
                    'usertypes_id'    =>  $usertypeid,
                    'users_id' => $userid
                );
                
                Componentpermission::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a permission set  with same user type exists.']);
            }    
        }
        
    }

    public function componentpermissiondestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentpermission::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function componentpermissionstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentpermissions')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentpermissions')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentpermissions')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    /////////////////////Component Permission(end)////////////////////////////////////
    /////////////////////Menu link Type(start)////////////////////////////////////
    
    
    public function menulinktypelist(Request $request)
    {
           $listdata = DB::table('menulinktypes')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.menulinktypelist',compact('listdata'));
    }

    public function menulinktypestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
            $userid=Auth::user()->id;
            $chkrows= Menulinktype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Menulinktype([
                    'entitle'  =>  $request->name,
                    'users_id' => $userid
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Menulink Type with same name exists.']);
            }    
        }
        
    }

    public function menulinktypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Menulinktype::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function menulinktypeupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'
        ]);
        if($request->ajax())
        {
            $userid=Auth::user()->id;
            $chkrows= Menulinktype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'users_id' => $userid
                );
                Menulinktype::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Menulink Type with same name exists.']);
            }    
        }
        
    }

    public function menulinktypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Menulinktype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function menulinktypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('menulinktypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('menulinktypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('menulinktypes')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    /////////////////////Menu Link Type(end)////////////////////////////////////

       /*     Content types   */ 
    public function contenttypelist(Request $request)
    {
           $listdata = DB::table('contenttypes')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('admin.contenttypelist',compact('listdata'));
    }

    public function contenttypestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Contenttype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Contenttype([
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function contenttypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Contenttype::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function contenttypeupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Contenttype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'users_id'   =>  Auth::user()->id
                );
                Contenttype::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function contenttypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Contenttype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function contenttypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('contenttypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('contenttypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('contenttypes')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

     /*    Content types   */ 

    /*     File types   */ 
    public function filetypelist(Request $request)
    {
           $listdata = DB::table('filetypes')
           ->join('contenttypes','contenttypes.id','=','filetypes.contenttypes_id')
           ->select('filetypes.id','filetypes.entitle','filetypes.maltitle','contenttypes.entitle as contenttitle','filetypes.status')
            ->get();
        

        return view('admin.filetypelist',compact('listdata'));
    }


     public function filetypecreate(Request $request)
    {
        if($request->ajax())
        {
              
            
           
            $contenttype    = DB::table('contenttypes')->orderBy('id','asc')->get();
            
            return response()->json(['contenttype' => $contenttype]);
        }
    }

    public function filetypestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'contenttypeid'=>'required'

        ]);

        if($request->ajax())
        {
            $chkrows= Filetype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Filetype([
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'contenttypes_id'        =>  $request->contenttypeid,
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Filetype with same name exists.']);
            }    
        }
        
    }

    public function filetypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Filetype::find($id);
             $contenttype    = DB::table('contenttypes')->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'contenttype'=>$contenttype]);
        }

    }

    public function filetypeupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'contenttypeid'=>'required'
        ]);
        if($request->ajax())
        {
            $chkrows= Filetype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'contenttypes_id' =>  $request->contenttypeid,
                    'users_id'       => Auth::user()->id
                );
                Filetype::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Filetype with same name exists.']);
            }    
        }
        
    }

    public function filetypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Filetype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function filetypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('filetypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('filetypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('filetypes')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

     /*File types*/ 

     /*      Communication type     */


     public function communicationtypelist(Request $request)
    {
           $listdata = DB::table('communicationtypes')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.communicationtypelist',compact('listdata'));
    }

    public function communicationtypestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Communicationtype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Communicationtype([
                    'entitle'        =>  $request->name,
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Communication Type with same name exists.']);
            }    
        }
        
    }

    public function communicationtypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Communicationtype::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function communicationtypeupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Communicationtype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'users_id'       => Auth::user()->id
                );
                Communicationtype::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already an Communication Type with same name exists.']);
            }    
        }
        
    }

    public function communicationtypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Communicationtype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function communicationtypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('communicationtypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('communicationtypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('communicationtypes')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    /*Communication type*/

    /*     Users    */

    public function userlist(Request $request)
    {
           $listdata = DB::table('users')
            ->select('id','name','status')
            ->get();
        

        return view('admin.userlist',compact('listdata'));
    }

     public function usercreate(Request $request)
    {
        if($request->ajax())
        {
              
            
           
            $department    = DB::table('departments')->orderBy('id','asc')->get();
            $designation   = DB::table('designations')->orderBy('id','asc')->get();
            $office    = DB::table('offices')->orderBy('id','asc')->get();
            $staffcategory   = DB::table('staffcategories')->orderBy('id','asc')->get();
            $usertype    = DB::table('usertypes')->orderBy('id','asc')->get();
           
            return response()->json(['department' => $department,'designation'=>$designation,'office'=>$office,'staffcategory'=>$staffcategory,'usertype'=>$usertype]);
        }
    }

    public function userstore(Request $request)
    {
         
        $request->validate([
            'name'              =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'email'             =>'required|email|min:10|max:40',
            'password'          =>'required|min:8', 
            'malname'           =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'mobile'            =>'required|digits:10',
            'staffcategoryid'   =>'required',
            'desgnid'           =>'required',
            'deptid'            =>'required',
            'officeid'          =>'required',
            'usertypeid'        =>'required'

        ]);

        if($request->ajax())
        {
            $chkrows= User::where('name',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){

                $resultsave = new User([
                    'name'          =>  $request->name,
                    'email'         => $request->email,
                    'password'      =>  Hash::make($request->password),
                    'malname'       => $request->malname,
                    'mobile'        => $request->mobile,
                    'staffcategories_id'=> $request->staffcategoryid,
                    'designations_id'   => $request->desgnid,
                    'departments_id'    => $request->deptid,
                    'offices_id'        => $request->officeid,
                    'usertypes_id'      => $request->usertypeid,
                    'users_id'          => Auth::user()->id

                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            }    
        }
        
    }

    public function useredit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = User::find($id);
             $department    = DB::table('departments')->orderBy('id','asc')->get();
            $designation   = DB::table('designations')->orderBy('id','asc')->get();
            $office    = DB::table('offices')->orderBy('id','asc')->get();
            $staffcategory   = DB::table('staffcategories')->orderBy('id','asc')->get();
            $usertype    = DB::table('usertypes')->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'department' => $department,'designation'=>$designation,'office'=>$office,'staffcategory'=>$staffcategory,'usertype'=>$usertype]);
        
        }

    }

    public function userupdate(Request $request)
    {
        $request->validate([
            'name'              =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'email'             =>'required|email|min:10|max:40',
            'password'          =>'required|min:8', 
            'malname'           =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'mobile'            =>'required|digits:10',
            'staffcategoryid'   =>'required',
            'desgnid'           =>'required',
            'deptid'            =>'required',
            'officeid'          =>'required',
            'usertypeid'        =>'required'
        ]);

        if($request->ajax())
        {
            $chkrows= User::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'name'          =>  $request->name,
                    'email'         => $request->email,
                    'password'      =>  Hash::make($request->password),
                    'malname'       => $request->malname,
                    'mobile'        => $request->mobile,
                    'staffcategories_id'=> $request->staffcategoryid,
                    'designations_id'   => $request->desgnid,
                    'departments_id'    => $request->deptid,
                    'offices_id'        => $request->officeid,
                    'usertypes_id'      => $request->usertypeid,
                    'users_id'          => Auth::user()->id


                );
                User::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already an User with same name exists.']);
            }    
        }
        
    }

    public function userdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            User::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function userstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('users')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('users')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('users')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


    /*     Users    */

    /*   Site Setting */
public function sitesettinglist(Request $request)
    {
           $listdata = DB::table('sitesettings')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.sitesettinglist',compact('listdata'));
    }

    public function sitesettingstore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Sitesetting::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Sitesetting([
                    'entitle'        =>  $request->name,
                    'users_id'          => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            }    
        }
        
    }

    public function sitesettingedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Sitesetting::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function sitesettingupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:150|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);
        if($request->ajax())
        {
            $chkrows= Sitesetting::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'users_id'          => Auth::user()->id
                );
                Sitesetting::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            }    
        }
        
    }

    public function sitesettingdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Sitesetting::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function sitesettingstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('sitesettings')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('sitesettings')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('sitesettings')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*   Site Setting */

/* Language   */

public function languagelist(Request $request)
    {
           $listdata = DB::table('languages')
            ->select('id','entitle','status')
            ->get();
        

        return view('admin.languagelist',compact('listdata'));
    }

    public function languagestore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Language::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Language([
	                'entitle'        =>  $request->name,
                    'users_id'          => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a language with same name exists.']);
	        }    
        }
        
    }

    public function languageedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Language::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function languageupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:150|regex:/(^[-0-9A-Za-z\s ]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Language::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name,
                    'users_id'          => Auth::user()->id
	            );
	            Language::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a language with same name exists.']);
	        }    
        }
        
    }

    public function languagedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Language::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function languagestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('languages')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('languages')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('languages')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }

    /*  Language  */

    /*  Site Control Label */

     public function sitecontrollabellist(Request $request)
    {
           $listdata = DB::table('sitecontrollabels')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('admin.sitecontrollabellist',compact('listdata'));
    }

    public function sitecontrollabelstore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Sitecontrollabel::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Sitecontrollabel([
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a site control label with same name exists.']);
            }    
        }
        
    }

    public function sitecontrollabeledit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Sitecontrollabel::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function sitecontrollabelupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Sitecontrollabel::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'users_id'   =>  Auth::user()->id
                );
                Sitecontrollabel::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function sitecontrollabeldestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Sitecontrollabel::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function sitecontrollabelstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('sitecontrollabels')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('sitecontrollabels')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('sitecontrollabels')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


    /* Dept Category  */

    public function deptcategorylist(Request $request)
    {
           $listdata = DB::table('deptcategories')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('admin.deptcategorylist',compact('listdata'));
    }

    public function deptcategorystore(Request $request)
    {
        $request->validate([
            'entitle'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Deptcategory::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Deptcategory([
                    'entitle'        =>  $request->entitle,
                    'maltitle'        =>  $request->maltitle,
                    'users_id'        =>  Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Department Category with same name exists.']);
            }    
        }
        
    }

    public function deptcategoryedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Deptcategory::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function deptcategoryupdate(Request $request)
    {
        $request->validate([
            'entitle'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Deptcategory::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'        =>  $request->entitle,
                    'maltitle'        =>  $request->maltitle,
                    'users_id'        =>  Auth::user()->id
                );
                Deptcategory::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Department Category with same name exists.']);
            }    
        }
        
    }

    public function deptcategorydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Deptcategory::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function deptcategorystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('deptcategories')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('deptcategories')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('deptcategories')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Dept Category (end)// 

 ////////////////////Change Password(start)/////////////////////////////////

    public function changepasswordview()
    {

        return view('changepassword');
    }

    public function checkoldpassword(Request $request){

        if($request->ajax())
        {
            $request->validate([
            'oldpwd' => 'required'
            ]);

            $pwd = $request->oldpwd;
            $user = User::find(Auth::user()->id);
            if (Hash::check($pwd, $user->password)) 
                $flagvalue = 1;
            else
                $flagvalue = 0;
        }
        
        return response()->json(['flagvalue' => $flagvalue]);
    }


    public function changepasswordaction(Request $request)
    {
        $request->validate([
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|min:8',
        ]);
        $newpassword = Hash::make($request->newpassword);
        User::whereId(Auth::user()->id)->update(['password' => $newpassword]);
        User::whereId(Auth::user()->id)->increment('password_reset',1);
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();
        Session::flush();
        return redirect()->route('logout');
    }

    ////////////////////Change Password(end)/////////////////////////////////
/*Reset password*/


public function resetpasswordview()
    {

        return view('resetpassword');
    }
 public function resetpasswordaction(Request $request)
    {
        $request->validate([
            'username' => 'required|email|exists:users',
            'resettype' => 'required',
        ]);

       //  $passwordnew=str_random(8);

       
        $chkrows= User::where('email',$request->username)->exists() ? 1 : 0;
            if($chkrows==1){
                $passwordnew='cditadmin1234#';
                $form_data = array(
                   
                    'password'      =>  Hash::make($passwordnew),
                    'users_id'          => Auth::user()->id


                );
                User::where('email',$request->username)->update($form_data);

      /*  if($request->resettype==1)
         {
              $message = 'Your Reset password is  '.$passwordnew. '.';
           $send = $this->sendalert($request->mobile, $message); 

         }
        else if($request->resettype==2)
        {

             $body='<p>Your Reset password is  '.$passwordnew. '</p> <hr>';
             

            $details = [
                'title' => 'State Portal',
                'body' => $body
            ];

           \Mail::to($toemail)->send(new \App\Mail\MyTestMail($details));
        }
        else
        {
            

             $message = 'Your Reset password is  '.$passwordnew. '.';
           $send = $this->sendalert($request->mobile, $message); 

            $body='<p>Your Reset password is  '.$passwordnew. '</p> <hr>';
             

            $details = [
                'title' => 'State Portal',
                'body' => $body
            ];

           \Mail::to($toemail)->send(new \App\Mail\MyTestMail($details));


        }*/
                return redirect()->route('admin.resetpasswordview')->with('success','Password reset successfully');
            }
            else
            {
                 return redirect()->route('admin.resetpasswordview')->with('errors','!! Failed to reset the password !!');
            }



    }
/*Reset password end*/

     /*       controller close     */
}
