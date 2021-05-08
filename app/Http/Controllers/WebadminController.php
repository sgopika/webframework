<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Promocampaign;
use App\Download;
use App\Gallery;
use App\Galleryitem;
use App\Newsletter;
use App\Newslettervolume;
use App\Article;
use App\Articleupload;
use App\Activity;
use App\Activityupload;
use App\Livestreaming;
use App\Appdepartment;
use App\Appsection;
use App\Widgetlink;

use DB;
use Auth;
use Carbon\Carbon;

class WebadminController extends Controller
{
    public function webadminhome(Request $request)
    {
    	return view('webadmindashboard');
    }
	

	// Banner(start) //
		
	public function bannerlist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('banners')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('webadmin.bannerlist',compact('listdata'));
    }

    public function bannerstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3'

        ]);

        
            $chkrows= Banner::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
		        $imageName = 'banner'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Banner'), $imageName);
		        $resultsave = new Banner([
		            'file'           =>  $imageName,
		            'alt'        	 =>  $request->alttext,
		            'entitle'        =>  $request->entitle,
	                'maltitle'       =>  $request->maltitle,
	                'ensubtitle'      =>  $request->ensubtitle,
	                'malsubtitle'     =>  $request->malsubtitle,
	                'users_id'		 => Auth::user()->id
		        ]);
	            
	            $resultsave->save();
	            return redirect('webadmin/bannerlist')->with('success', 'Banner Added!');
	        } else {
	        	return redirect('webadmin/bannerlist')->with('errors', 'Already a Banner with same name exists.');
	        }    
        
    }

    public function banneredit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Banner::find($id);

            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function bannerupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'ensubtitle1'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle1'=>'required|max:100|min:3'
		
        ]);
        
            $chkrows= Banner::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
			        $imageName1 = 'banner'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Banner'), $imageName1);
		            
		            $form_data = array(
		                'file'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
						'entitle'        =>  $request->entitle1,
						'maltitle'       =>  $request->maltitle1,
						'ensubtitle'      =>  $request->ensubtitle1,
						'malsubtitle'     =>  $request->malsubtitle1,
						'users_id'		 => Auth::user()->id
		            );
		        } else {
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
						'entitle'        =>  $request->entitle1,
						'maltitle'       =>  $request->maltitle1,
						'ensubtitle'      =>  $request->ensubtitle1,
						'malsubtitle'     =>  $request->malsubtitle1,
						'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Banner::whereId($request->hidden_id1)->update($form_data);
	            return redirect('webadmin/bannerlist')->with('success', 'Banner Updated!');
	        } else {
	        	return redirect('webadmin/bannerlist')->with('errors', 'Already a Banner with same name exists.');
	        }    
        
        
    }

    public function bannerdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Banner::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function bannerstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('banners')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('banners')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('banners')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Banner(end) //

	// Promo Campaign(start) //
		
	public function promocampaignlist(Request $request)
    {
           $listdata = DB::table('promocampaigns')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->get();
        

        return view('webadmin.promocampaignlist',compact('listdata'));
    }

    public function promofiletypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }

    public function promocampaigncreate(Request $request)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['filetype' => $filetype, 'contenttype' => $contenttype]);
        }
    }

    public function promocampaignstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'endesc'=>'required|max:250|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maldesc'=>'required|max:250|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'icon'=>'required|max:150|min:2'


        ]);

        
            $chkrows= Promocampaign::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$getfiletype = DB::table('filetypes')->where('id',$request->filetypes_id)->first();
            	$ftype = $getfiletype->entitle;
            	if($ftype==$request->image->extension())
            	{	
            		if(isset($request->displaystatus)){
            			$dplystat = 1;
            		} else {
            			$dplystat = 0;
            		}

			        $imageName = 'promocampaign'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Promocampaign'), $imageName);
			        $resultsave = new Promocampaign([
			            'file'           =>  $imageName,
			            'alt'        	 =>  $request->alttext,
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'ensubtitle'     =>  $request->ensubtitle,
		                'malsubtitle'    =>  $request->malsubtitle,
		                'endesc'         =>  $request->endesc,
		                'maldesc'     	 =>  $request->maldesc,
		                'encontent'      =>  $request->encontent,
		                'malcontent'     =>  $request->malcontent,
		                'size'     	     =>  $request->size,
		                'duration'     	 =>  $request->duration,
		                'filetypes_id'   =>  $request->filetypes_id,
		                'contenttypes_id'=>  $request->contenttypes_id,
		                'icon'			 =>  $request->icon,
		                'displaystatus'  =>  $dplystat,
		                'users_id'		 => Auth::user()->id
			        ]);
		            
		            $resultsave->save();
		            return redirect('webadmin/promocampaignlist')->with('success', 'Promocampaign Added!');
		        } else {
		        	return redirect('webadmin/promocampaignlist')->with('errors', 'Uploaded File does not match with filetype selected');
		        }
	        } else {
	        	return redirect('webadmin/promocampaignlist')->with('errors', 'Already a Promocampaign with same name exists.');
	        }    
        
    }

    public function promocampaignedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Promocampaign::find($id);
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'filetype' => $filetype,'contenttype' => $contenttype]);
        }

    }

    public function promocampaignupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'ensubtitle1'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle1'=>'required|max:100|min:3',
            'endesc1'=>'required|max:250|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maldesc1'=>'required|max:250|min:3',
            'encontent1'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent1'=>'required|max:1000|min:3',
            'size1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id1'=>'required',
            'contenttypes_id1'=>'required',
            'icon1'=>'required|max:150|min:2'
		
        ]);
        
            $chkrows= Promocampaign::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            $getfiletype = DB::table('filettypes')->where('id',$request->filetypes_id)->first();
	            	$ftype = $getfiletype->entitle;
	            	if($ftype==$request->imageedit->extension())
	            	{
	            		if(isset($request->displaystatus1)){
	            			$dplystat1 = 1;
	            		} else {
	            			$dplystat1 = 0;
	            		}
				        $imageName1 = 'promocampaign'.$date.'.'.$request->imageedit->extension();  
				        $request->imageedit->move(public_path('Promocampaign'), $imageName1);
			            
			            $form_data = array(
			                'file'           =>  $imageName1,
				            'alt'        	 =>  $request->alttext1,
							'entitle'        =>  $request->entitle1,
							'maltitle'       =>  $request->maltitle1,
							'ensubtitle'     =>  $request->ensubtitle1,
							'malsubtitle'    =>  $request->malsubtitle1,
							'endesc'         =>  $request->endesc1,
			                'maldesc'     	 =>  $request->maldesc1,
			                'encontent'      =>  $request->encontent1,
			                'malcontent'     =>  $request->malcontent1,
			                'size'     	     =>  $request->size1,
			                'duration'     	 =>  $request->duration1,
			                'filetypes_id'   =>  $request->filetypes_id1,
			                'contenttypes_id'=>  $request->contenttypes_id1,
			                'icon'			 =>  $request->icon1,
							'displaystatus'	 =>  $dplystat1,
							'users_id'		 => Auth::user()->id
			            );
			        } else {
		        	return redirect('webadmin/promocampaignlist')->with('errors', 'Uploaded File does not match with filetype selected');
		        	}   
		        } else {

		        	if(isset($request->displaystatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
						'entitle'        =>  $request->entitle1,
						'maltitle'       =>  $request->maltitle1,
						'ensubtitle'     =>  $request->ensubtitle1,
						'malsubtitle'    =>  $request->malsubtitle1,
						'endesc'         =>  $request->endesc1,
		                'maldesc'     	 =>  $request->maldesc1,
		                'encontent'      =>  $request->encontent1,
		                'malcontent'     =>  $request->malcontent1,
		                'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'icon'			 =>  $request->icon1,
						'displaystatus'	 =>  $dplystat1,
						'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Promocampaign::whereId($request->hidden_id1)->update($form_data);
	            return redirect('webadmin/promocampaignlist')->with('success', 'Promocampaign Updated!');
	        } else {
	        	return redirect('webadmin/promocampaignlist')->with('errors', 'Already a Promocampaign with same name exists.');
	        }    
        
        
    }

    public function promocampaigndestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Promocampaign::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function promocampaignstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('promocampaigns')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('promocampaigns')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('promocampaigns')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Promo Campaign(end) //

	// Download(start) //
		
	public function downloadlist(Request $request)
    {
		$uid = Auth::user()->id;
           $listdata = DB::table('downloads')
            ->select('id','entitle','maltitle','status','contributor_status','moderator_remarks','approve_remarks')
			->where('users_id', $uid)
            ->get();
        

        return view('webadmin.downloadlist',compact('listdata'));
    }

    public function downloadfiletypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }

    public function downloadcreate(Request $request)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $downloadtype 	= DB::table('downloadtypes')->where('status',1)->orderBy('id','asc')->get();
            $archivepolicy 	= DB::table('archivepolicies')->where('status',1)->orderBy('id','asc')->get();
			//dd($downloadtype);
            return response()->json(['filetype' => $filetype, 'contenttype' => $contenttype, 'downloadtype' => $downloadtype,'archivepolicy' => $archivepolicy]);
        }
    }

    public function downloadstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'downloadtypes_id'=>'required',
            'archivepolicies_id'=>'required',
            'icon'=>'required|max:150|min:2'


        ]);

        
            $chkrows= Download::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$getfiletype = DB::table('filetypes')->where('id',$request->filetypes_id)->first();
            	$ftype = $getfiletype->entitle;
            	if($ftype==$request->image->extension())
            	{	
            		if(isset($request->displaystatus)){
            			$dplystat = 1;
            		} else {
            			$dplystat = 0;
            		}

			        $imageName = 'download'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Download'), $imageName);
			        $resultsave = new Download([
			            'file'           =>  $imageName,
			            'alt'        	 =>  $request->alttext,
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'size'     	     =>  $request->size,
		                'duration'     	 =>  $request->duration,
		                'filetypes_id'   =>  $request->filetypes_id,
		                'contenttypes_id'=>  $request->contenttypes_id,
		                'downloadtypes_id'=>  $request->downloadtypes_id,
		                'archivepolicies_id'=>  $request->archivepolicies_id,
		                'icon'			 =>  $request->icon,
		                'displaystatus'  =>  $dplystat,
		                'users_id'		 => Auth::user()->id
			        ]);
		            
		            $resultsave->save();
					if(Auth::user()->usertypes_id==4){
		            	return redirect('webadmin/downloadlist')->with('success', 'Download Added!');
					} else if(Auth::user()->usertypes_id==5){
						return redirect('editor/downloadlist')->with('success', 'Download Added!');
					} else if(Auth::user()->usertypes_id==6){
                        return redirect('photoeditor/downloadlist')->with('success', 'Download Added!');
                    }
                    
		        } else {
					if(Auth::user()->usertypes_id==4){
		        		return redirect('webadmin/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==5){
						return redirect('editor/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==6){
                        return redirect('photoeditor/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } 
		        }
	        } else {
				if(Auth::user()->usertypes_id==4){
	        		return redirect('webadmin/downloadlist')->with('errors', 'Already a Download with same name exists.');
				} else if(Auth::user()->usertypes_id==5){
						return redirect('editor/downloadlist')->with('errors', 'Already a Download with same name exists.');
				} else if(Auth::user()->usertypes_id==6){
                        return redirect('photoeditor/downloadlist')->with('errors', 'Already a Download with same name exists.');
                } 
	        }    
        
    }

    public function downloadedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Download::find($id);
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $downloadtype 	= DB::table('downloadtypes')->where('status',1)->orderBy('id','asc')->get();
            $archivepolicy 	= DB::table('archivepolicies')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'filetype' => $filetype,'contenttype' => $contenttype,'downloadtype' => $downloadtype, 'archivepolicy' => $archivepolicy]);
        }

    }

    public function downloadupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'size1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id1'=>'required',
            'contenttypes_id1'=>'required',
            'downloadtypes_id1'=>'required',
            'archivepolicies_id1'=>'required',
            'icon1'=>'required|max:150|min:2'
		
        ]);
        
            $chkrows= Download::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            $getfiletype = DB::table('filettypes')->where('id',$request->filetypes_id)->first();
	            	$ftype = $getfiletype->entitle;
	            	if($ftype==$request->imageedit->extension())
	            	{
	            		if(isset($request->displaystatus1)){
	            			$dplystat1 = 1;
	            		} else {
	            			$dplystat1 = 0;
	            		}
				        $imageName1 = 'download'.$date.'.'.$request->imageedit->extension();  
				        $request->imageedit->move(public_path('Download'), $imageName1);
			            
			            $form_data = array(
			                'file'           =>  $imageName1,
				            'alt'        	 =>  $request->alttext1,
							'entitle'        =>  $request->entitle1,
							'maltitle'       =>  $request->maltitle1,
							'size'     	     =>  $request->size1,
			                'duration'     	 =>  $request->duration1,
			                'filetypes_id'   =>  $request->filetypes_id1,
			                'contenttypes_id'=>  $request->contenttypes_id1,
			                'downloadtypes_id'=>  $request->downloadtypes_id1,
			                'archivepolicies_id'=>  $request->archivepolicies_id1,
			                'icon'			 =>  $request->icon1,
							'displaystatus'	 =>  $dplystat1,
							'users_id'		 => Auth::user()->id
			            );
			        } else {
						if(Auth::user()->usertypes_id==4){
						return redirect('webadmin/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
						} else if(Auth::user()->usertypes_id==5){
							return redirect('editor/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
						} else if(Auth::user()->usertypes_id==6){
                            return redirect('photoeditor/downloadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                        } 
		        	}   
		        } else {

		        	if(isset($request->displaystatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
						'entitle'        =>  $request->entitle1,
						'maltitle'       =>  $request->maltitle1,
						'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'downloadtypes_id'=>  $request->downloadtypes_id1,
			            'archivepolicies_id'=>  $request->archivepolicies_id1,
		                'icon'			 =>  $request->icon1,
						'displaystatus'	 =>  $dplystat1,
						'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Download::whereId($request->hidden_id1)->update($form_data);
				if(Auth::user()->usertypes_id==4){
	            return redirect('webadmin/downloadlist')->with('success', 'Download Updated!');
				} else if(Auth::user()->usertypes_id==5){
				return redirect('editor/downloadlist')->with('success', 'Download Updated!');
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/downloadlist')->with('success', 'Download Updated!');
                } 
	        } else {
				if(Auth::user()->usertypes_id==4){
	        	return redirect('webadmin/downloadlist')->with('errors', 'Already a Download with same name exists.');
				} else if(Auth::user()->usertypes_id==5){
				return redirect('editor/downloadlist')->with('errors', 'Already a Download with same name exists.');
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/downloadlist')->with('errors', 'Already a Download with same name exists.');
                } 
	        }    
        
        
    }

    public function downloaddestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Download::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function downloadstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('downloads')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('downloads')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('downloads')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Download(end) //

    // Gallery(start) //
		
	public function gallerylist(Request $request)
    {
			$uid = Auth::user()->id;
           $listdata = DB::table('galleries')
            ->select('id','entitle','maltitle','status','contributor_status','moderator_remarks','approve_remarks')
			->where('users_id',$uid)
            ->get();
        

        return view('webadmin.gallerylist',compact('listdata'));
    }

    public function gallerycreate(Request $request)
    {
        if($request->ajax())
        {
            $activity 		= DB::table('activities')->where('status',1)->orderBy('id','asc')->get();//dd($activity);
            return response()->json(['activity' => $activity]);
        }
    }

    public function gallerystore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'entooltip'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'maltooltip'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'gallerydate'=>'required',
            'activities_id'=>'required'


        ]);

        
            $chkrows= Gallery::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$gallerydate = Carbon::createFromFormat('d/m/Y', $request->gallerydate)->format('Y-m-d');	
            	$imageName = 'gallery'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Gallery'), $imageName);
                if(Auth::user()->usertypes_id==4){
    		        $resultsave = new Gallery([
    		            'poster'           =>  $imageName,
    		            'alt'        	 =>  $request->alttext,
    		            'entitle'        =>  $request->entitle,
    	                'maltitle'       =>  $request->maltitle,
    	                'entooltip'        =>  $request->entooltip,
    	                'maltooltip'       =>  $request->maltooltip,
    	                'activities_id'=>  $request->activities_id,
    	                'date'	=> $gallerydate,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                'users_id'		 => Auth::user()->id
    		        ]);
                } else if(Auth::user()->usertypes_id==3){
                    $resultsave = new Gallery([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'activities_id'=>  $request->activities_id,
                        'date'  => $gallerydate,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==5){
                    $resultsave = new Gallery([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'activities_id'=>  $request->activities_id,
                        'date'  => $gallerydate,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==6){
                    $resultsave = new Gallery([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'activities_id'=>  $request->activities_id,
                        'date'  => $gallerydate,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                }
	            
	            $resultsave->save();
				if(Auth::user()->usertypes_id==4){
	            return redirect('webadmin/gallerylist')->with('success', 'Gallery Added!');
				} else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/gallerylist')->with('success', 'Gallery Added!');
                } else if(Auth::user()->usertypes_id==5){
				return redirect('editor/gallerylist')->with('success', 'Gallery Added!');	
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/gallerylist')->with('success', 'Gallery Added!');   
                } 
		        
	        } else {
				if(Auth::user()->usertypes_id==4){
	        	return redirect('webadmin/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
				} else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
				return redirect('editor/gallerylist')->with('errors', 'Already a Gallery with same name exists.');	
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/gallerylist')->with('errors', 'Already a Gallery with same name exists.');  
                }
	        }    
        
    }

    public function galleryedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Gallery::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                $activity   = DB::table('activities')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'activity' => $activity]);
            
            } else {
                return response()->json(['error' => 'The Current Gallery is Locked, so cannot be edited.']);
            }
        }

    }

    public function galleryupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'entooltip1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'maltooltip1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'gallerydate1'=>'required',
            'activities_id1'=>'required'
		
        ]);
        
            $chkrows= Gallery::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
				$gallerydate1 = Carbon::createFromFormat('d/m/Y', $request->gallerydate1)->format('Y-m-d');	

				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
			        $imageName1 = 'gallery'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Gallery'), $imageName1);
		            if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'poster'           =>  $imageName1,
    			            'alt'        	 =>  $request->alttext1,
    						'entitle'        =>  $request->entitle1,
    						'maltitle'       =>  $request->maltitle1,
    						'entooltip'        =>  $request->entooltip1,
    						'maltooltip'       =>  $request->maltooltip1,
    						'activities_id'=>  $request->activities_id1,
    	                	'date'	=> $gallerydate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }
			         
		        } else {

		        	if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'alt'        	 =>  $request->alttext1,
    						'entitle'        =>  $request->entitle1,
    						'maltitle'       =>  $request->maltitle1,
    						'entooltip'        =>  $request->entooltip1,
    						'maltooltip'       =>  $request->maltooltip1,
    						'activities_id'=>  $request->activities_id1,
    	                	'date'	=> $gallerydate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'activities_id'=>  $request->activities_id1,
                            'date'  => $gallerydate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }

		        }
	        dd($form_data);
	            Gallery::whereId($request->hidden_id1)->update($form_data);
				if(Auth::user()->usertypes_id==4){
	            return redirect('webadmin/gallerylist')->with('success', 'Gallery Updated!');
				} else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/gallerylist')->with('success', 'Gallery Updated!');
                } else if(Auth::user()->usertypes_id==5){
				return redirect('editor/gallerylist')->with('success', 'Gallery Updated!');
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/gallerylist')->with('success', 'Gallery Updated!');
                } 
	        } else {
				if(Auth::user()->usertypes_id==4){
	        	return redirect('webadmin/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
				} else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
				return redirect('editor/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
				} else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/gallerylist')->with('errors', 'Already a Gallery with same name exists.');
                } 
	        }    
        
        
    }

    public function gallerydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Gallery::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function gallerystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('galleries')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('galleries')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('galleries')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Gallery(end) //

	// Gallery Album(start) //
		
	public function galleryalbumlist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('galleryitems')
		    ->join('galleries','galleries.id','galleryitems.galleries_id')
            ->select('galleryitems.id','galleryitems.status','galleryitems.contributor_status','galleryitems.moderator_remarks','galleryitems.approve_remarks','galleries.entitle as gallery','galleryitems.poster')
            ->where('galleryitems.users_id',$uid)
            ->get();
        

        return view('webadmin.galleryalbumlist',compact('listdata'));
    }
	
	 public function galleryalbumcreate(Request $request)
    {
        if($request->ajax())
        {
            $gallery 	= DB::table('galleries')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['gallery' => $gallery]);
        }
    }

    public function galleryalbumstore(Request $request)
    {
		$request->validate([
            'galleries_id'	=>'required',
            'entooltip'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20'
            


        ]);

        
            /*$chkrows= Galleryitem::where('galleries_id',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){*/
            	$date = date('dmYH:i:s');
            	$imageName = 'galleryitem'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Galleryitem'), $imageName);
		        $resultsave = new Galleryitem([
		            'poster'           =>  $imageName,
		            'alt'        	 =>  $request->alttext,
		            'galleries_id'        =>  $request->galleries_id,
	                'entooltip'        =>  $request->entooltip,
	                'maltooltip'       =>  $request->maltooltip,
	                'users_id'		 => Auth::user()->id
		        ]);
	            
	            $resultsave->save();
	            
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/galleryalbumlist')->with('success', 'Gallery Album Added!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/galleryalbumlist')->with('success', 'Gallery Album Added!');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/galleryalbumlist')->with('success', 'Gallery Album Added!');
                } 
		        
	        /*} else {
	        	
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                }
	        }*/    
        
    }

    public function galleryalbumedit(Request $request, $id)
    {
        if($request->ajax())
        {
			$gallery 	= DB::table('galleries')->where('status',1)->orderBy('id','asc')->get();
            $resultdata = Galleryitem::find($id);
            return response()->json(['gallery'=>$gallery, 'resultdata' => $resultdata]);
        }

    }

    public function galleryalbumupdate(Request $request)
    {
		$request->validate([
			'galleries_id1'	=>'required',
            'entooltip1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20'
            
		
        ]);
        
            /*$chkrows= Galleryitem::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){*/


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            $imageName1 = 'galleryitem'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Galleryitem'), $imageName1);
		            
		            $form_data = array(
		                'poster'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
						'galleries_id'        =>  $request->galleries_id1,
						'entooltip'        =>  $request->entooltip1,
						'maltooltip'       =>  $request->maltooltip1,
						'users_id'		 => Auth::user()->id
		            );
			         
		        } else {

		        	
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
						'galleries_id'        =>  $request->galleries_id1,
						'entooltip'        =>  $request->entooltip1,
						'maltooltip'       =>  $request->maltooltip1,
						'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Galleryitem::whereId($request->hidden_id1)->update($form_data);
	            
	            if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/galleryalbumlist')->with('success', 'Gallery Album Updated!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/galleryalbumlist')->with('success', 'Gallery Album Updated!');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/galleryalbumlist')->with('success', 'Gallery Album Updated!');
                } 
	        /*} else {
	        	
	        	if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/galleryalbumlist')->with('errors', 'Already a Gallery Album with same name exists.');
                } 
	        	
	        }*/    
        
        
    }

    public function galleryalbumdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Galleryitem::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function galleryalbumstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('galleryitems')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('galleryitems')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
                 
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('galleryitems')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Gallery Album(end) //

	// Newsletter(start) //
		
	public function newsletterlist(Request $request)
    {
        $uid= Auth::user()->id;
           $listdata = DB::table('newsletters')
            ->select('id','entitle','maltitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('webadmin.newsletterlist',compact('listdata'));
    }

    public function newslettercreate(Request $request)
    {
        if($request->ajax())
        {
            $gallery 		= DB::table('galleries')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['gallery' => $gallery]);
        }
    }

    public function newsletterstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'entooltip'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'maltooltip'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20'


        ]);

        
            $chkrows= Newsletter::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$imageName = 'newsletter'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Newsletter'), $imageName);
                if(Auth::user()->usertypes_id==4){
    		        $resultsave = new Newsletter([
    		            'poster'           =>  $imageName,
    		            'alt'        	 =>  $request->alttext,
    		            'entitle'        =>  $request->entitle,
    	                'maltitle'       =>  $request->maltitle,
    	                'entooltip'        =>  $request->entooltip,
    	                'maltooltip'       =>  $request->maltooltip,
    	                'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                'users_id'		 => Auth::user()->id
    		        ]);
                } else if(Auth::user()->usertypes_id==3){
                    $resultsave = new Newsletter([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==5){
                    $resultsave = new Newsletter([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==6){
                    $resultsave = new Newsletter([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                }
	            
	            $resultsave->save();
	            
	            if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/newsletterlist')->with('success', 'Newsletter Added!');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/newsletterlist')->with('success', 'Newsletter Added!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/newsletterlist')->with('success', 'Newsletter Added!');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/newsletterlist')->with('success', 'Newsletter Added!');
                }
		        
	        } else {
	        	
	        	if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                }
	        }    
        
    }

    public function newsletteredit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Newsletter::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function newsletterupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'entooltip1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'maltooltip1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20'
		
        ]);
        
            $chkrows= Newsletter::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            $imageName1 = 'newsletter'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Newsletter'), $imageName1);
		            if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'poster'           =>  $imageName1,
    			            'alt'        	 =>  $request->alttext1,
    						'entitle'        =>  $request->entitle1,
    						'maltitle'       =>  $request->maltitle1,
    						'entooltip'        =>  $request->entooltip1,
    						'maltooltip'       =>  $request->maltooltip1,
    						'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                	'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }
			         
		        } else {

		        	if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'alt'        	 =>  $request->alttext1,
    						'entitle'        =>  $request->entitle1,
    						'maltitle'       =>  $request->maltitle1,
    						'entooltip'        =>  $request->entooltip1,
    						'maltooltip'       =>  $request->maltooltip1,
    						'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                	'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }

		        }
	        
	            Newsletter::whereId($request->hidden_id1)->update($form_data);
	            
	             if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/newsletterlist')->with('success', 'Newsletter Updated!');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/newsletterlist')->with('success', 'Newsletter Updated!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/newsletterlist')->with('success', 'Newsletter Updated!');
                } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/newsletterlist')->with('success', 'Newsletter Updated!');
                }
	        } else {
	        	
	        	 if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==3){
               return redirect('siteadmin/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
               return redirect('editor/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                } else if(Auth::user()->usertypes_id==6){
               return redirect('photoeditor/newsletterlist')->with('errors', 'Already a Newsletter with same name exists.');
                }
	        }    
        
        
    }

    public function newsletterdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Newsletter::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function newsletterstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('newsletters')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('newsletters')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('newsletters')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Newsletter(end) //

	// Newsletter Volume(start) //
		
	public function newslettervolumelist(Request $request)
    {   $uid=Auth::user()->id;
           $listdata = DB::table('newslettervolumes')
            ->select('id','entitle','maltitle','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('webadmin.newslettervolumelist',compact('listdata'));
    }

    public function newslettervolumefiletypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }

    public function newslettervolumecreate(Request $request)
    {
        if($request->ajax())
        {
			$newsletter 		= DB::table('newsletters')->where('status',1)->orderBy('id','asc')->get();
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $archivepolicy 	= DB::table('archivepolicies')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['newsletter'=>$newsletter,'filetype' => $filetype, 'contenttype' => $contenttype, 'archivepolicy' => $archivepolicy]);
        }
    }

    public function newslettervolumestore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'entooltip'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'archivepolicies_id'=>'required',
            'releasedate'=>'required',
			'newsletters_id'=>'required'


        ]);

        
            $chkrows= Newslettervolume::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$releasedate = Carbon::createFromFormat('d/m/Y', $request->releasedate)->format('Y-m-d');	
            	
            	$getfiletype = DB::table('filetypes')->where('id',$request->filetypes_id)->first();
            	$ftype = $getfiletype->entitle;
            	if($ftype==$request->image->extension())
            	{	
            		

			        $imageName = 'newslettervol'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Newslettervolume'), $imageName);
                    if(Auth::user()->usertypes_id==4){
    			        $resultsave = new Newslettervolume([
							'newsletters_id'  => $request->newsletters_id,
    			            'poster'           =>  $imageName,
    			            'alt'        	 =>  $request->alttext,
    			            'entitle'        =>  $request->entitle,
    		                'maltitle'       =>  $request->maltitle,
    		                'entooltip'        =>  $request->entooltip,
    		                'maltooltip'       =>  $request->maltooltip,
    		                'size'     	     =>  $request->size,
    		                'duration'     	 =>  $request->duration,
    		                'filetypes_id'   =>  $request->filetypes_id,
    		                'contenttypes_id'=>  $request->contenttypes_id,
    		                'archivepolicies_id'=>  $request->archivepolicies_id,
    		                'releasedate'=>  $releasedate,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    			        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Newslettervolume([
							'newsletters_id'  => $request->newsletters_id,
                            'poster'           =>  $imageName,
                            'alt'            =>  $request->alttext,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'entooltip'        =>  $request->entooltip,
                            'maltooltip'       =>  $request->maltooltip,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'archivepolicies_id'=>  $request->archivepolicies_id,
                            'releasedate'=>  $releasedate,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Newslettervolume([
							'newsletters_id'  => $request->newsletters_id,
                            'poster'           =>  $imageName,
                            'alt'            =>  $request->alttext,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'entooltip'        =>  $request->entooltip,
                            'maltooltip'       =>  $request->maltooltip,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'archivepolicies_id'=>  $request->archivepolicies_id,
                            'releasedate'=>  $releasedate,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==6){
                        $resultsave = new Newslettervolume([
							'newsletters_id'  => $request->newsletters_id,
                            'poster'           =>  $imageName,
                            'alt'            =>  $request->alttext,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'entooltip'        =>  $request->entooltip,
                            'maltooltip'       =>  $request->maltooltip,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'archivepolicies_id'=>  $request->archivepolicies_id,
                            'releasedate'=>  $releasedate,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    }
		            
		            $resultsave->save();
		            
		            if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('success', 'Newsletter Volume Added!');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('success', 'Newsletter Volume Added!');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('success', 'Newsletter Volume Added!');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('success', 'Newsletter Volume Added!');
                    }
		        } else {
		        	
		        	 if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
                    }
		        }
	        } else {
	        	
	        	 if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('errors', 'Already a Newsletter Volume with same name exists.');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('errors', 'Already a Newsletter Volume with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('errors', 'Already a Newsletter Volume with same name exists.');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('errors', 'Already a Newsletter Volume with same name exists.');
                    }
	        }    
        
    }

    public function newslettervolumeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Newslettervolume::find($id);
			$newsletter     = DB::table('newsletters')->where('status',1)->orderBy('id','asc')->get();
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $archivepolicy 	= DB::table('archivepolicies')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'newsletter'=>$newsletter,'filetype' => $filetype,'contenttype' => $contenttype, 'archivepolicy' => $archivepolicy]);
        }

    }

    public function newslettervolumeupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'entooltip1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'size1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id1'=>'required',
            'contenttypes_id1'=>'required',
            'archivepolicies_id1'=>'required',
            'releasedate1'=>'required',
			'newsletters_id1'=>'required'
		
        ]);
        
            $chkrows= Newslettervolume::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){

            	$releasedate1 = Carbon::createFromFormat('d/m/Y', $request->releasedate1)->format('Y-m-d');
				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
		            $getfiletype = DB::table('filettypes')->where('id',$request->filetypes_id)->first();
		            $ftype = $getfiletype->entitle;
	            	if($ftype==$request->imageedit->extension())
	            	{
	            		
				        $imageName1 = 'newslettervol'.$date.'.'.$request->imageedit->extension();  
				        $request->imageedit->move(public_path('Newslettervolume'), $imageName1);
			            if(Auth::user()->usertypes_id==4){
    			            $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
    		                'poster'           =>  $imageName1,
    			            'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'size'     	     =>  $request->size1,
    		                'duration'     	 =>  $request->duration1,
    		                'filetypes_id'   =>  $request->filetypes_id1,
    		                'contenttypes_id'=>  $request->contenttypes_id1,
    		                'archivepolicies_id'=>  $request->archivepolicies_id1,
    		                'releasedate'=>  $releasedate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    			            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==6){
                            $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        }
			        } else {
						
					if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('errors', 'Uploaded File does not match with filetype selected');
                    }
		        	
		        	}   
		        } else {

		        	if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
    		                'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'size'     	     =>  $request->size1,
    		                'duration'     	 =>  $request->duration1,
    		                'filetypes_id'   =>  $request->filetypes_id1,
    		                'contenttypes_id'=>  $request->contenttypes_id1,
    		                'archivepolicies_id'=>  $request->archivepolicies_id1,
    		                'releasedate'=>  $releasedate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
							'newsletters_id'  => $request->newsletters_id1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'size'           =>  $request->size1,
                            'duration'       =>  $request->duration1,
                            'filetypes_id'   =>  $request->filetypes_id1,
                            'contenttypes_id'=>  $request->contenttypes_id1,
                            'archivepolicies_id'=>  $request->archivepolicies_id1,
                            'releasedate'=>  $releasedate1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }

		        }
	        
	            Newslettervolume::whereId($request->hidden_id1)->update($form_data);
	            
	            if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('success', 'Download Updated!');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('success', 'Download Updated!');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('success', 'Download Updated!');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('success', 'Download Updated!');
                    }
	        } else {
	        	
	        	if(Auth::user()->usertypes_id==4){
					return redirect('webadmin/newslettervolumelist')->with('errors', 'Already a Download with same name exists.');
					} else if(Auth::user()->usertypes_id==3){
                   return redirect('siteadmin/newslettervolumelist')->with('errors', 'Already a Download with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
				   return redirect('editor/newslettervolumelist')->with('errors', 'Already a Download with same name exists.');
					} else if(Auth::user()->usertypes_id==6){
                   return redirect('photoeditor/newslettervolumelist')->with('errors', 'Already a Download with same name exists.');
                    }
	        }    
        
        
    }

    public function newslettervolumedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Newslettervolume::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function newslettervolumestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('newslettervolumes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('newslettervolumes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('newslettervolumes')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Newsletter Volume(end) //

	// Article(start) //
		
	public function articlelist(Request $request)
    {
		$displayval = array();
        $uid= Auth::user()->id;
	   	$listdata = DB::table('articles')
		->select('id','entitle','maltitle','status','contributor_status','moderator_remarks','approve_remarks')
		->where('users_id',$uid)
		->get();
		foreach ($listdata as $key => $value) {

          $artupldcnt = Articleupload::where('articles_id','=',$value->id)->count();
          
          $displayval[] = array('id' => $value->id, 'entitle' => $value->entitle, 'maltitle' => $value->maltitle, 'status' => $value->status, 'contributor_status' => $value->contributor_status, 'moderator_remarks' => $value->moderator_remarks,'moderator_remarks' => $value->moderator_remarks, 'artupldcnt' => $artupldcnt);
      	}
        

        return view('webadmin.articlelist',compact('displayval'));
    }

    public function articlecreate(Request $request)
    {
        if($request->ajax())
        {
            $component 		= DB::table('components')->where('status',1)->orderBy('id','asc')->get();
            $articlecategory 	= DB::table('articlecategories')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['component' => $component, 'articlecategory' => $articlecategory]);
        }
    }

    public function articlestore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'ensubtitle'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'	=>'required|min:3|max:100',
            'entooltip'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'	=>'required|min:3|max:50',
            'enauthor'	=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malauthor'	=>'required|min:3|max:500',
            'enbrief'	=>'required|min:3|max:200',
            'malbrief'	=>'required|min:3|max:500',
            'encontent'	=>'required|min:3|max:1000',
            'malcontent'	=>'required|min:3|max:1000',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'components_id'=>'required',
            'extras'=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'articlecategories_id'=>'required'

        ]);

        
            $chkrows= Article::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	if(isset($request->homepagestatus)){
        			$dplystat = 1;
        		} else {
        			$dplystat = 0;
        		}

		        $imageName = 'article'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Article'), $imageName);
                if(Auth::user()->usertypes_id==4){
    		        $resultsave = new Article([
    		            'poster'           =>  $imageName,
    		            'alt'        	 =>  $request->alttext,
    		            'entitle'        =>  $request->entitle,
    	                'maltitle'       =>  $request->maltitle,
    	                'ensubtitle'        =>  $request->ensubtitle,
    	                'malsubtitle'       =>  $request->malsubtitle,
    	                'entooltip'        =>  $request->entooltip,
    	                'maltooltip'       =>  $request->maltooltip,
    	                'enauthor'        =>  $request->enauthor,
    	                'malauthor'       =>  $request->malauthor,
    	                'enbrief'        =>  $request->enbrief,
    	                'malbrief'       =>  $request->malbrief,
    	                'encontent'        =>  $request->encontent,
    	                'malcontent'       =>  $request->malcontent,
    	                'components_id'   =>  $request->components_id,
    	                'articlecategories_id'=>  $request->articlecategories_id,
    	                'extras'=>  $request->extras,
    	                'homepagestatus'  =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                'users_id'		 => Auth::user()->id
    		        ]);
                } else if(Auth::user()->usertypes_id==3){
                    $resultsave = new Article([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'components_id'   =>  $request->components_id,
                        'articlecategories_id'=>  $request->articlecategories_id,
                        'extras'=>  $request->extras,
                        'homepagestatus'  =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==5){
                    $resultsave = new Article([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'components_id'   =>  $request->components_id,
                        'articlecategories_id'=>  $request->articlecategories_id,
                        'extras'=>  $request->extras,
                        'homepagestatus'  =>  $dplystat,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==6){
                    $resultsave = new Article([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'components_id'   =>  $request->components_id,
                        'articlecategories_id'=>  $request->articlecategories_id,
                        'extras'=>  $request->extras,
                        'homepagestatus'  =>  $dplystat,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                }

	            
	            $resultsave->save();
	           
                    if(Auth::user()->usertypes_id==4){
                     return redirect('webadmin/articlelist')->with('success', 'Article Added!');
                    }
                    else if(Auth::user()->usertypes_id==3){
                     return redirect('siteadmin/articlelist')->with('success', 'Article Added!');
                    }  else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articlelist')->with('success', 'Article Added!');
                    } 
		       
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                     return redirect('webadmin/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } else if(Auth::user()->usertypes_id==3){
                     return redirect('siteadmin/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } 
	        }    
        
    }

    public function articleedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Article::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                $component      = DB::table('components')->where('status',1)->orderBy('id','asc')->get();
                $articlecategory    = DB::table('articlecategories')->where('status',1)->orderBy('id','asc')->get();
                return response()->json(['resultdata' => $resultdata,'component' => $component,'articlecategory' => $articlecategory]);
            } else {
                return response()->json(['error' => 'The Current Article is Locked, so cannot be edited.']);
            }
            
        }

    }

	public function articleuplddet(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = DB::table('articleuploads')->where('articles_id',$id)->select('entitle')->get();
            return response()->json(['resultdata' => $resultdata]);
            
            
        }

    }

    public function articleupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'ensubtitle1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle1'	=>'required|min:3|max:100',
            'entooltip1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip1'	=>'required|min:3|max:50',
            'enauthor1'	=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malauthor1'	=>'required|min:3|max:500',
            'enbrief1'	=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malbrief1'	=>'required|min:3|max:500',
            'encontent1'	=>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent1'	=>'required|min:3|max:1000',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'components_id1'=>'required',
            'extras1'=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'articlecategories_id1'=>'required'
		
        ]);
        
            $chkrows= Article::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
            		if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
			        $imageName1 = 'article'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Article'), $imageName1);
		            if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'poster'           =>  $imageName1,
    			            'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'ensubtitle'        =>  $request->ensubtitle1,
    		                'malsubtitle'       =>  $request->malsubtitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'enauthor'        =>  $request->enauthor1,
    		                'malauthor'       =>  $request->malauthor1,
    		                'enbrief'        =>  $request->enbrief1,
    		                'malbrief'       =>  $request->malbrief1,
    		                'encontent'        =>  $request->encontent1,
    		                'malcontent'       =>  $request->malcontent1,
    		                'components_id'   =>  $request->components_id1,
    		                'articlecategories_id'=>  $request->articlecategories_id1,
    		                'extras'=>  $request->extras1,
    		                'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }
			          
		        } else {

		        	if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
                    if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'ensubtitle'        =>  $request->ensubtitle1,
    		                'malsubtitle'       =>  $request->malsubtitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'enauthor'        =>  $request->enauthor1,
    		                'malauthor'       =>  $request->malauthor1,
    		                'enbrief'        =>  $request->enbrief1,
    		                'malbrief'       =>  $request->malbrief1,
    		                'encontent'        =>  $request->encontent1,
    		                'malcontent'       =>  $request->malcontent1,
    		                'components_id'   =>  $request->components_id1,
    		                'articlecategories_id'=>  $request->articlecategories_id1,
    		                'extras'=>  $request->extras1,
    		                'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'components_id'   =>  $request->components_id1,
                            'articlecategories_id'=>  $request->articlecategories_id1,
                            'extras'=>  $request->extras1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } 

		        }
	        
	            Article::whereId($request->hidden_id1)->update($form_data);
                if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/articlelist')->with('success', 'Article Updated!');
                     
                    } else if(Auth::user()->usertypes_id==3){
                    return redirect('siteadmin/articlelist')->with('success', 'Article Updated!');
                     
                    }else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articlelist')->with('success', 'Article Updated!');
                    }
                    
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                     return redirect('webadmin/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } else if(Auth::user()->usertypes_id==3){
                     return redirect('siteadmin/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articlelist')->with('errors', 'Already an Article with same name exists.');
                    } 
	        }    
        
        
    }

    public function articledestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Article::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function articlestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('articles')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('articles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('articles')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Article(end) //

	// Article Upload(start) //
		
	public function articleuploadlist(Request $request)
    {
           $listdata = DB::table('articleuploads')
		    ->join('articles','articles.id','articleuploads.articles_id')
            ->select('articleuploads.id','articleuploads.file','articles.entitle','articleuploads.status')
            ->get();
        

        return view('webadmin.articleuploadlist',compact('listdata'));
            
             
            

    }

    public function articleuploadfiletypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }

    public function articleuploadcreate(Request $request)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $article 	= DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['filetype' => $filetype, 'contenttype' => $contenttype, 'article' => $article]);
        }
    }

    public function articleuploadstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'articles_id'=>'required'


        ]);

        
            $chkrows= Articleupload::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$getfiletype = DB::table('filetypes')->where('id',$request->filetypes_id)->first();
            	$ftype = $getfiletype->entitle;
            	if($ftype==$request->image->extension())
            	{	
            		

			        $imageName = 'articleupload'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Articleupload'), $imageName);
			        $resultsave = new Articleupload([
			            'file'           =>  $imageName,
			            'alt'        	 =>  $request->alttext,
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'size'     	     =>  $request->size,
		                'duration'     	 =>  $request->duration,
		                'filetypes_id'   =>  $request->filetypes_id,
		                'contenttypes_id'=>  $request->contenttypes_id,
		                'articles_id'    =>  $request->articles_id,
		                'users_id'		 => Auth::user()->id
			        ]);
		            
		            $resultsave->save();
                     if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/articleuploadlist')->with('success', 'Article Upload Added!');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articleuploadlist')->with('success', 'Article Upload Added!');
                    }else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/articleuploadlist')->with('success', 'Article Upload Added!');
                    }
		        } else {
                     if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    }
		        }
	        } else {
                 if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/articleuploadlist')->with('errors', 'Already an Article upload Volume with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/articleuploadlist')->with('errors', 'Already an Article upload Volume with same name exists.');
                    } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/articleuploadlist')->with('errors', 'Already an Article upload Volume with same name exists.');
                    }
	        }    
        
    }

    public function articleuploadedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Articleupload::find($id);
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $article 	= DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'filetype' => $filetype,'contenttype' => $contenttype, 'article' => $article]);
        }

    }

    public function articleuploadupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'size1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id1'=>'required',
            'contenttypes_id1'=>'required',
            'articles_id1'=>'required'
		
        ]);
        
            $chkrows= Articleupload::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){

            	if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
		            $getfiletype = DB::table('filettypes')->where('id',$request->filetypes_id)->first();
		            $ftype = $getfiletype->entitle;
	            	if($ftype==$request->imageedit->extension())
	            	{
	            		
				        $imageName1 = 'articleupload'.$date.'.'.$request->imageedit->extension();  
				        $request->imageedit->move(public_path('Articleupload'), $imageName1);
			            
			            $form_data = array(
		                'file'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'articles_id'=>  $request->articles_id1,
		                'users_id'		 => Auth::user()->id
			            );
			        } else {
                        if(Auth::user()->usertypes_id==4){
                        return redirect('webadmin/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                        } else if(Auth::user()->usertypes_id==5){
                        return redirect('editor/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                        } else if(Auth::user()->usertypes_id==6){
                        return redirect('photoeditor/articleuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                        }
		        	}   
		        } else {

		        	
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'articles_id'=>  $request->articles_id1,
		                'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Articleupload::whereId($request->hidden_id1)->update($form_data);
                if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/articleuploadlist')->with('success', 'Article Upload Updated!');
                        } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articleuploadlist')->with('success', 'Article Upload Updated!');
                        }else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/articleuploadlist')->with('success', 'Article Upload Updated!');
                        }
	        } else {
                if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/articleuploadlist')->with('errors', 'Already an Article upload with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/articleuploadlist')->with('errors', 'Already an Article upload with same name exists.');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/articleuploadlist')->with('errors', 'Already an Article upload with same name exists.');
                    }
	        }    
        
        
    }

    public function articleuploaddestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Articleupload::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function articleuploadstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('articleuploads')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('articleuploads')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('articleuploads')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Article Upload(end) //

	// Activity(start) //
		
	public function activitylist(Request $request)
    {
        $uid= Auth::user()->id;
           $listdata = DB::table('activities')
            ->select('id','entitle','maltitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('webadmin.activitylist',compact('listdata'));
    }

    public function activitycreate(Request $request)
    {
        if($request->ajax())
        {
            $activitytype 	= DB::table('activitytypes')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['activitytype' => $activitytype]);
        }
    }

    public function activitystore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'ensubtitle'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'	=>'required|min:3|max:100',
            'entooltip'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'	=>'required|min:3|max:50',
            'enauthor'	=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malauthor'	=>'required|min:3|max:500',
            'enbrief'	=>'required|min:3|max:200',
            'malbrief'	=>'required|min:3|max:500',
            'encontent'	=>'required|min:3|max:1000',
            'malcontent'	=>'required|min:3|max:1000',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'activitytypes_id'=>'required',
            'startdate'=>'required',
            'enddate'=>'required'

        ]);

        
            $chkrows= Activity::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	if(isset($request->homepagestatus)){
        			$dplystat = 1;
        		} else {
        			$dplystat = 0;
        		}
        		$startdate = Carbon::createFromFormat('d/m/Y', $request->startdate)->format('Y-m-d');
        		$enddate = Carbon::createFromFormat('d/m/Y', $request->enddate)->format('Y-m-d');
		        $imageName = 'activity'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Activity'), $imageName);
                if(Auth::user()->usertypes_id==4){
    		        $resultsave = new Activity([
    		            'poster'           =>  $imageName,
    		            'alt'        	 =>  $request->alttext,
    		            'entitle'        =>  $request->entitle,
    	                'maltitle'       =>  $request->maltitle,
    	                'ensubtitle'        =>  $request->ensubtitle,
    	                'malsubtitle'       =>  $request->malsubtitle,
    	                'entooltip'        =>  $request->entooltip,
    	                'maltooltip'       =>  $request->maltooltip,
    	                'enauthor'        =>  $request->enauthor,
    	                'malauthor'       =>  $request->malauthor,
    	                'enbrief'        =>  $request->enbrief,
    	                'malbrief'       =>  $request->malbrief,
    	                'encontent'        =>  $request->encontent,
    	                'malcontent'       =>  $request->malcontent,
    	                'activitytypes_id'=>  $request->activitytypes_id,
    	                'startdate'=>  $startdate,
    	                'enddate'=>  $enddate,
    	                'homepagestatus'  =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    	                'users_id'		 => Auth::user()->id
    		        ]);
                } else if(Auth::user()->usertypes_id==3){
                    $resultsave = new Activity([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'activitytypes_id'=>  $request->activitytypes_id,
                        'startdate'=>  $startdate,
                        'enddate'=>  $enddate,
                        'homepagestatus'  =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==5){
                    $resultsave = new Activity([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'activitytypes_id'=>  $request->activitytypes_id,
                        'startdate'=>  $startdate,
                        'enddate'=>  $enddate,
                        'homepagestatus'  =>  $dplystat,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                } else if(Auth::user()->usertypes_id==6){
                    $resultsave = new Activity([
                        'poster'           =>  $imageName,
                        'alt'            =>  $request->alttext,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'        =>  $request->ensubtitle,
                        'malsubtitle'       =>  $request->malsubtitle,
                        'entooltip'        =>  $request->entooltip,
                        'maltooltip'       =>  $request->maltooltip,
                        'enauthor'        =>  $request->enauthor,
                        'malauthor'       =>  $request->malauthor,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'        =>  $request->encontent,
                        'malcontent'       =>  $request->malcontent,
                        'activitytypes_id'=>  $request->activitytypes_id,
                        'startdate'=>  $startdate,
                        'enddate'=>  $enddate,
                        'homepagestatus'  =>  $dplystat,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);

                }  
	            
	            $resultsave->save();
	            
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activitylist')->with('success', 'Activity Added!');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/activitylist')->with('success', 'Activity Added!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activitylist')->with('success', 'Activity Added!');
                } 
		       
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } 
	        }    
        
    }

    public function activityedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Activity::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                $activitytype   = DB::table('activitytypes')->where('status',1)->orderBy('id','asc')->get();
                return response()->json(['resultdata' => $resultdata,'activitytype' => $activitytype]);
            } else {
                return response()->json(['error' => 'The Current Activity is Locked, so cannot be edited.']);
            }
            
        }

    }

    public function activityupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'ensubtitle1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle1'	=>'required|min:3|max:100',
            'entooltip1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip1'	=>'required|min:3|max:50',
            'enauthor1'	=>'required|min:3|max:200|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malauthor1'	=>'required|min:3|max:500',
            'enbrief1'	=>'required|min:3|max:200',
            'malbrief1'	=>'required|min:3|max:500',
            'encontent1'	=>'required|min:3|max:1000',
            'malcontent1'	=>'required|min:3|max:1000',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'activitytypes_id1'=>'required',
            'startdate1'=>'required',
            'enddate1'=>'required'
		
        ]);
        
            $chkrows= Activity::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
            	$startdate1 = Carbon::createFromFormat('d/m/Y', $request->startdate1)->format('Y-m-d');
        		$enddate1 = Carbon::createFromFormat('d/m/Y', $request->enddate1)->format('Y-m-d');

				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
            		if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
			        $imageName1 = 'activity'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Activity'), $imageName1);
		            if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'poster'           =>  $imageName1,
    			            'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'ensubtitle'        =>  $request->ensubtitle1,
    		                'malsubtitle'       =>  $request->malsubtitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'enauthor'        =>  $request->enauthor1,
    		                'malauthor'       =>  $request->malauthor1,
    		                'enbrief'        =>  $request->enbrief1,
    		                'malbrief'       =>  $request->malbrief1,
    		                'encontent'        =>  $request->encontent1,
    		                'malcontent'       =>  $request->malcontent1,
    		                'activitytypes_id'=>  $request->activitytypes_id1,
    		                'startdate'=>  $startdate1,
    		                'enddate'=>  $enddate1,
    		                'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );

                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );

                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'poster'           =>  $imageName1,
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );

                    }
			          
		        } else {

		        	if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
                    if(Auth::user()->usertypes_id==4){
    		            $form_data = array(
    		                'alt'        	 =>  $request->alttext1,
    			            'entitle'        =>  $request->entitle1,
    		                'maltitle'       =>  $request->maltitle1,
    		                'ensubtitle'        =>  $request->ensubtitle1,
    		                'malsubtitle'       =>  $request->malsubtitle1,
    		                'entooltip'        =>  $request->entooltip1,
    		                'maltooltip'       =>  $request->maltooltip1,
    		                'enauthor'        =>  $request->enauthor1,
    		                'malauthor'       =>  $request->malauthor1,
    		                'enbrief'        =>  $request->enbrief1,
    		                'malbrief'       =>  $request->malbrief1,
    		                'encontent'        =>  $request->encontent1,
    		                'malcontent'       =>  $request->malcontent1,
    		                'activitytypes_id'=>  $request->activitytypes_id1,
    		                'startdate'=>  $startdate1,
    		                'enddate'=>  $enddate1,
    		                'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  1,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
    		                'users_id'		 => Auth::user()->id
    		            );
                    } else if(Auth::user()->usertypes_id==3){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'approve_status'  =>  1,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==5){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    } else if(Auth::user()->usertypes_id==6){
                        $form_data = array(
                            'alt'            =>  $request->alttext1,
                            'entitle'        =>  $request->entitle1,
                            'maltitle'       =>  $request->maltitle1,
                            'ensubtitle'        =>  $request->ensubtitle1,
                            'malsubtitle'       =>  $request->malsubtitle1,
                            'entooltip'        =>  $request->entooltip1,
                            'maltooltip'       =>  $request->maltooltip1,
                            'enauthor'        =>  $request->enauthor1,
                            'malauthor'       =>  $request->malauthor1,
                            'enbrief'        =>  $request->enbrief1,
                            'malbrief'       =>  $request->malbrief1,
                            'encontent'        =>  $request->encontent1,
                            'malcontent'       =>  $request->malcontent1,
                            'activitytypes_id'=>  $request->activitytypes_id1,
                            'startdate'=>  $startdate1,
                            'enddate'=>  $enddate1,
                            'homepagestatus'  =>  $dplystat1,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        );
                    }

		        }
	        
	            Activity::whereId($request->hidden_id1)->update($form_data);
	            
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activitylist')->with('success', 'Activity Updated!');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/activitylist')->with('success', 'Activity Updated!');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activitylist')->with('success', 'Activity Updated!');
                } 
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activitylist')->with('errors', 'Already an Activity with same name exists.');
                } 
	        }    
        
        
    }

    public function activitydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Activity::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function activitystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('activities')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('activities')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('activities')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Activity(end) //


	// Activity Upload(start) //
		
	public function activityuploadlist(Request $request)
    {
           $listdata = DB::table('activityuploads')
		    ->join('activities','activities.id','activityuploads.activities_id')
            ->select('activityuploads.id','activityuploads.file','activities.entitle','activityuploads.status')
            ->get();
        

        return view('webadmin.activityuploadlist',compact('listdata'));
    }

    public function activityuploadfiletypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }

    public function activityuploadcreate(Request $request)
    {
        if($request->ajax())
        {
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $activity 	= DB::table('activities')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['filetype' => $filetype, 'contenttype' => $contenttype, 'activity' => $activity]);
        }
    }

    public function activityuploadstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'activities_id'=>'required'


        ]);

        
            $chkrows= Activityupload::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	$getfiletype = DB::table('filetypes')->where('id',$request->filetypes_id)->first();
            	$ftype = $getfiletype->entitle;
            	if($ftype==$request->image->extension())
            	{	
            		

			        $imageName = 'activityupload'.$date.'.'.$request->image->extension();  
			        $request->image->move(public_path('Activityupload'), $imageName);
			        $resultsave = new Activityupload([
			            'file'           =>  $imageName,
			            'alt'        	 =>  $request->alttext,
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'size'     	     =>  $request->size,
		                'duration'     	 =>  $request->duration,
		                'filetypes_id'   =>  $request->filetypes_id,
		                'contenttypes_id'=>  $request->contenttypes_id,
		                'activities_id'    =>  $request->activities_id,
		                'users_id'		 => Auth::user()->id
			        ]);
		            
		            $resultsave->save();
                     if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/activityuploadlist')->with('success', 'Activity Upload Added!');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/activityuploadlist')->with('success', 'Activity Upload Added!');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/activityuploadlist')->with('success', 'Activity Upload Added!');
                    }

		        } else {
                     if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    }
		        }
	        } else {
                 if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activityuploadlist')->with('errors', 'Already an Activity upload Volume with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activityuploadlist')->with('errors', 'Already an Activity upload Volume with same name exists.');
                    } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/activityuploadlist')->with('errors', 'Already an Activity upload Volume with same name exists.');
                    }
	        }    
        
    }

    public function activityuploadedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Activityupload::find($id);
            $filetype 		= DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype 	= DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();
            $activity 	= DB::table('activities')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'filetype' => $filetype,'contenttype' => $contenttype, 'activity' => $activity]);
        }

    }

    public function activityuploadupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20',
            'size1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration1'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id1'=>'required',
            'contenttypes_id1'=>'required',
            'activities_id1'=>'required'
		
        ]);
        
            $chkrows= Activityupload::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){

            	if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
		            $getfiletype = DB::table('filettypes')->where('id',$request->filetypes_id)->first();
		            $ftype = $getfiletype->entitle;
	            	if($ftype==$request->imageedit->extension())
	            	{
	            		
				        $imageName1 = 'activityupload'.$date.'.'.$request->imageedit->extension();  
				        $request->imageedit->move(public_path('Activityupload'), $imageName1);
			            
			            $form_data = array(
		                'file'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'activities_id'=>  $request->activities_id1,
		                'users_id'		 => Auth::user()->id
			            );
			        } else {
		        	
                     if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/activityuploadlist')->with('errors', 'Uploaded File does not match with filetype selected');
                    }
		        	}   
		        } else {

		        	
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'size'     	     =>  $request->size1,
		                'duration'     	 =>  $request->duration1,
		                'filetypes_id'   =>  $request->filetypes_id1,
		                'contenttypes_id'=>  $request->contenttypes_id1,
		                'activities_id'=>  $request->activities_id1,
		                'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Activityupload::whereId($request->hidden_id1)->update($form_data);
                 if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/activityuploadlist')->with('success', 'Article Upload Updated!');
                    } else if(Auth::user()->usertypes_id==5){
                    return redirect('editor/activityuploadlist')->with('success', 'Article Upload Updated!');
                    } else if(Auth::user()->usertypes_id==6){
                    return redirect('photoeditor/activityuploadlist')->with('success', 'Article Upload Updated!');
                    }
	        } else {
                 if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/activityuploadlist')->with('errors', 'Already an Activity upload with same name exists.');
                    } else if(Auth::user()->usertypes_id==5){
                return redirect('editor/activityuploadlist')->with('errors', 'Already an Activity upload with same name exists.');
                    } else if(Auth::user()->usertypes_id==6){
                return redirect('photoeditor/activityuploadlist')->with('errors', 'Already an Activity upload with same name exists.');
                    }
	        }    
        
        
    }

    public function activityuploaddestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Activityupload::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function activityuploadstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('activityuploads')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('activityuploads')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('activityuploads')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	// Activity Upload(end) //

	// Live Streaming (Start) //

	 public function livestreaminglist(Request $request) {

       
       $listdata = DB::table('livestreamings')
                    ->select('id','entitle','maltitle','url','status')
                    ->get();    

        return view('webadmin.livestreaminglist',compact('listdata'));
    }

    public function livestreamingstore(Request $request)
    {
        
		 $request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'url' => 'required|min:3|max:300',
            'livestreamingdate'	=>'required'


        ]);

        if($request->ajax())
        {
			$chkrows= Livestreaming::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$livestreamingdate = Carbon::createFromFormat('d/m/Y', $request->livestreamingdate)->format('Y-m-d');
            	
			        $resultsave = new Livestreaming([
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'url'     	     =>  $request->url,
		                'date'     	 =>  $livestreamingdate,
		                'users_id'		 => Auth::user()->id
			        ]);
		            
		            $resultsave->save();
		            return response()->json(['success' => 'Live Streaming Added!']);
	        } else {
	        	 return response()->json(['errors' => 'Already a Livestreaming with same name exists.']);
	        }
			
			
			
        }
		
        
    }

    public function livestreamingedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Livestreaming::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function livestreamingupdate(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'url' => 'required|min:3|max:300',
            'livestreamingdate'	=>'required'


        ]);
        if($request->ajax())
        {
			$chkrows= Livestreaming::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
		$livestreamingdate = Carbon::createFromFormat('d/m/Y', $request->livestreamingdate)->format('Y-m-d');
            	 $form_data = array(
			            'entitle'        =>  $request->entitle,
		                'maltitle'       =>  $request->maltitle,
		                'url'     	     =>  $request->url,
		                'date'     	 =>  $livestreamingdate,
		                'users_id'		 => Auth::user()->id
			        );
			      
	        
	            Livestreaming::whereId($request->hidden_id)->update($form_data);
	            return response()->json(['success' => 'Livestreaming Updated!']);
	        } else {
	        	return response()->json(['errors' => 'Already a Livestreaming with same name exists.']);
	        }  
			
			  
        }
		        

    }

    public function livestreamingdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Livestreaming::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function livestreamingstatus(Request $request,$id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('livestreamings')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('livestreamings')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('livestreamings')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
    }

	// Live Streaming (end) //


    // App Departments (Start) //

     public function appdepartmentlist(Request $request) {

       
       $listdata = DB::table('appdepartments')
                    ->select('id','entitle','maltitle','status')
                    ->get();    

        return view('webadmin.appdepartmentlist',compact('listdata'));
    }

    public function appdepartmentstore(Request $request)
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

        if($request->ajax())
        {
            $chkrows= Appdepartment::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
                    $resultsave = new Appdepartment([
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
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                    return response()->json(['success' => 'App Department Added!']);
            } else {
                 return response()->json(['errors' => 'Already an App Department with same name exists.']);
            }
            
            
            
        }
        
        
    }

    public function appdepartmentedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Appdepartment::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

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
        if($request->ajax())
        {
            $chkrows= Appdepartment::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
        
                 $form_data = array(
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
                        'users_id'       => Auth::user()->id
                    );
                  
            
                Appdepartment::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'App Department Updated!']);
            } else {
                return response()->json(['errors' => 'Already an App Department with same name exists.']);
            }  
            
              
        }
                

    }

    public function appdepartmentdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Appdepartment::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function appdepartmentstatus(Request $request,$id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('appdepartments')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('appdepartments')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('appdepartments')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
    }

    // App Departments (end) //

    // App Sections (Start) //

     public function appsectionlist(Request $request) {

       $uid = Auth::user()->id;
       $listdata = DB::table('appsections')
	   				->join('appdepartments','appdepartments.id','appsections.appdepartments_id')
                    ->select('appsections.id','appsections.ensectionname','appsections.malsectionname','appsections.moderator_status','appsections.approve_status','appsections.status','appsections.lock_status','appdepartments.entitle')
					->where('appsections.users_id', $uid)
                    ->get();    

        return view('webadmin.appsectionlist',compact('listdata'));
    }

    public function appsectioncreate(Request $request)
    {
        if($request->ajax())
        {
            $appdepartment       = DB::table('appdepartments')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['appdepartment' => $appdepartment]);
        }
    }

    public function appsectionstore(Request $request)
    {
        
         $request->validate([
            'appdepartments_id'   =>'required',
            'ensectionname'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsectionname'  =>'required|min:3|max:50',
            'ensectiondetails'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsectiondetails'  =>'required|min:3|max:1000'
            
        ]);

        if($request->ajax())
        {
            $chkrows= Appsection::where('ensectionname',$request->ensectionname)->exists() ? 1 : 0;
            $now = Carbon::now();
            if($chkrows==0){ 
                if(Auth::user()->usertypes_id==4){
                    $resultsave = new Appsection([
                            'appdepartments_id' =>  $request->appdepartments_id,
                            'ensectionname'     =>  $request->ensectionname,
                            'malsectionname'    =>  $request->malsectionname,
                            'ensectiondetails'  =>  $request->ensectiondetails,
                            'malsectiondetails' =>  $request->malsectiondetails,
                            'approve_status'    =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp' =>  $now,
                            'users_id'          => Auth::user()->id
                        ]);
                } else if(Auth::user()->usertypes_id==15){
                    $resultsave = new Appsection([
                            'appdepartments_id' =>  $request->appdepartments_id,
                            'ensectionname'     =>  $request->ensectionname,
                            'malsectionname'    =>  $request->malsectionname,
                            'ensectiondetails'  =>  $request->ensectiondetails,
                            'malsectiondetails' =>  $request->malsectiondetails,
                            'contributor_status'    =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp' =>  $now,
                            'users_id'          => Auth::user()->id
                        ]);
                } 
                    
                    
                    $resultsave->save();
                    return response()->json(['success' => 'App Section Added!']);
					
            } else {
                 return response()->json(['errors' => 'Already an App Section with same name exists.']);
            }
            
            
            
        }
        
        
    }

    public function appsectionedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Appsection::find($id);
            $appdepartment       = DB::table('appdepartments')->where('status',1)->orderBy('id','asc')->get();
            return response()->json(['resultdata' => $resultdata,'appdepartment' => $appdepartment]);
        }
        /*if($request->ajax())
        {
          if(Auth::user()->usertypes_id==4){
                $resultdata = Appsection::find($id);
                $appdepartment       = DB::table('appdepartments')->where('status',1)->orderBy('id','asc')->get();
                return response()->json(['resultdata' => $resultdata,'appdepartment' => $appdepartment]);
            
            } else if(Auth::user()->usertypes_id==15){
            $cntdata = Appsection::find($id);
                 $lockstatus = $cntdata->lock_status;   
            if ($lockstatus==1) {
                return response()->json(['errors' => 'locked']);
            }else {
                 $resultdata = Appsection::find($id);
                $appdepartment       = DB::table('appdepartments')->where('status',1)->orderBy('id','asc')->get();
                return response()->json(['resultdata' => $resultdata,'appdepartment' => $appdepartment]);
            }
            
         } 
        }*/
    }

    public function appsectionupdate(Request $request)
    {
        $request->validate([
            'appdepartments_id'   =>'required',
            'ensectionname'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsectionname'  =>'required|min:3|max:50',
            'ensectiondetails'   =>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsectiondetails'  =>'required|min:3|max:1000'


        ]);
        if($request->ajax())
        {
            $chkrows= Appsection::where('ensectionname',$request->ensectionname)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
        
                 $form_data = array(
                        'appdepartments_id' =>  $request->appdepartments_id,
                        'ensectionname'     =>  $request->ensectionname,
                        'malsectionname'    =>  $request->malsectionname,
                        'ensectiondetails'  =>  $request->ensectiondetails,
                        'malsectiondetails' =>  $request->malsectiondetails,
                        'users_id'          => Auth::user()->id
                    );
                  
            
                Appsection::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'App Section Updated!']);
            } else {
                return response()->json(['errors' => 'Already an App Section with same name exists.']);
            }  
            
              
        }
                

    }

    public function appsectiondestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Appsection::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function appsectionstatus(Request $request,$id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('appsections')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('appsections')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('appsections')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
    }

    // App Section (end) //

    // Widget Link (Start) //

    		
	public function widgetlinklist(Request $request)
    {
        $uid= AUth::user()->id;
           $listdata = DB::table('widgetlinks')
            ->select('id','entitle','maltitle','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('webadmin.widgetlinklist',compact('listdata'));
    }

    
    public function widgetlinkstore(Request $request)
    {
		$request->validate([
            'entitle'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'	=>'required|min:3|max:50',
            'ensubtitle'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'	=>'required|min:3|max:100',
            'entooltip'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'	=>'required|min:3|max:50',
            'encontent'	=>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'	=>'required|min:3|max:1000',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'	=>'required|min:3|max:20'

        ]);

        
            $chkrows= Widgetlink::where('entitle',$request->entitle)->exists() ? 1 : 0;
            if($chkrows==0){
            	$date = date('dmYH:i:s');
            	if(isset($request->homepagestatus)){
        			$dplystat = 1;
        		} else {
        			$dplystat = 0;
        		}
        		$imageName = 'widgetlink'.$date.'.'.$request->image->extension();  
		        $request->image->move(public_path('Widgetlink'), $imageName);
		        $resultsave = new Widgetlink([
		            'file'           =>  $imageName,
		            'alt'        	 =>  $request->alttext,
		            'entitle'        =>  $request->entitle,
	                'maltitle'       =>  $request->maltitle,
	                'ensubtitle'        =>  $request->ensubtitle,
	                'malsubtitle'       =>  $request->malsubtitle,
	                'entooltip'        =>  $request->entooltip,
	                'maltooltip'       =>  $request->maltooltip,
	                'encontent'        =>  $request->encontent,
	                'malcontent'       =>  $request->malcontent,
	                'homepagestatus'  =>  $dplystat,
	                'users_id'		 => Auth::user()->id
		        ]);
	            
	            $resultsave->save();
	            
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/widgetlinklist')->with('success', 'Widgetlink Added!');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/widgetlinklist')->with('success', 'Widgetlink Added!');
                }
		       
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                return redirect('webadmin/widgetlinklist')->with('errors', 'Already a Widget with same name exists.');
                } else if(Auth::user()->usertypes_id==3){
                return redirect('siteadmin/widgetlinklist')->with('errors', 'Already a Widget with same name exists.');
                }
	        }    
        
    }

    public function widgetlinkedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Widgetlink::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function widgetlinkupdate(Request $request)
    {
		$request->validate([
			'entitle1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle1'	=>'required|min:3|max:50',
            'ensubtitle1'	=>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle1'	=>'required|min:3|max:100',
            'entooltip1'	=>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip1'	=>'required|min:3|max:50',
            'encontent1'	=>'required|min:3|max:1000|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent1'	=>'required|min:3|max:1000',
            'imageedit' => 'mimes:jpg,jpeg,png|max:1100',
            'alttext1'	=>'required|min:3|max:20'
		
        ]);
        
            $chkrows= Widgetlink::where('entitle',$request->entitle)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
            	
				if(isset($request->imageedit))
		        {
		            $date = date('dmYH:i:s');
		            
            		if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
			        $imageName1 = 'widgetlink'.$date.'.'.$request->imageedit->extension();  
			        $request->imageedit->move(public_path('Widgetlink'), $imageName1);
		            
		            $form_data = array(
		                'file'           =>  $imageName1,
			            'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'ensubtitle'        =>  $request->ensubtitle1,
		                'malsubtitle'       =>  $request->malsubtitle1,
		                'entooltip'        =>  $request->entooltip1,
		                'maltooltip'       =>  $request->maltooltip1,
		                'encontent'        =>  $request->encontent1,
		                'malcontent'       =>  $request->malcontent1,
		                'homepagestatus'  =>  $dplystat1,
		                'users_id'		 => Auth::user()->id
		            );
			          
		        } else {

		        	if(isset($request->homepagestatus1)){
            			$dplystat1 = 1;
            		} else {
            			$dplystat1 = 0;
            		}
		            $form_data = array(
		                'alt'        	 =>  $request->alttext1,
			            'entitle'        =>  $request->entitle1,
		                'maltitle'       =>  $request->maltitle1,
		                'ensubtitle'        =>  $request->ensubtitle1,
		                'malsubtitle'       =>  $request->malsubtitle1,
		                'entooltip'        =>  $request->entooltip1,
		                'maltooltip'       =>  $request->maltooltip1,
		                'encontent'        =>  $request->encontent1,
		                'malcontent'       =>  $request->malcontent1,
		                'homepagestatus'  =>  $dplystat1,
		                'users_id'		 => Auth::user()->id
		            );

		        }
	        
	            Widgetlink::whereId($request->hidden_id1)->update($form_data);
	            
                if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/widgetlinklist')->with('success', 'Widgetlink Updated!');
                    } else if(Auth::user()->usertypes_id==3){
                    return redirect('siteadmin/widgetlinklist')->with('success', 'Widgetlink Updated!');
                    }
	        } else {
	        	
                if(Auth::user()->usertypes_id==4){
                    return redirect('webadmin/widgetlinklist')->with('errors', 'Already a Widgetlink with same name exists.');
                    } else if(Auth::user()->usertypes_id==3){
                    return redirect('siteadmin/widgetlinklist')->with('errors', 'Already a Widgetlink with same name exists.');
                    }
	        }    
        
        
    }

    public function widgetlinkdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Widgetlink::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
	
	public function widgetlinkstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('widgetlinks')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('widgetlinks')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
				$upd_status = array('status' => 1);
				DB::table('widgetlinks')->where('id',$id)->update($upd_status);
				return response()->json(['success' => 'Data Updated successfully.']);
				
   

            } 
        }
        
    }
	
	
	
    // Widget Link (End) //

}
