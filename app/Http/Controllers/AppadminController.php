<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use App\Department;
use App\Hierarchy;
use App\Staffcategory;
use App\Office;
use App\Membershiprequest;
use App\Staff;
use App\Committee;
use App\Staffcommittee;
use App\Communication;
use App\Communicationattachment;
use DB;
use Auth;
use Carbon\Carbon;
use File;
use Mail;

class AppadminController extends Controller
{
     public function appadminhome(Request $request)
    {
    	return view('appadmindashboard');
    }

    // Designation(start) //
	
	
	public function designationlist(Request $request)
    {
           $listdata = DB::table('designations')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('appadmin.designationlist',compact('listdata'));
    }

    public function designationstore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Designation::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Designation([
	                'entitle'        =>  $request->name,
	                'maltitle'        =>  $request->malname,
	                'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a Designation with same name exists.']);
	        }    
        }
        
    }

    public function designationedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Designation::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function designationupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Designation::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name,
	                'maltitle'   =>  $request->malname,
	                'users_id'   =>  Auth::user()->id
	            );
	            Designation::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a Designation with same name exists.']);
	        }    
        }
        
    }

    public function designationdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Designation::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function designationstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('designations')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('designations')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('designations')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Designation(end) //

	// Department(start) //
	
	
	public function departmentlist(Request $request)
    {
           $listdata = DB::table('departments')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('appadmin.departmentlist',compact('listdata'));
    }

    public function departmentcreate(Request $request)
    {
        if($request->ajax())
        {
            $deptcategory     = DB::table('deptcategories')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['deptcategory' => $deptcategory]);
        }
    }

    public function departmentstore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Department::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Department([
	                'deptcategories_id'        =>  $request->deptcategories_id,
                    'entitle'        =>  $request->name,
	                'maltitle'        =>  $request->malname,
	                'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a Department with same name exists.']);
	        }    
        }
        
    }

    public function departmentedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Department::find($id);
            $deptcategory     = DB::table('deptcategories')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'deptcategory' => $deptcategory]);
        }

    }

    public function departmentupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Department::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'deptcategories_id'    =>  $request->deptcategories_id,
                    'entitle'    =>  $request->name,
	                'maltitle'   =>  $request->malname,
	                'users_id'   =>  Auth::user()->id
	            );
	            Department::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a Department with same name exists.']);
	        }    
        }
        
    }

    public function departmentdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Department::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function departmentstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('departments')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('departments')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('departments')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Department(end) //

	// Hierarchy(start) //
	
	
	public function hierarchylist(Request $request)
    {
           $listdata = DB::table('hierarchies')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('appadmin.hierarchylist',compact('listdata'));
    }

    public function hierarchystore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Hierarchy::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Hierarchy([
	                'entitle'        =>  $request->name,
	                'maltitle'        =>  $request->malname,
	                'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a Hierarchy with same name exists.']);
	        }    
        }
        
    }

    public function hierarchyedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Hierarchy::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function hierarchyupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Hierarchy::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name,
	                'maltitle'   =>  $request->malname,
	                'users_id'   =>  Auth::user()->id
	            );
	            Hierarchy::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a Hierarchy with same name exists.']);
	        }    
        }
        
    }

    public function hierarchydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Hierarchy::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function hierarchystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('hierarchies')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('hierarchies')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('hierarchies')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Hierarchy(end) //


	// Staff Category(start) //
	
	
	public function staffcategorylist(Request $request)
    {
           $listdata = DB::table('staffcategories')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('appadmin.staffcategorylist',compact('listdata'));
    }

    public function staffcategorystore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Staffcategory::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Staffcategory([
	                'entitle'        =>  $request->name,
	                'maltitle'        =>  $request->malname,
	                'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a Staffcategory with same name exists.']);
	        }    
        }
        
    }

    public function staffcategoryedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Staffcategory::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function staffcategoryupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Staffcategory::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name,
	                'maltitle'   =>  $request->malname,
	                'users_id'   =>  Auth::user()->id
	            );
	            Staffcategory::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a Staffcategory with same name exists.']);
	        }    
        }
        
    }

    public function staffcategorydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Staffcategory::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function staffcategorystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('staffcategories')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('staffcategories')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('staffcategories')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Staff Category(end) //


	// Office(start) //
	
	
	public function officelist(Request $request)
    {
           $listdata = DB::table('offices')
            ->select('id','entitle','maltitle','enaddress','maladdress','phonenumbers','map','email','status')
            ->get();
        

        return view('appadmin.officelist',compact('listdata'));
    }

    public function officestore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'enaddress'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z.,()\/\s ]+$)/',
            'maladdress'=>'required|max:100|min:3',
            'phonenumbers'=>'required|max:50|min:3|regex:/(^[0-9,\s ]+$)/',
            'email'=>'required|min:10|max:40|email',
            'map'=>'required|max:250|min:3|regex:/(^[0-9A-Za-z:.?=!%\/ ]+$)/'

        ]);

        
            $chkrows= Office::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
		        $imageName = 'office'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Office'), $imageName);
		        $resultsave = new Office([
		            'file'           =>  $imageName,
		            'alt'        	 =>  $request->alttext,
		            'entitle'        =>  $request->name,
	                'maltitle'       =>  $request->malname,
	                'enaddress'      =>  $request->enaddress,
	                'maladdress'     =>  $request->maladdress,
	                'phonenumbers'   =>  $request->phonenumbers,
	                'map'            =>  $request->map,
	                'email'          =>  $request->email,
	                'users_id'		 => Auth::user()->id
		        ]);
	            
	            $resultsave->save();
	            return redirect('appadmin/officelist')->with('success', 'Office Added!');
	        } else {
	        	return redirect('appadmin/officelist')->with('errors', 'Already a Office with same name exists.');
	        }    
        
    }

    public function officeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Office::find($id);

            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function officeupdate(Request $request)
    {
		$request->validate([
            'name1'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname1'	=>'required|min:3|max:50',
           	'alttext1'	=>'required|min:3|max:20',
            'enaddress1'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z.,()\/\s ]+$)/',
            'maladdress1'=>'required|max:100|min:3',
            'phonenumbers1'=>'required|max:50|min:3|regex:/(^[0-9,\s ]+$)/',
            'email1'=>'required|min:10|max:40|email',
            'map1'=>'required|max:250|min:3|regex:/(^[0-9A-Za-z:.?=!%\/ ]+$)/'
        ]);
        
            $chkrows= Office::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
			        $imageName1 = 'office'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Office'), $imageName1);
		            
		            $form_data = array(
		                'file'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->name1,
		                'maltitle'       =>  $request->malname1,
		                'enaddress'      =>  $request->enaddress1,
		                'maladdress'     =>  $request->maladdress1,
		                'phonenumbers'   =>  $request->phonenumbers1,
		                'map'            =>  $request->map1,
		                'email'          =>  $request->email1,
		                'users_id'		 => Auth::user()->id
		            );
		        } else {
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->name1,
		                'maltitle'       =>  $request->malname1,
		                'enaddress'      =>  $request->enaddress1,
		                'maladdress'     =>  $request->maladdress1,
		                'phonenumbers'   =>  $request->phonenumbers1,
		                'map'            =>  $request->map1,
		                'email'          =>  $request->email1,
		                'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Office::whereId($request->hidden_id1)->update($form_data);
	            return redirect('appadmin/officelist')->with('success', 'Office Updated!');
	        } else {
	        	return redirect('appadmin/officelist')->with('errors', 'Already a Office with same name exists.');
	        }    
        
        
    }

    public function officedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Office::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function officestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('offices')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('offices')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('offices')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Office(end) //

	// Membership Request(start) //
	
	
	public function membershiprequestlist(Request $request)
    {
           $listdata = DB::table('membershiprequests')
           ->join('offices','membershiprequests.offices_id','offices.id')
           ->join('departments','membershiprequests.departments_id','departments.id')
           ->join('designations','membershiprequests.designations_id','designations.id')
            ->select('membershiprequests.id','membershiprequests.name','offices.entitle as office','departments.entitle as department','designations.entitle as designation','membershiprequests.mobile','membershiprequests.email','membershiprequests.status')
            ->get();
        

        return view('appadmin.membershiprequestlist',compact('listdata'));
    }

    public function membershiprequestcreate(Request $request)
    {
        if($request->ajax())
        {
            $office 		= DB::table('offices')->where('status',1)->orderBy('id','asc')->get();
            $designation 	= DB::table('designations')->where('status',1)->orderBy('id','asc')->get();
            $department 	= DB::table('departments')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['office' => $office, 'designation' => $designation, 'department' => $department]);
        }
    }

    public function membershiprequeststore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'mobile'	=>'required|digits_between:10,12',
            'email'	=>'required|min:10|max:40|email',
            'offices_id'	=>'required',
            'departments_id'	=>'required',
            'designations_id'	=>'required'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Membershiprequest::where('name',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
	            $resultsave = new Membershiprequest([
	            	'name'	=> $request->name,
		            'mobile'	=> $request->mobile,
		            'email'	=> $request->email,
		            'offices_id'	=> $request->offices_id,
		            'departments_id'	=> $request->departments_id,
		            'designations_id'	=> $request->designations_id,
					'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        /*} else {
	        	return response()->json(['errors' => 'Already a Membership Request with same name exists.']);
	        }  */  
        }
        
    }

    public function membershiprequestedit(Request $request, $id)
    {
        if($request->ajax())
        {
        	$office 		= DB::table('offices')->where('status',1)->orderBy('id','asc')->get();
            $designation 	= DB::table('designations')->where('status',1)->orderBy('id','asc')->get();
            $department 	= DB::table('departments')->where('status',1)->orderBy('id','asc')->get();
            $resultdata = Membershiprequest::find($id);
            return response()->json(['resultdata' => $resultdata, 'office' => $office, 'designation' => $designation, 'department' => $department]);
        }

    }

    public function membershiprequestupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'mobile'	=>'required|digits_between:10,12',
            'email'	=>'required|min:10|max:40|email',
            'offices_id'	=>'required',
            'departments_id'	=>'required',
            'designations_id'	=>'required'
        ]);
        if($request->ajax())
        {
            /*$chkrows= Membershiprequest::where('name',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){*/
	            $form_data = array(
	                'name'	=> $request->name,
		            'mobile'	=> $request->mobile,
		            'email'	=> $request->email,
		            'offices_id'	=> $request->offices_id,
		            'departments_id'	=> $request->departments_id,
		            'designations_id'	=> $request->designations_id,
					'users_id'		 => Auth::user()->id
	            );
	            Membershiprequest::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        /*} else {
	        	return response()->json(['errors' => 'Already a Staffcategory with same name exists.']);
	        } */   
        }
        
    }

    public function membershiprequestdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Membershiprequest::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function membershiprequeststatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('membershiprequests')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('membershiprequests')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('membershiprequests')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Membership Request(end) //

	// Staff(start) //
	
	
	public function stafflist(Request $request)
    {
           $listdata = DB::table('staff')
           ->join('offices','staff.offices_id','offices.id')
           ->join('departments','staff.departments_id','departments.id')
           ->join('designations','staff.designations_id','designations.id')
           ->join('staffcategories','staff.staffcategories_id','staffcategories.id')
           ->join('hierarchies','staff.hierarchies_id','hierarchies.id')
            ->select('staff.id','staff.name','staff.malname','offices.entitle as office','departments.entitle as department','designations.entitle as designation','staffcategories.entitle as staffcategory','hierarchies.entitle as hierarchy','staff.mobile','staff.email','staff.joindate','staff.poster','staff.alt','staff.status')
            ->get();
        

        return view('appadmin.stafflist',compact('listdata'));
    }

    public function staffcreate(Request $request)
    {
        if($request->ajax())
        {
            $office 		= DB::table('offices')->where('status',1)->orderBy('id','asc')->get();
            $designation 	= DB::table('designations')->where('status',1)->orderBy('id','asc')->get();
            $department 	= DB::table('departments')->where('status',1)->orderBy('id','asc')->get();
            $staffcategory 	= DB::table('staffcategories')->where('status',1)->orderBy('id','asc')->get();
            $hierarchy 	= DB::table('hierarchies')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['office' => $office, 'designation' => $designation, 'department' => $department, 'staffcategory' => $staffcategory, 'hierarchy' => $hierarchy]);
        }
    }

    public function staffstore(Request $request)
    { 
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50',
            'mobile'	=>'required|digits_between:10,12',
            'email'	=>'required|min:10|max:40|email',
            'offices_id'	=>'required',
            'departments_id'	=>'required',
            'designations_id'	=>'required',
            'staffcategories_id'	=>'required',
            'hierarchies_id'	=>'required',
            'joindate' =>'required',
            'poster' =>'required|mimes:jpg,jpeg,png|max:1100',
            'alttext' =>'required|min:3|max:20'     



        ]);

        

        	$joindate = Carbon::createFromFormat('d/m/Y', $request->joindate)->format('Y-m-d');
        	$date = date('dmYH:i:s');
	        $posterName = 'staff'.$date.'.'.$request->poster->extension();  
	        $request->poster->move(public_path('Staff'), $posterName);

            $resultsave = new Staff([
            	'name'	=> $request->name,
            	'malname'	=> $request->malname,
	            'mobile'	=> $request->mobile,
	            'email'	=> $request->email,
	            'offices_id'	=> $request->offices_id,
	            'departments_id'	=> $request->departments_id,
	            'designations_id'	=> $request->designations_id,
	            'staffcategories_id'	=> $request->staffcategories_id,
	            'hierarchies_id'	=> $request->hierarchies_id,
	            'joindate'	=> $joindate,
	            'poster'	=> $posterName,
	            'alt'	=> $request->alttext,
				'users_id'		 => Auth::user()->id
            ]); 
            $resultsave->save();
            
            if(Auth::user()->usertypes_id==2){
              return redirect('appadmin/stafflist')->with('success', 'Staff Added!');
            } else if(Auth::user()->usertypes_id==9){
                return redirect('appmanager/stafflist')->with('success', 'Staff Added!');
            }
	       
        
    }

    public function staffedit(Request $request, $id)
    {
        if($request->ajax())
        {
        	$office 		= DB::table('offices')->where('status',1)->orderBy('id','asc')->get();
            $designation 	= DB::table('designations')->where('status',1)->orderBy('id','asc')->get();
            $department 	= DB::table('departments')->where('status',1)->orderBy('id','asc')->get();
            $staffcategory 	= DB::table('staffcategories')->where('status',1)->orderBy('id','asc')->get();
            $hierarchy 	= DB::table('hierarchies')->where('status',1)->orderBy('id','asc')->get();
            $resultdata = Staff::find($id);
            return response()->json(['resultdata' => $resultdata, 'office' => $office, 'designation' => $designation, 'department' => $department, 'staffcategory' => $staffcategory, 'hierarchy' => $hierarchy]);
        }

    }

    public function staffupdate(Request $request)
    {
		$request->validate([
            'name1'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname1'	=>'required|min:3|max:50',
            'mobile1'	=>'required|digits_between:10,12',
            'email1'	=>'required|min:10|max:40|email',
            'offices_id1'	=>'required',
            'departments_id1'	=>'required',
            'designations_id1'	=>'required',
            'staffcategories_id1'	=>'required',
            'hierarchies_id1'	=>'required',
            'joindate1' =>'required',
            'alttext1' =>'required|min:3|max:20'
        ]);

		$joindate1 = Carbon::createFromFormat('d/m/Y', $request->joindate1)->format('Y-m-d'); 

        if(isset($request->poster1))
		{
        
        	
        	$date = date('dmYH:i:s');
	        $posterName1 = 'staff'.$date.'.'.$request->poster1->extension();  
	        $request->poster->move(public_path('Staff'), $posterName1);

            $form_data = array(
                'name'	=> $request->name1,
                'malname'	=> $request->malname1,
	            'mobile'	=> $request->mobile1,
	            'email'	=> $request->email1,
	            'offices_id'	=> $request->offices_id1,
	            'departments_id'	=> $request->departments_id1,
	            'designations_id'	=> $request->designations_id1,
	            'staffcategories_id'	=> $request->staffcategories_id1,
	            'hierarchies_id'	=> $request->hierarchies_id1,
	            'joindate'	=> $joindate1,
	            'poster'	=> $posterName1,
	            'alt'	=> $request->alttext1,
				'users_id'		 => Auth::user()->id
            );
            
        } else {

        	
        	$form_data = array(
                'name'	=> $request->name1,
                'malname'	=> $request->malname1,
	            'mobile'	=> $request->mobile1,
	            'email'	=> $request->email1,
	            'offices_id'	=> $request->offices_id1,
	            'departments_id'	=> $request->departments_id1,
	            'designations_id'	=> $request->designations_id1,
	            'staffcategories_id'	=> $request->staffcategories_id1,
	            'hierarchies_id'	=> $request->hierarchies_id1,
	            'joindate'	=> $joindate1,
	            'alt'	=> $request->alttext1,
				'users_id'		 => Auth::user()->id
            );

        }

        Staff::whereId($request->hidden_id1)->update($form_data);
        
        if(Auth::user()->usertypes_id==2){
           return redirect('appadmin/stafflist')->with('success', 'Staff Updated!');
        } else if(Auth::user()->usertypes_id==9){
            return redirect('appmanager/stafflist')->with('success', 'Staff Updated!');
        }
	        
        
    }

    public function staffdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Staff::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function staffstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('staff')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('staff')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('staff')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Staff(end) //

	// Committee(start) //
	
	
	public function committeelist(Request $request)
    {
           $listdata = DB::table('committees')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('appadmin.committeelist',compact('listdata'));
    }

    public function committeestore(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Committee::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
	            $resultsave = new Committee([
	                'entitle'        =>  $request->name,
	                'maltitle'        =>  $request->malname,
	                'users_id'		 => Auth::user()->id
	            ]); 
	            $resultsave->save();
	            return response()->json(['success' => 'Data Added successfully.']);
	        } else {
	        	return response()->json(['errors' => 'Already a Committee with same name exists.']);
	        }    
        }
        
    }

    public function committeeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Committee::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function committeeupdate(Request $request)
    {
		$request->validate([
            'name'	=>'required|min:3|max:20|regex:/^[\pL\s]+$/u',
            'malname'	=>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Committee::where('entitle',$request->name)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
	            $form_data = array(
	                'entitle'    =>  $request->name,
	                'maltitle'   =>  $request->malname,
	                'users_id'   =>  Auth::user()->id
	            );
	            Committee::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Data is successfully updated']);
	        } else {
	        	return response()->json(['errors' => 'Already a Committee with same name exists.']);
	        }    
        }
        
    }

    public function committeedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Committee::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function committeestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('committees')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('committees')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('committees')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Committee(end) //

	// Staff Committee(start) //
	
	
	public function staffcommitteelist(Request $request)
    {
           $listdata = DB::table('staffcommittees')
            ->join('staff','staff.id','staffcommittees.staffs_id')
            ->join('committees','committees.id','staffcommittees.committees_id')
            ->join('hierarchies','hierarchies.id','staffcommittees.hierarchies_id')
            ->select('staffcommittees.id','staff.name as staff','committees.entitle as committee','hierarchies.entitle as hierarchy','staffcommittees.status')
            ->get();
        

        return view('appadmin.staffcommitteelist',compact('listdata'));
    }

    public function staffcommitteecreate(Request $request)
    {
       
            $hierarchy 	= DB::table('hierarchies')->where('status',1)->orderBy('id','asc')->get();
            $committee 	= DB::table('committees')->where('status',1)->orderBy('id','asc')->get();
            $staff 	= DB::table('staff')->where('status',1)->orderBy('id','asc')->get();
            
            
            
        return view('appadmin.staffcommitteecreate',compact('hierarchy','committee','staff'));
            
        
    }

    public function staffcommitteestore(Request $request)
    { 
		$request->validate([
            'committees_id'	=>'required',
            'staff'	=>'required',
            'hierarchies_id'	=>'required'


        ]);

		foreach($request->staff as $staffid)
        
		{
            $resultsave = new Staffcommittee([
            	
	            'committees_id'	=> $request->committees_id,
	            'hierarchies_id'	=> $request->hierarchies_id,
	            'staffs_id'	=> $staffid,
				'users_id'		 => Auth::user()->id
            ]); 
            $resultsave->save();

        }
        
        
         if(Auth::user()->usertypes_id==2){
           return redirect('appadmin/staffcommitteelist')->with('success', 'Staff Committee Added!');
        } else if(Auth::user()->usertypes_id==9){
            return redirect('appmanager/staffcommitteelist')->with('success', 'Staff Committee Added!');
        }
	       
        
    }

    public function staffcommitteedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Staffcommittee::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function staffcommitteestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('staffcommittees')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('staffcommittees')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('staffcommittees')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }

    // Staff Committee(end) //

    // Communication(start) //
	
	
	public function communicationlist(Request $request)
    {
		$uid=Auth::user()->id;
           $listdata = DB::table('communications')
            ->join('communicationtypes','communicationtypes.id','communications.communicationtypes_id')
            ->select('communications.id','communications.subject','communications.content','communications.communicationto','communicationtypes.entitle','communications.status','communications.created_at')
			->where('communications.users_id',$uid)
            ->get();
        

        return view('appadmin.communicationlist',compact('listdata'));
    }

    public function communicationcreate(Request $request)
    {
       
           $committee  = DB::table('committees')->where('status',1)->orderBy('id','asc')->get();
           $commtypes  = DB::table('communicationtypes')->where('status',1)->orderBy('id','asc')->get();
            
           return view('appadmin.communicationcreate',compact('committee','commtypes'));
        
    }

    public function storecommunicationimg(Request $request)
    {    
        $path = public_path('Communication/temp');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
       
    }

     public function communicationstore(Request $request)
    { 
        $request->validate([
            'communicationtypes_id' =>'required',
            'communicationto' =>'required',
            'subject'    =>'required',
            'content'    =>'required'


        ]);

        $communicationtypes_id      = $request->communicationtypes_id;
        $communicationto  = $request->communicationto;
        $subject  = $request->subject;
        $content  = $request->content;
        

        /*$chk_rows= DB::table('galleries')->where('albumname',$album)->where('gallerytypes_id',$albumtype)->exists() ? 1 : 0;
        if($chk_rows==0){*/
        if($communicationtypes_id==2)  {  
            $form_data = array(
            'communicationtypes_id'         => $communicationtypes_id,
            'communicationto'   => $communicationto,
            'subject'            =>  $subject,
            'content'            =>  $content,
            'users_id'            =>  Auth::user()->id
              );
            $insertid =  Communication::create($form_data);

            
            if($insertid){
                $frompath   = public_path('Communication/temp');
                $topath     = public_path('Communication');

                if (!file_exists($topath)) {
                    mkdir($topath, 0777, true);
                }
                
                $files = File::files($frompath);
                $filecnt = count($files);

                for($i=0;$i<$filecnt;$i++){ 
                    $file = basename($files[$i]);
                    File::move($frompath.'/'.$file, $topath.'/'.$file);

                    $form_data1 = array(
                    'communications_id'      => $insertid->id,
                    'file'          => $file,
                    'users_id'            =>  Auth::user()->id
                    );

                    Communicationattachment::create($form_data1);



                }
               
                 if(Auth::user()->usertypes_id==2){
                   return redirect('appadmin/communicationlist')->with('success', 'Communication Sent!');
                } else if(Auth::user()->usertypes_id==9){
                    return redirect('appmanager/communicationlist')->with('success', 'Communication Sent!');
                } else if(Auth::user()->usertypes_id==10){
                    return redirect('appclient/communicationlist')->with('success', 'Communication Sent!');
                }
                //return redirect('appadmin/communicationlist')->with('success', 'Communication Sent!');
                /*$toemail = 'deepthi.nh@gmail.com';

   

                $details = [
                'title' => 'JanaJagratha Portal Email Id confirmation',
                'body' => 'sfg'
                ];

                \Mail::to($toemail)->send(new \App\Mail\SentMail($details));

          

            

           

                dd("Mail Send Successfully");*/

            } 

        } else{
            $form_data = array(
            'communicationtypes_id'         => $communicationtypes_id,
            'communicationto'   => $communicationto,
            'subject'            =>  $subject,
            'content'            =>  $content,
            'users_id'            =>  Auth::user()->id
              );
            $insertid =  Communication::create($form_data);

            
            if(Auth::user()->usertypes_id==2){
                   return redirect('appadmin/communicationlist')->with('success', 'Communication Sent!');
                } else if(Auth::user()->usertypes_id==9){
                    return redirect('appmanager/communicationlist')->with('success', 'Communication Sent!');
                } else if(Auth::user()->usertypes_id==10){
                    return redirect('appclient/communicationlist')->with('success', 'Communication Sent!');
                }

        }  
        
        /*} else {
            return redirect('appadmin/communicationlist')->with('error', 'Gallery with same album name or album type already exists!');
        }*/
           
        
    }

     public function communicationdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Communication::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function communicationstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('communications')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('communications')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('communications')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }


}
