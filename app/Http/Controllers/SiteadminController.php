<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articlecategory;
use App\Activitytype;
use App\Button;
use App\Menulinktype;
use App\Logo;
use App\Title;
use App\Footer;
use App\Footermenu;
use App\Footerlink;
use App\Socialmedia;
use App\Mainmenu;
use App\Submenu;
use App\Componentarticle;
use App\Deptintroduction;
use App\faq;
use App\Shortalert;
use App\Longalert;
use App\Mediaalert;
use App\User;
use Session;
use DB;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Hash;

class SiteadminController extends Controller
{

    public function siteadminhome(Request $request)
    {
        return view('siteadmindashboard');
    }

    /* Article Category  */

    public function articlecategorylist(Request $request)
    {
           $listdata = DB::table('articlecategories')
            ->select('id','entitle','status')
            ->get();
        

        return view('siteadmin.articlecategorylist',compact('listdata'));
    }

    public function articlecategorystore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'

        ]);

        if($request->ajax())
        {
           /* $chkrows= Articlecategory::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                $resultsave = new Articlecategory([
                    'entitle'        =>  $request->name,
                    'users_id'   =>  Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already an User Type with same name exists.']);
            } */   
        }
        
    }

    public function articlecategoryedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Articlecategory::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function articlecategoryupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Articlecategory::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'users_id'   =>  Auth::user()->id
                );
                Articlecategory::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already an Article category with same name exists.']);
            }    
        }
        
    }

    public function articlecategorydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Articlecategory::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function articlecategorystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('articlecategories')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('articlecategories')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('articlecategories')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);

            } 
        }
        
    }

    /* Article Category  end */


    /* Activity type  */

     public function activitytypelist(Request $request)
    {
           $listdata = DB::table('activitytypes')
            ->select('id','entitle','maltitle','status')
            ->get();
        

        return view('siteadmin.activitytypelist',compact('listdata'));
    }

    public function activitytypestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'

        ]);

        if($request->ajax())
        {
            /*$chkrows= Activitytype::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                $resultsave = new Activitytype([
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }*/    
        }
        
    }

    public function activitytypeedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Activitytype::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function activitytypeupdate(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Activitytype::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'users_id'   =>  Auth::user()->id
                );
                Activitytype::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function activitytypedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Activitytype::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function activitytypestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('activitytypes')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('activitytypes')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('activitytypes')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

     /*    Activity type end  */ 

       /* Header Button */

    

     public function headerbuttonlist(Request $request)
    {
           $listdata = DB::table('buttons')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
            ->get();
        

        return view('siteadmin.headerbuttonlist',compact('listdata'));
    }
     public function buttoncreate(Request $request)
    {
        if($request->ajax())
        {
              
            
            $menutype     = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            $article     = DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
           
            
            return response()->json(['menutype' => $menutype,'article'=>$article]);
        }
    }


    public function headerbuttonstore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'colorclass'     =>'required|min:3|max:50',
            'menutypeid' =>'required',
            'filename'    =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'    =>'sometimes|nullable',
            'articleid'=>'sometimes|nullable'

        ]);

      

        if($request->ajax())
        {
            $chkrows= Button::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'mainmenu'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Mainmenu'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }
                $resultsave = new Button([
                    'file'      =>  $fileName,
                    'iconclass'  =>  $request->iconclass,
                    'colorclass' =>  $request->colorclass,
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'entooltip'  =>  $request->entooltip,
                    'maltooltip' =>  $request->maltooltip,
                    'components_id' =>  2,
                    'menulinktypes_id'  =>  $request->menutypeid,                
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function headerbuttonedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Button::find($id);
            $menutype   = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            $article    = DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
           
            return response()->json(['resultdata' => $resultdata,'menutype' => $menutype,'article'=>$article]);
        }

    }

    public function headerbuttonupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'=>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass' =>'required|min:3|max:50',
            'colorclass'=>'required|min:3|max:50',
            'menutypeid'=>'required',
            'filename'  =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'   =>'sometimes|nullable',
            'articleid' =>'sometimes|nullable'
        ]);
        if($request->ajax())
        {
            $chkrows= Button::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                  $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'hbtn'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Headerbtn'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }

                $form_data = array(
                    'file'       =>  $fileName,
                    'iconclass'  =>  $request->iconclass,
                    'colorclass' =>  $request->colorclass,
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'entooltip'  =>  $request->entooltip,
                    'maltooltip' =>  $request->maltooltip,
                    'components_id' =>  2,
                    'menulinktypes_id'  =>  $request->menutypeid,                
                    'users_id'       => Auth::user()->id
                );

                Button::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a button with same name exists.']);
            }    
        }
        
    }

    public function headerbuttondestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Button::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function headerbuttonstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('buttons')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('buttons')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('buttons')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

     /*    Header Button end  */ 

         /* Button */

    

     public function buttonlist(Request $request)
    {
           $listdata = DB::table('buttons')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
            ->where('components_id',0)
            ->get();
        

        return view('siteadmin.buttonlist',compact('listdata'));
    }
     
 public function btncreate(Request $request)
    {
        if($request->ajax())
        {
              
            
            $menutype    = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            $article     = DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
           
            
            return response()->json(['menutype' => $menutype,'article'=>$article]);
        }
    }

    public function buttonstore(Request $request)
    {
        $request->validate([
            'name'          =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'       =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip'     =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'    =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'     =>'required|min:3|max:50',
            'colorclass'     =>'required|min:3|max:50',
            'menutypeid'    =>'required',
            'filename'      =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'       =>'sometimes|nullable',
            'articleid'     =>'sometimes|nullable'

        ]);

      

        if($request->ajax())
        {
            $chkrows= Button::where('entitle',$request->name)->where('components_id',0)->exists() ? 1 : 0;
            if($chkrows==0){
                $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'btn'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Button'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }
                $resultsave = new Button([
                    'file'      =>  $fileName,
                    'iconclass'  =>  $request->iconclass,
                    'colorclass' =>  $request->colorclass,
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'entooltip'  =>  $request->entooltip,
                    'maltooltip' =>  $request->maltooltip,
                    'components_id' =>  0,
                    'menulinktypes_id'  =>  $request->menutypeid,                
                    'users_id'       => Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            }    
        }
        
    }

    public function buttonedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Button::find($id);
            $menutype     = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            $article     = DB::table('articles')->where('status',1)->orderBy('id','asc')->get();
           
            return response()->json(['resultdata' => $resultdata,'menutype' => $menutype,'article'=>$article]);
        }

    }

    public function buttonupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'=>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass' =>'required|min:3|max:50',
            'colorclass'=>'required|min:3|max:50',
            'menutypeid'=>'required',
            'filename'  =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'   =>'sometimes|nullable',
            'articleid' =>'sometimes|nullable'
        ]);
        if($request->ajax())
        {
            $chkrows= Button::where('components_id',0)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                  $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'hbtn'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Button'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }

                $form_data = array(
                    'file'       =>  $fileName,
                    'iconclass'  =>  $request->iconclass,
                    'colorclass' =>  $request->colorclass,
                    'entitle'    =>  $request->name,
                    'maltitle'   =>  $request->malname,
                    'entooltip'  =>  $request->entooltip,
                    'maltooltip' =>  $request->maltooltip,
                    'components_id' =>  0,
                    'menulinktypes_id'  =>  $request->menutypeid,                
                    'users_id'       => Auth::user()->id
                );

                Button::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a button with same name exists.']);
            }    
        }
        
    }

    public function buttondestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Button::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function buttonstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('buttons')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('buttons')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('buttons')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

     /*   Button end  */ 

     /* Logo*/


        
    
    public function logolist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('logos')
            ->select('id','alt','entooltip','maltooltip','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.logoslist',compact('listdata'));
    }

    

    public function logostore(Request $request)
    { 

        $request->validate([

            'logofile' =>'required|mimes:jpg,jpeg,png|max:1100',
            'alttext' =>'required|min:3|max:20',
            'logourl' =>'required',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'=>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {

             $chkrows= Logo::where('entooltip',$request->entooltip)->exists() ? 1 : 0;
            if($chkrows==0)
            {
            $date = date('dmYH:i:s');
            $logoName = 'logo'.$date.'.'.$request->logofile->extension();  
            $request->logofile->move(public_path('Logo'), $logoName);

            $resultsave = new Logo([
                'file'  => $logoName,
                'alt'   => $request->alttext,
                'url'   => $request->logourl,
                'entooltip'=> $request->entooltip,
                'maltooltip'=> $request->maltooltip,
                'users_id'  => Auth::user()->id
            ]); 
            $resultsave->save();
           return response()->json(['success' => 'Data Added successfully.']);
           } else {
                return response()->json(['errors' => 'Already a Content type with same name exists.']);
            } 

        }    
        
    }

    public function logoedit(Request $request, $id)
    {
        if($request->ajax())
        {
            
            $resultdata = Logo::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function logoupdate(Request $request)
    {
        $request->validate([
            'logofile' =>'sometimes|nullable|mimes:jpg,jpeg,png|max:1100',
            'alttext' =>'required|min:3|max:20',
            'logourl' =>'required',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'=>'required|min:3|max:50'
        ]);


        if($request->ajax())
        {
           

             $chkrows= Logo::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {


               if(isset($request->logofile))
                {
        
            
                    $date = date('dmYH:i:s');
                    $logoName = 'logo'.$date.'.'.$request->logofile->extension();  
                    $request->logofile->move(public_path('Logo'), $logoName);

                    $form_data = array(
                   'file'  => $logoName,
                    'alt'   => $request->alttext,
                    'url'   => $request->logourl,
                    'entooltip'=> $request->entooltip,
                    'maltooltip'=> $request->maltooltip,
                    'users_id'       => Auth::user()->id
                    );
            
                 } 
                 else {

            
                        $form_data = array(
                            'alt'   => $request->alttext,
                            'url'   => $request->logourl,
                            'entooltip'=> $request->entooltip,
                            'maltooltip'=> $request->maltooltip,
                            'users_id'       => Auth::user()->id
                        );

                        }
                        
                    Logo::whereId($request->hidden_id)->update($form_data);
                    return response()->json(['success' => 'Data is successfully updated']);
         } 
         else 
         {
                return response()->json(['errors' => 'Already a logo with same name exists.']);
            
        }     
        
    }
}

    public function logodestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Logo::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function logostatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('logos')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('logos')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('logos')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


    /* Logo end */

/* Title  */

    public function titlelist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('titles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.titlelist',compact('listdata'));
    }

    public function titlestore(Request $request)
    {
        $request->validate([
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'subname'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'

        ]);

        if($request->ajax())
        {
            $chkrows= Title::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){
                $resultsave = new Title([
                    'entitle'        =>  $request->name,
                    'maltitle'        =>  $request->malname,
                    'ensubtitle'        =>  $request->subname,
                    'malsubtitle'        =>  $request->malsubname,
                    'users_id'   =>  Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Title with same name exists.']);
            }    
        }
        
    }

    public function titleedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Title::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function titleupdate(Request $request)
    {
        $request->validate([
            'name'          =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'       =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'subname'       =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubname'    =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        if($request->ajax())
        {
            $chkrows= Title::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'entitle'        =>  $request->name,
                    'maltitle'       =>  $request->malname,
                    'ensubtitle'     =>  $request->subname,
                    'malsubtitle'    =>  $request->malsubname,
                    'users_id'       =>  Auth::user()->id
                );
                Title::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a Title with same name exists.']);
            }    
        }
        
    }

    public function titledestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Title::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function titlestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('titles')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('titles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('titles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Title  end */

    /* Footer  */

    public function footerlist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('footers')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.footerlist',compact('listdata'));
    }

    public function footerstore(Request $request)
    {
        $request->validate([
            'filename'  =>'required|mimes:jpg,jpeg,png,pdf|max:1100',
            'alttext' =>'required|min:3|max:20',
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'subname'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50'

        ]);

        if($request->ajax())
        {
            $chkrows= Footer::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){

            $date = date('dmYH:i:s');
            $fileName = 'footer'.$date.'.'.$request->filename->extension();  
            $request->filename->move(public_path('Footer'), $fileName);
                $resultsave = new Footer([
                    'file'          =>  $fileName,
                    'alt'           =>  $request->alttext,
                    'entitle'       =>  $request->name,
                    'maltitle'      =>  $request->malname,
                    'ensubtitle'    =>  $request->subname,
                    'malsubtitle'   =>  $request->malsubname,
                    'iconclass'     =>  $request->iconclass,
                    'users_id'      =>  Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Title with same name exists.']);
            }    
        }
        
    }

    public function footeredit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Footer::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function footerupdate(Request $request)
    {
        $request->validate([
            'filename'  =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'alttext' =>'required|min:3|max:20',
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'subname'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50'
        ]);
        if($request->ajax())
        {
            $chkrows= Footer::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                 if(isset($request->filename))
                {

                        $date = date('dmYH:i:s');
                            $fileName = 'footer'.$date.'.'.$request->filename->extension();  
                            $request->filename->move(public_path('Footer'), $fileName);
                        $form_data = array(
                            'file'          =>  $fileName,
                            'alt'           =>  $request->alttext,
                            'entitle'        =>  $request->name,
                            'maltitle'       =>  $request->malname,
                            'ensubtitle'     =>  $request->subname,
                            'malsubtitle'    =>  $request->malsubname,
                            'iconclass'     =>  $request->iconclass,
                            'users_id'       =>  Auth::user()->id
                        );
                    }
                    else
                    {
                         $form_data = array(
                            'alt'           =>  $request->alttext,
                            'entitle'        =>  $request->name,
                            'maltitle'       =>  $request->malname,
                            'ensubtitle'     =>  $request->subname,
                            'malsubtitle'    =>  $request->malsubname,
                            'iconclass'     =>  $request->iconclass,
                            'users_id'       =>  Auth::user()->id
                        );
                    }
                Footer::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a footer with same name exists.']);
            }    
        }
        
    }

    public function footerdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Footer::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function footerstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('footers')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('footers')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('footers')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Footer  end */

     /* Footer Menu */

    public function footermenulist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('footermenus')
            ->select('id','entitle','maltitle','status')
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.footermenulist',compact('listdata'));
    }

    public function footermenustore(Request $request)
    {
        $request->validate([
            'filename'  =>'required|mimes:jpg,jpeg,png,pdf|max:1100',
            'alttext' =>'required|min:3|max:20',
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'summernoteeng'  =>'required|min:3|max:1000',
            'summernotemal'  =>'required|min:3|max:1000'

        ]);

        if($request->ajax())
        {
            $chkrows= Footermenu::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0)
            {

            $date = date('dmYH:i:s');
            $fileName = 'fmenu'.$date.'.'.$request->filename->extension();  
            $request->filename->move(public_path('Footermenu'), $fileName);
                $resultsave = new Footermenu([
                    'file'          =>  $fileName,
                    'alt'           =>  $request->alttext,
                    'entitle'       =>  $request->name,
                    'maltitle'      =>  $request->malname,
                    'encontent'    =>  $request->summernoteeng,
                    'malcontent'   =>  $request->summernotemal,
                    'users_id'      =>  Auth::user()->id
                ]); 
                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Footer menu with same name exists.']);
            }    
        }
        
    }

    public function footermenuedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Footermenu::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function footermenuupdate(Request $request)
    {
        $request->validate([
            'filename'  =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'alttext' =>'required|min:3|max:20',
            'name'  =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'summernoteeng'  =>'required|min:3|max:1000',
            'summernotemal'  =>'required|min:3|max:1000'
        ]);

        if($request->ajax())
        {

            $chkrows= Footermenu::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {

                 if(isset($request->logofile))
                {
        
            
                    $date = date('dmYH:i:s');
                    $fileName = 'fmenu'.$date.'.'.$request->filename->extension();  
                    $request->filename->move(public_path('Footermenu'), $fileName);



                    $form_data = array(
                        'file'         =>  $fileName,
                        'alt'          =>  $request->alttext,
                        'entitle'      =>  $request->name,
                        'maltitle'     =>  $request->malname,
                        'encontent'    =>  $request->summernoteeng,
                        'malcontent'   =>  $request->summernotemal,
                        'users_id'     =>  Auth::user()->id
                    );
                }
                else
                {
                      $form_data = array(
                        'alt'          =>  $request->alttext,
                        'entitle'      =>  $request->name,
                        'maltitle'     =>  $request->malname,
                        'encontent'    =>  $request->summernoteeng,
                        'malcontent'   =>  $request->summernotemal,
                       'users_id'     =>  Auth::user()->id
                    );

                }    

                Footermenu::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a footer with same name exists.']);
            }    
        }
        
    }

    public function footermenudestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Footermenu::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function footermenustatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('footermenus')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('footermenus')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('footermenus')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Footer  Menu end */


 /* Footer Link */

    public function footerlinklist(Request $request)
    {
            $uid = Auth::user()->id;
 
           $listdata = DB::table('footerlinks')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.footerlinklist',compact('listdata'));
    }

    public function footerlinkstore(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'urlpath'    =>'required'

        ]);
       if($request->ajax())
        {
            $chkrows= Footerlink::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0)
            {

           
                $resultsave = new Footerlink([
                     'url'         =>  $request->urlpath,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip,
                    'users_id'     =>  Auth::user()->id
                ]); 


                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Footer link with same name exists.']);
            }    
        }
        
    }

    public function footerlinkedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Footerlink::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function footerlinkupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'urlpath'    =>'required'

        ]);

        if($request->ajax())
        {

            $chkrows= Footerlink::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {

                        $form_data = array(
                        'url'          =>  $request->urlpath,
                        'iconclass'    =>  $request->iconclass,
                        'entitle'      =>  $request->name,
                        'maltitle'     =>  $request->malname,
                        'entooltip'    =>  $request->entooltip,
                        'maltooltip'   =>  $request->maltooltip,
                        'users_id'     =>  Auth::user()->id
                         );
              

                Footerlink::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a footer link with same name exists.']);
            }    
        }
        
    }

    public function footerlinkdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Footerlink::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function footerlinkstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('footerlinks')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('footerlinks')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('footerlinks')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Footer  Link end */

    /* Social media */

    public function socialmedialist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('socialmedia')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.socialmedialist',compact('listdata'));
    }

    public function socialmediastore(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'urlpath'    =>'required'

        ]);
       if($request->ajax())
        {
            $chkrows= Socialmedia::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0)
            {

           
                $resultsave = new Socialmedia([
                     'url'         =>  $request->urlpath,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip,
                    'users_id'     =>  Auth::user()->id
                ]); 


                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Footer link with same name exists.']);
            }    
        }
        
    }

    public function socialmediaedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Socialmedia::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function socialmediaupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'urlpath'    =>'required'

        ]);

        if($request->ajax())
        {

            $chkrows= Socialmedia::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {

                        $form_data = array(
                        'url'          =>  $request->urlpath,
                        'iconclass'    =>  $request->iconclass,
                        'entitle'      =>  $request->name,
                        'maltitle'     =>  $request->malname,
                        'entooltip'    =>  $request->entooltip,
                        'maltooltip'   =>  $request->maltooltip,
                        'users_id'     =>  Auth::user()->id
                         );
              

                Socialmedia::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a footer link with same name exists.']);
            }    
        }
        
    }

    public function socialmediadestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Socialmedia::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function socialmediastatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('socialmedia')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('socialmedia')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('socialmedia')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Social end */

    /* Main Menu  */

    public function mainmenulist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('mainmenus')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.mainmenulist',compact('listdata'));
    }

      public function mainmenucreate(Request $request)
    {
        if($request->ajax())
        {
              
            
            $menutype    = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            $article     = DB::table('articles')->where('status',1)->orderBy('id','asc')->get(); 
           
            
            return response()->json(['menutype' => $menutype,'article'=>$article]);
        }
    }

    public function mainmenustore(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'menutypeid' =>'required',
            'pointto'    =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'filename'    =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'    =>'sometimes|nullable',
            'articleid'=>'sometimes|nullable'


        ]);
       if($request->ajax())
        {
            $chkrows= Mainmenu::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0)
            {
                $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'mainmenu'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Mainmenu'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }
                   

           
                $resultsave = new Mainmenu([
                     'file'         =>  $fileName,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip, 
                    'menulinktypes_id'   =>  $request->menutypeid,
                    'pointto'   =>  $request->pointto,
                    'users_id'     =>  Auth::user()->id
                ]); 


                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an Footer link with same name exists.']);
            }    
        }
        
    }

    public function mainmenuedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Mainmenu::find($id);
            $menutype     = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
            return response()->json(['resultdata' => $resultdata,'menutype'=>$menutype]);
        }

    }

    public function mainmenuupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'menutypeid' =>'required',
            'pointto' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'filename'    =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'    =>'sometimes|nullable',
            'articleid'=>'sometimes|nullable'

        ]);

        if($request->ajax())
        {

            $chkrows= Mainmenu::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {

                 $menutypeid=$request->menutypeid;
                   $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'mainmenu'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Mainmenu'), $fileName);  
                    }
                    else if($menutypeid==5)
                    {
                        $fileName=$request->articleid;
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }

                        $form_data = array(
                    'file'         =>  $fileName,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip, 
                    'menulinktypes_id'   =>  $request->menutypeid,
                    'pointto'   =>  $request->pointto,
                    'users_id'     =>  Auth::user()->id
                         );
              

                Mainmenu::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a footer link with same name exists.']);
            }    
        }
        
    }

    public function mainmenudestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Mainmenu::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function mainmenustatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('mainmenus')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('mainmenus')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('mainmenus')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Main Menu end */

    /* Sub Menu  */

    public function submenulist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('submenus')
            ->select('id','entitle','maltitle','entooltip','maltooltip','status')
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.submenulist',compact('listdata'));
    }

      public function submenucreate(Request $request)
    {
        if($request->ajax())
        {
              
            
            $menutype     = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get();
            $mainmenu     = DB::table('mainmenus')->where('status',1)->orderBy('id','asc')->get(); 
            
           
            
            return response()->json(['menutype' => $menutype,'mainmenu' => $mainmenu]);
        }
    }

    public function submenustore(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'mainmenuid' =>'required',
            'menutypeid' =>'required',
            'pointto' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'filename'    =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'    =>'sometimes|nullable'


        ]);
       if($request->ajax())
        {
            $chkrows= Submenu::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0)
            {
                $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'submenu'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Submenu'), $fileName);  
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }
                   

           
                $resultsave = new Submenu([
                     'file'         =>  $fileName,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip, 
                    'parentmenu'   =>  $request->mainmenuid,
                    'menulinktypes_id'   =>  $request->menutypeid,
                    'pointto'   =>  $request->pointto,
                    'users_id'     =>  Auth::user()->id
                ]); 


                $resultsave->save();
                return response()->json(['success' => 'Data Added successfully.']);
            } else {
                return response()->json(['errors' => 'Already an submenu with same name exists.']);
            }    
        }
        
    }

    public function submenuedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Submenu::find($id);
            $menutype     = DB::table('menulinktypes')->where('status',1)->orderBy('id','asc')->get(); 
             $mainmenu     = DB::table('mainmenus')->where('status',1)->orderBy('id','asc')->get(); 
            return response()->json(['resultdata' => $resultdata,'menutype'=>$menutype,'mainmenu'=>$mainmenu]);
        }

    }

    public function submenuupdate(Request $request)
    {
        $request->validate([
            'name'      =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname'   =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip' =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'iconclass'  =>'required|min:3|max:50',
            'mainmenuid' =>'required',
            'menutypeid' =>'required',
            'pointto' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'filename'    =>'sometimes|nullable|mimes:jpg,jpeg,png,pdf|max:1100',
            'urlpath'    =>'sometimes|nullable'

        ]);

        if($request->ajax())
        {

            $chkrows= Submenu::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0)
            {

                 $menutypeid=$request->menutypeid;
                    if($menutypeid==4)
                    {
                        $date = date('dmYH:i:s');
                        $fileName = 'submenu'.$date.'.'.$request->filename->extension();  
                        $request->filename->move(public_path('Submenu'), $fileName);  
                    }
                    else
                    {
                        $fileName=$request->urlpath;
                    }

                        $form_data = array(
                    'file'         =>  $fileName,
                    'iconclass'    =>  $request->iconclass,
                    'entitle'      =>  $request->name,
                    'maltitle'     =>  $request->malname,
                    'entooltip'    =>  $request->entooltip,
                    'maltooltip'   =>  $request->maltooltip,
                     'maltooltip'   =>  $request->maltooltip, 
                    'parentmenu'   =>  $request->mainmenuid,
                    'pointto'   =>  $request->pointto,
                    'users_id'     =>  Auth::user()->id
                         );
              

                Submenu::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data is successfully updated']);
            } else {
                return response()->json(['errors' => 'Already a submenu with same name exists.']);
            }    
        }
        
    }

    public function submenudestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Submenu::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function submenustatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('submenus')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('submenus')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('submenus')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

    /* Sub Menu end */

    /* What's New */


    public function whatisnewlist(Request $request)
    {
           $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('components_id',3)
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.whatisnewlist',compact('listdata'));
    }

   
       public function whatisnewstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Componentarticle::where('components_id',3)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                     if(Auth::user()->usertypes_id==4){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } 
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function whatisnewedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
            return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The About portal is Locked, so cannot be edited.']);
            }
        }

    }

    public function whatisnewupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('id','!=',$request->hidden_id) ->where('components_id',3)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  3,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } 
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function whatisnewdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function whatisnewstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                 ->where('components_id',3)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // What's New(end) //


     /* About Department */


    public function aboutdepartmentlist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
             ->where('components_id',4)
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.aboutdepartmentlist',compact('listdata'));
    }

   
       public function aboutdepartmentstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',4)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                    if(Auth::user()->usertypes_id==4){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    }
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function aboutdepartmentedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The About portal is Locked, so cannot be edited.']);
            }
            
        }

    }

    public function aboutdepartmentupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',4)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  4,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        }
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function aboutdepartmentdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function aboutdepartmentstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',4)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // About Department(end) //


    /* About Portal */


    public function aboutportallist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
             ->where('components_id',5)
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.aboutportallist',compact('listdata'));
    }

   
       public function aboutportalstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',5)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }

                    if(Auth::user()->usertypes_id==4){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Componentarticle([
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } 
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function aboutportaledit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                 return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The About portal is Locked, so cannot be edited.']);
            }
           
        }

    }

    public function aboutportalupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',5)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                            'entooltip'      =>  $request->entooltip,
                            'maltooltip'     =>  $request->maltooltip,
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'components_id'  =>  5,
                            'iconclass'      =>  $request->icon,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } 
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function aboutportaldestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function aboutportalstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',5)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // About Portal(end) //


 /* Contact Us */


    public function contactuslist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',6)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.contactuslist',compact('listdata'));
    }

   
       public function contactusstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',6)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  6,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }  */  

         }    
        
    }

    public function contactusedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function contactusupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',6)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  6,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function contactusdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function contactusstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',6)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Contact us(end) //

    /* Archive policy */


    public function archivepolicylist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',7)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.archivepolicylist',compact('listdata'));
    }

   
       public function archivepolicystore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',7)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  7,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function archivepolicyedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function archivepolicyupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',7)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  7,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function archivepolicydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function archivepolicystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',7)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Archive Policy(end) //


/* Support centers */


    public function supportcenterlist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->where('components_id',8)
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.supportcenterlist',compact('listdata'));
    }

   
       public function supportcenterstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',8)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  8,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }*/    

         }    
        
    }

    public function supportcenteredit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function supportcenterupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
        $chkrows= Componentarticle::where('components_id',8)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
              
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  8,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function supportcenterdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function supportcenterstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',8)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Support centers(end) //

        /* HELP */


    public function helplist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',9)
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.helplist',compact('listdata'));
    }

   
       public function helpstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',9)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  9,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function helpedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function helpupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',9)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  9,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function helpdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function helpstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',9)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Help(end) //

/*  Guidelines  */

public function guidelinelist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
            ->where('components_id',10)
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.guidelinelist',compact('listdata'));
    }

   
       public function guidelinestore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',10)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  10,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function guidelineedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function guidelineupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',10)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  10,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function guidelinedestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function guidelinestatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',10)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


/*  Guidelines end */


/*  Serviceinfo  */


public function serviceinfolist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',11)
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.serviceinfolist',compact('listdata'));
    }

   
       public function serviceinfostore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
          /*  $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',11)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  11,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }    
*/
         }    
        
    }

    public function serviceinfoedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function serviceinfoupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',11)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  11,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function serviceinfodestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function serviceinfostatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',11)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


/*  serviceinfo end */

/*  Address with Map */


public function addresswithmaplist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',12)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.addresswithmaplist',compact('listdata'));
    }

   
       public function addresswithmapstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2',
            'maplink'=>'required'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',12)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  12,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'maplinks' 		 =>  $request->maplink,
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }  */  

         }    
        
    }

    public function addresswithmapedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function addresswithmapupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2',
            'maplink'=>'required'
        
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',12)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  12,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'maplinks' 		 =>  $request->maplink,
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function addresswithmapdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function addresswithmapstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',12)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Address with Map end */

/*  Site compatibility info */

public function sitecompinfolist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',13)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.sitecompinfolist',compact('listdata'));
    }

   
       public function sitecompinfostore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',13)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  13,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }    
*/
         }    
        
    }

    public function sitecompinfoedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function sitecompinfoupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',13)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  13,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function sitecompinfodestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function sitecompinfostatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',13)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Site compatibility info end */


/*  Digital info */

public function digitalinfolist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',14)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.digitalinfolist',compact('listdata'));
    }

   
       public function digitalinfostore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',14)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  14,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }  */  

         }    
        
    }

    public function digitalinfoedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function digitalinfoupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',14)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  14,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function digitalinfodestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function digitalinfostatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',14)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Digital info end */

/*  Copyright Policy */

public function copyrightpolicylist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',15)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.copyrightpolicylist',compact('listdata'));
    }

   
       public function copyrightpolicystore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',15)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  15,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function copyrightpolicyedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function copyrightpolicyupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',15)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  15,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function copyrightpolicydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function copyrightpolicystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',15)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Copyright Policy end */

/*  Hyperlink Policy */

public function hyperlinkpolicylist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',16)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.hyperlinkpolicylist',compact('listdata'));
    }

   
       public function hyperlinkpolicystore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
          /*  $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',16)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  16,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function hyperlinkpolicyedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function hyperlinkpolicyupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',16)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  16,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function hyperlinkpolicydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function hyperlinkpolicystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',16)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Hyperlink Policy end */


/*  Privacy Policy */

public function privacypolicylist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',17)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.privacypolicylist',compact('listdata'));
    }

   
       public function privacypolicystore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
          /*  $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',17)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  17,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function privacypolicyedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function privacypolicyupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',17)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  17,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function privacypolicydestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function privacypolicystatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',17)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Privacy Policy end */

/*  Terms and Condition */

public function termsandconditionlist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',18)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.termsandconditionlist',compact('listdata'));
    }

   
       public function termsandconditionstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',18)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  18,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function termsandconditionedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function termsandconditionupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',18)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  18,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function termsandconditiondestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function termsandconditionstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',18)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }

/*  Terms and Condition end */

/*  Department Introduction */

public function deptintrolist(Request $request)
    {   $uid = Auth::user()->id;
           $listdata = DB::table('deptintroductions')
            ->select('id','entitle','maltitle','endesg1','endesg2','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.deptintrolist',compact('listdata'));
    }

public function deptintrostore(Request $request)
    {
        $request->validate([
            'image1'        =>  'required|mimes:jpg,jpeg,png|max:1100',
            'image2'        =>  'required|mimes:jpg,jpeg,png|max:1100',
            'name1'         =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'name2'         =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'alttext1'      =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'alttext2'      =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname1'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'malname2'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'desgn1'        =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'desgn2'        =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maldesgn1'     =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'maldesgn2'     =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip'     =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'    =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entitle'       =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'    =>  'required|max:50|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'   =>  'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'       =>  'required|max:200|min:3',
            'malbrief'      =>  'required|max:500|min:3',
            'encontent'     =>  'required|max:1000|min:3',
            'malcontent'    =>  'required|max:1000|min:3',
            'icon'          =>  'required|max:20|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Deptintroduction::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->homepagestatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  

                        $date = date('dmYH:i:s');
                        $image1 = 'user1'.$date.'.'.$request->image1->extension();  
                        $request->image1->move(public_path('Departmentuser'), $image1);
                         $image2 = 'user2'.$date.'.'.$request->image2->extension();  
                        $request->image2->move(public_path('Departmentuser'), $image2);

                    if(Auth::user()->usertypes_id==4){
                        $resultsave = new Deptintroduction([
                        'file1'          =>  $image1,
                        'alt1'           =>  $request->alttext1,
                        'enuser1'        =>  $request->name1,
                        'maluser1'       =>  $request->malname1,
                        'endesg1'        =>  $request->desgn1,
                        'maldesg1'       =>  $request->maldesgn1,
                        'file2'          =>  $image2,
                        'alt2'           =>  $request->alttext2,
                        'enuser2'        =>  $request->name2,
                        'maluser2'       =>  $request->malname2,
                        'endesg2'        =>  $request->desgn2,
                        'maldesg2'       =>  $request->maldesgn1,
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,                      
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Deptintroduction([
                        'file1'          =>  $image1,
                        'alt1'           =>  $request->alttext1,
                        'enuser1'        =>  $request->name1,
                        'maluser1'       =>  $request->malname1,
                        'endesg1'        =>  $request->desgn1,
                        'maldesg1'       =>  $request->maldesgn1,
                        'file2'          =>  $image2,
                        'alt2'           =>  $request->alttext2,
                        'enuser2'        =>  $request->name2,
                        'maluser2'       =>  $request->malname2,
                        'endesg2'        =>  $request->desgn2,
                        'maldesg2'       =>  $request->maldesgn1,
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,                      
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Deptintroduction([
                        'file1'          =>  $image1,
                        'alt1'           =>  $request->alttext1,
                        'enuser1'        =>  $request->name1,
                        'maluser1'       =>  $request->malname1,
                        'endesg1'        =>  $request->desgn1,
                        'maldesg1'       =>  $request->maldesgn1,
                        'file2'          =>  $image2,
                        'alt2'           =>  $request->alttext2,
                        'enuser2'        =>  $request->name2,
                        'maluser2'       =>  $request->malname2,
                        'endesg2'        =>  $request->desgn2,
                        'maldesg2'       =>  $request->maldesgn1,
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'enbrief'        =>  $request->enbrief,
                        'malbrief'       =>  $request->malbrief,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,                      
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'contributor_status'  =>  1,
                        'contributor_userid'  =>  Auth::user()->id,
                        'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    } 
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one department with same name exists.']);
            }*/    

         }    
        
    }


public function deptintroedit(Request $request, $id)
    {
        if($request->ajax())
        {
            
            $resultdata = Deptintroduction::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
            return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The About portal is Locked, so cannot be edited.']);
            }
        }

    }

    public function deptintroupdate(Request $request)
    {
        $request->validate([
            'image1'        =>  'sometimes|nullable|mimes:jpg,jpeg,png|max:1100',
            'image2'        =>  'sometimes|nullable|mimes:jpg,jpeg,png|max:1100',
            'name1'         =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'name2'         =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'alttext1'      =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'alttext2'      =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malname1'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'malname2'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'desgn1'        =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'desgn2'        =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maldesgn1'     =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'maldesgn2'     =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entooltip'     =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'    =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entitle'       =>  'required|min:3|max:50|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'      =>  'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'    =>  'required|max:50|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'   =>  'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'       =>  'required|max:200|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malbrief'      =>  'required|max:500|min:3',
            'encontent'     =>  'required|max:1000|min:3',
            'malcontent'    =>  'required|max:1000|min:3',
            'icon'          =>  'required|max:20|min:2'

        ]);


        if($request->ajax())
        {
           

             $chkrows= Deptintroduction::where('enuser1',$request->name1)->exists() ? 1 : 0;
            if($chkrows==0)
            {


                        if(isset($request->homepagestatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  

                       

               if(isset($request->image1) && isset($request->image2))
                {
        
            
                    $date = date('dmYH:i:s');
                    $image1 = 'user1'.$date.'.'.$request->image1->extension();  
                    $request->image1->move(public_path('Departmentuser'), $image1);
                    $image2 = 'user2'.$date.'.'.$request->image2->extension();  
                    $request->image2->move(public_path('Departmentuser'), $image2);

                    if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                           $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                           $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'contributor_status'  =>  1,
                                'contributor_userid'  =>  Auth::user()->id,
                                'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } 
            
                 } 
                else
                {
                    if(isset($request->image1))               
                    {
        
            
                            $date = date('dmYH:i:s');
                            $image1 = 'user1'.$date.'.'.$request->image1->extension();  
                            $request->image1->move(public_path('Departmentuser'), $image1);

                           if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                                'file1'          =>  $image1,
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'contributor_status'  =>  1,
                                'contributor_userid'  =>  Auth::user()->id,
                                'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } 
            
                    } 
                    else if(isset($request->image2))
                    {
                            $date = date('dmYH:i:s');
                            $image2 = 'user2'.$date.'.'.$request->image2->extension();  
                            $request->image2->move(public_path('Departmentuser'), $image2);

                            if(Auth::user()->usertypes_id==4){
                                $form_data = array(
                                    
                                    'alt1'           =>  $request->alttext1,
                                    'enuser1'        =>  $request->name1,
                                    'maluser1'       =>  $request->malname1,
                                    'endesg1'        =>  $request->desgn1,
                                    'maldesg1'       =>  $request->maldesgn1,
                                    'file2'          =>  $image2,
                                    'alt2'           =>  $request->alttext2,
                                    'enuser2'        =>  $request->name2,
                                    'maluser2'       =>  $request->malname2,
                                    'endesg2'        =>  $request->desgn2,
                                    'maldesg2'       =>  $request->maldesgn1,
                                    'entooltip'      =>  $request->entooltip,
                                    'maltooltip'     =>  $request->maltooltip,
                                    'entitle'        =>  $request->entitle,
                                    'maltitle'       =>  $request->maltitle,
                                    'ensubtitle'     =>  $request->ensubtitle,
                                    'malsubtitle'    =>  $request->malsubtitle,
                                    'enbrief'        =>  $request->enbrief,
                                    'malbrief'       =>  $request->malbrief,
                                    'encontent'      =>  $request->encontent,
                                    'malcontent'     =>  $request->malcontent,                      
                                    'iconclass'      =>  $request->icon,
                                    'homepagestatus' =>  $dplystat,
                                    'approve_status'  =>  2,
                                    'approve_userid'  =>  Auth::user()->id,
                                    'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                    'users_id'       => Auth::user()->id
                                );
                            } else if(Auth::user()->usertypes_id==3){
                                $form_data = array(
                                    
                                    'alt1'           =>  $request->alttext1,
                                    'enuser1'        =>  $request->name1,
                                    'maluser1'       =>  $request->malname1,
                                    'endesg1'        =>  $request->desgn1,
                                    'maldesg1'       =>  $request->maldesgn1,
                                    'file2'          =>  $image2,
                                    'alt2'           =>  $request->alttext2,
                                    'enuser2'        =>  $request->name2,
                                    'maluser2'       =>  $request->malname2,
                                    'endesg2'        =>  $request->desgn2,
                                    'maldesg2'       =>  $request->maldesgn1,
                                    'entooltip'      =>  $request->entooltip,
                                    'maltooltip'     =>  $request->maltooltip,
                                    'entitle'        =>  $request->entitle,
                                    'maltitle'       =>  $request->maltitle,
                                    'ensubtitle'     =>  $request->ensubtitle,
                                    'malsubtitle'    =>  $request->malsubtitle,
                                    'enbrief'        =>  $request->enbrief,
                                    'malbrief'       =>  $request->malbrief,
                                    'encontent'      =>  $request->encontent,
                                    'malcontent'     =>  $request->malcontent,                      
                                    'iconclass'      =>  $request->icon,
                                    'homepagestatus' =>  $dplystat,
                                    'approve_status'  =>  2,
                                    'approve_userid'  =>  Auth::user()->id,
                                    'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                    'users_id'       => Auth::user()->id
                                );
                            } else if(Auth::user()->usertypes_id==5){
                                $form_data = array(
                                    
                                    'alt1'           =>  $request->alttext1,
                                    'enuser1'        =>  $request->name1,
                                    'maluser1'       =>  $request->malname1,
                                    'endesg1'        =>  $request->desgn1,
                                    'maldesg1'       =>  $request->maldesgn1,
                                    'file2'          =>  $image2,
                                    'alt2'           =>  $request->alttext2,
                                    'enuser2'        =>  $request->name2,
                                    'maluser2'       =>  $request->malname2,
                                    'endesg2'        =>  $request->desgn2,
                                    'maldesg2'       =>  $request->maldesgn1,
                                    'entooltip'      =>  $request->entooltip,
                                    'maltooltip'     =>  $request->maltooltip,
                                    'entitle'        =>  $request->entitle,
                                    'maltitle'       =>  $request->maltitle,
                                    'ensubtitle'     =>  $request->ensubtitle,
                                    'malsubtitle'    =>  $request->malsubtitle,
                                    'enbrief'        =>  $request->enbrief,
                                    'malbrief'       =>  $request->malbrief,
                                    'encontent'      =>  $request->encontent,
                                    'malcontent'     =>  $request->malcontent,                      
                                    'iconclass'      =>  $request->icon,
                                    'homepagestatus' =>  $dplystat,
                                    'contributor_status'  =>  1,
                                    'contributor_userid'  =>  Auth::user()->id,
                                    'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                                    'users_id'       => Auth::user()->id
                                );
                            }

                    }
                    else
                    {
                            if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                               
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                               
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'approve_status'  =>  2,
                                'approve_userid'  =>  Auth::user()->id,
                                'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                               
                                'alt1'           =>  $request->alttext1,
                                'enuser1'        =>  $request->name1,
                                'maluser1'       =>  $request->malname1,
                                'endesg1'        =>  $request->desgn1,
                                'maldesg1'       =>  $request->maldesgn1,
                                'file2'          =>  $image2,
                                'alt2'           =>  $request->alttext2,
                                'enuser2'        =>  $request->name2,
                                'maluser2'       =>  $request->malname2,
                                'endesg2'        =>  $request->desgn2,
                                'maldesg2'       =>  $request->maldesgn1,
                                'entooltip'      =>  $request->entooltip,
                                'maltooltip'     =>  $request->maltooltip,
                                'entitle'        =>  $request->entitle,
                                'maltitle'       =>  $request->maltitle,
                                'ensubtitle'     =>  $request->ensubtitle,
                                'malsubtitle'    =>  $request->malsubtitle,
                                'enbrief'        =>  $request->enbrief,
                                'malbrief'       =>  $request->malbrief,
                                'encontent'      =>  $request->encontent,
                                'malcontent'     =>  $request->malcontent,                      
                                'iconclass'      =>  $request->icon,
                                'homepagestatus' =>  $dplystat,
                                'contributor_status'  =>  1,
                                'contributor_userid'  =>  Auth::user()->id,
                                'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                                'users_id'       => Auth::user()->id
                            );
                        } 

                    }
                }    
                        
                    Deptintroduction::whereId($request->hidden_id)->update($form_data);
                    return response()->json(['success' => 'Data is successfully updated']);
         } 
         else 
         {
                return response()->json(['errors' => 'Already a Department with same name exists.']);
            
        }     
        
    }
}

    public function deptintrodestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Deptintroduction::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function deptintrostatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('deptintroductions')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('deptintroductions')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('deptintroductions')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


/*  Department Introduction end */

/*  FAQ */

 public function faqlist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('faqs')
            ->select('id','enquestion','enanswer','status')
             ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.faqlist',compact('listdata'));
    }

  

    public function faqstore(Request $request)
    {
        $input = $request->all();
        // dd($request->all());
        foreach ($request->get('faqcheck') as $key => $value) 
        {
            $validation['faqcheck.'.$key.'.enquestion'] = 'required|min:3|max:250|regex:/(^[-0-9A-Za-z\s ]+$)/';
            $validation['faqcheck.'.$key.'.malquestion'] = 'required|min:3|max:500|regex:/(^[\P{Malayalam}_.,]+$)/';
            $validation['faqcheck.'.$key.'.enanswer'] = 'required|min:3|max:250|regex:/(^[-0-9A-Za-z\s ]+$)/';
            $validation['faqcheck.'.$key.'.malanswer'] = 'required|min:3|max:500|regex:/(^[\P{Malayalam}_.,]+$)/';
        }
        $this->validate($request, $validation);

                   
            foreach ($request->get('faqcheck') as $key => $value) 
            {

               /* $chkrows= faq::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
                if($chkrows==0)
                {*/
                        $data['enquestion'] = $value['enquestion']; 
                        $data['malquestion'] = $value['malquestion'];
                        $data['enanswer'] = $value['enanswer']; 
                        $data['malanswer'] = $value['malanswer'];
                        $data['users_id'] = Auth::user()->id; //Here you should pass auth user id.
                        faq::create($data);

               /* } 
                else 
                {
                return redirect('siteadmin/faqlist')->with('errors' , 'Already an question with same name exists.');
                }   */

            }  

                return redirect('siteadmin/faqlist')->with('success', 'Data Added successfully.');
         
    }

    public function faqedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = faq::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function faqupdate(Request $request)
    {
        $request->validate([
            'enquestion'  =>'required|min:3|max:250|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malquestion'  =>'required|min:3|max:500|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enanswer'  =>'required|min:3|max:250|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malanswer'  =>'required|min:3|max:500|regex:/(^[\P{Malayalam}_.,]+$)/'
        ]);
        
            $chkrows= faq::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){
                $form_data = array(
                    'enquestion'   =>  $request->enquestion,
                    'malquestion'  =>  $request->malquestion,
                    'enanswer'     =>  $request->enanswer,
                    'malanswer'    =>  $request->malanswer,
                    'users_id'     =>  Auth::user()->id
                );
                faq::whereId($request->hidden_id)->update($form_data);
                return redirect('siteadmin/faqlist')->with('success','Data is successfully updated');
            } else {
                return redirect('siteadmin/faqlist')->with('errors' , 'Already an question with same name exists.');
            }    
        
        
    }

    public function faqdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            faq::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function faqstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('faqs')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('faqs')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('faqs')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }


/*  FAQ end */

/*  Service Link */
public function servicelinklist(Request $request)
    {
            $uid = Auth::user()->id;
           $listdata = DB::table('componentarticles')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status')
             ->where('components_id',19)
              ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.servicelinklist',compact('listdata'));
    }

   
       public function servicelinkstore(Request $request)
    {
        $request->validate([
            'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Componentarticle::where('entitle',$request->name)->where('components_id',19)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                  
                    $resultsave = new Componentarticle([
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  19,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                    ]);
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }  */  

         }    
        
    }

    public function servicelinkedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Componentarticle::find($id);
            return response()->json(['resultdata' => $resultdata]);
        }

    }

    public function servicelinkupdate(Request $request)
    {
        $request->validate([
           'entooltip' =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltooltip'     =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'icon'=>'required|max:150|min:2'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Componentarticle::where('components_id',19)->where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        
                        $form_data = array(
                        'entooltip'      =>  $request->entooltip,
                        'maltooltip'     =>  $request->maltooltip,
                        'entitle'        =>  $request->entitle,
                        'maltitle'       =>  $request->maltitle,
                        'ensubtitle'     =>  $request->ensubtitle,
                        'malsubtitle'    =>  $request->malsubtitle,
                        'encontent'      =>  $request->encontent,
                        'malcontent'     =>  $request->malcontent,
                        'components_id'  =>  19,
                        'iconclass'      =>  $request->icon,
                        'homepagestatus' =>  $dplystat,
                        'approve_status'  =>  2,
                        'approve_userid'  =>  Auth::user()->id,
                        'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                        'users_id'       => Auth::user()->id
                        );
                   
               
                Componentarticle::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function servicelinkdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Componentarticle::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function servicelinkstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('componentarticles')
                ->select('status')
                ->where('id',$id)
                ->where('components_id',19)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('componentarticles')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
/*  Service Link end */

  /* Short Alert */


    public function shortalertlist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('shortalerts')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.shortalertlist',compact('listdata'));
    }

   
    public function shortalertstore(Request $request)
    {
        $request->validate([
            
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3'


        ]);

        if($request->ajax())
        {
            /*$chkrows= Shortalert::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                    if(isset($request->displaystatus)){
                        $dplystat = 1;
                    } else {
                        $dplystat = 0;
                    }
                    if(Auth::user()->usertypes_id==4){
                        $resultsave = new Shortalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Shortalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Shortalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } 
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } */   

         }    
        
    }

    public function shortalertedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Shortalert::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The Shortalert is Locked, so cannot be edited.']);
            }
            
        }

    }

    public function shortalertupdate(Request $request)
    {
        $request->validate([
           
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Shortalert::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        }
                   
               
                Shortalert::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function shortalertdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Shortalert::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function shortalertstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('shortalerts')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('shortalerts')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('shortalerts')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Short Alert(end) //

     /* Long Alert */


    public function longalertlist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('longalerts')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.longalertlist',compact('listdata'));
    }

   
       public function longalertstore(Request $request)
    {
        $request->validate([
            
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'=>'required|max:100|min:3',
            'malbrief'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Longalert::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                 if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                    if(Auth::user()->usertypes_id==4){
                        $resultsave = new Longalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3){
                        $resultsave = new Longalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);

                    } else if(Auth::user()->usertypes_id==5){
                        $resultsave = new Longalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);

                    }
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
            /*} else {
                return response()->json(['errors' => 'Already one long alert with same name exists.']);
            } */   

         }    
        
    }

    public function longalertedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Longalert::find($id);
            $lockstatus = $resultdata->lock_status;
            if($lockstatus==0){
                return response()->json(['resultdata' => $resultdata]);
            } else {
                return response()->json(['error' => 'The Longalert is Locked, so cannot be edited.']);
            }
            
        }

    }

    public function longalertupdate(Request $request)
    {
        $request->validate([
           
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'=>'required|max:100|min:3',
            'malbrief'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Longalert::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                        if(Auth::user()->usertypes_id==4){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5){
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'homepagestatus' =>  $dplystat,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        }
                   
               
                Longalert::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one long alert with same name exists.']);
            } 

        }       
        
        
    }

    public function longalertdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Longalert::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function longalertstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('longalerts')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('longalerts')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('longalerts')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Long Alert(end) //

    /* Media Alert */


    public function mediaalertlist(Request $request)
    {
        $uid = Auth::user()->id;
           $listdata = DB::table('mediaalerts')
            ->select('id','entitle','maltitle','ensubtitle','malsubtitle','status','contributor_status','moderator_remarks','approve_remarks')
            ->where('users_id',$uid)
            ->get();
        

        return view('siteadmin.mediaalertlist',compact('listdata'));
    }

    public function mediaalertcreate(Request $request)
    {
        if($request->ajax())
        {              
            $filetype     = DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype  = DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();   
            return response()->json(['filetype' => $filetype,'contenttype'=>$contenttype]);
        }
    }

     public function filetypelist(Request $request, $id)
    {
        if($request->ajax())
        {
            $filetype       = DB::table('filetypes')->where('status',1)->where('contenttypes_id',$id)->orderBy('id','asc')->get();
            
            return response()->json(['filetype' => $filetype]);
        }
    }
   
       public function mediaalertstore(Request $request)
    {
        $request->validate([
            
            'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'=>'required|max:100|min:3',
            'malbrief'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required'


        ]);

        if($request->ajax())
        {
           /* $chkrows= Mediaalert::where('entitle',$request->name)->exists() ? 1 : 0;
            if($chkrows==0){*/
                    if(isset($request->displaystatus)){
                        $dplystat = 1;
                    } else {
                        $dplystat = 0;
                    }
                    $date = date('dmYH:i:s');
                    $imageName = 'media'.$date.'.'.$request->image->extension();  
                    $request->image->move(public_path('Mediaalert'), $imageName);
                          
                    if(Auth::user()->usertypes_id==4) {  
                        $resultsave = new Mediaalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==3) {
                        $resultsave = new Mediaalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    } else if(Auth::user()->usertypes_id==5) {
                        $resultsave = new Mediaalert([
                            
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                        ]);
                    }
                    
                    $resultsave->save();
                     return response()->json(['success' => 'Data Added successfully.']);
           /* } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            }    
*/
         }    
        
    }

    public function mediaalertedit(Request $request, $id)
    {
        if($request->ajax())
        {
            $resultdata = Mediaalert::find($id);
            $filetype     = DB::table('filetypes')->where('status',1)->orderBy('id','asc')->get();
            $contenttype  = DB::table('contenttypes')->where('status',1)->orderBy('id','asc')->get();  
            return response()->json(['resultdata' => $resultdata,'filetype' => $filetype,'contenttype'=>$contenttype]);
        }

    }

    public function mediaalertupdate(Request $request)
    {
        $request->validate([
           
           'entitle'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'maltitle'  =>'required|min:3|max:50|regex:/(^[\P{Malayalam}_.,]+$)/',
            'ensubtitle'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malsubtitle'=>'required|max:100|min:3|regex:/(^[\P{Malayalam}_.,]+$)/',
            'enbrief'=>'required|max:100|min:3|regex:/(^[-0-9A-Za-z\s ]+$)/',
            'malbrief'=>'required|max:100|min:3',
            'encontent'=>'required|max:1000|min:3',
            'malcontent'=>'required|max:1000|min:3',
            'image' => 'required|mimes:jpg,jpeg,png|max:1100',
            'alttext'   =>'required|min:3|max:20|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'size'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'duration'=>'required|max:50|min:2|regex:/(^[-0-9A-Za-z.\s ]+$)/',
            'filetypes_id'=>'required',
            'contenttypes_id'=>'required',
            'activities_id'=>'required'
        ]);

        if($request->ajax())
        {
        
            $chkrows= Mediaalert::where('id','!=',$request->hidden_id)->exists() ? 1 : 0;
            if($chkrows==0){


               
                        if(isset($request->displaystatus)){
                            $dplystat = 1;
                        } else {
                            $dplystat = 0;
                        }
                        
                         $date = date('dmYH:i:s');
                        $imageName = 'media'.$date.'.'.$request->image->extension();  
                        $request->image->move(public_path('Mediaalert'), $imageName);
                        if(Auth::user()->usertypes_id==4) {
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==3) {
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'approve_status'  =>  2,
                            'approve_userid'  =>  Auth::user()->id,
                            'approve_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        } else if(Auth::user()->usertypes_id==5) {
                            $form_data = array(
                            'entitle'        =>  $request->entitle,
                            'maltitle'       =>  $request->maltitle,
                            'ensubtitle'     =>  $request->ensubtitle,
                            'malsubtitle'    =>  $request->malsubtitle,
                            'enbrief'        =>  $request->enbrief,
                            'malbrief'       =>  $request->malbrief,
                            'encontent'      =>  $request->encontent,
                            'malcontent'     =>  $request->malcontent,
                            'alt'            =>  $request->malcontent,
                            'file'           =>  $imageName,
                            'size'           =>  $request->size,
                            'duration'       =>  $request->duration,
                            'homepagestatus' =>  $dplystat,
                            'filetypes_id'   =>  $request->filetypes_id,
                            'contenttypes_id'=>  $request->contenttypes_id,
                            'contributor_status'  =>  1,
                            'contributor_userid'  =>  Auth::user()->id,
                            'contributor_timestamp'  =>  date('Y-m-d H:i:s'),
                            'users_id'       => Auth::user()->id
                            );
                        }
                   
               
                Mediaalert::whereId($request->hidden_id)->update($form_data);
                return response()->json(['success' => 'Data updated successfully.']);
                
            } else {
                return response()->json(['errors' => 'Already one new with same name exists.']);
            } 

        }       
        
        
    }

    public function mediaalertdestroy(Request $request, $id)
    {
        if($request->ajax())
        {
            Mediaalert::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
    
    public function mediaalertstatus(Request $request, $id)
    {
        if($request->ajax())
        {
            $getstatus = DB::table('mediaalerts')
                ->select('status')
                ->where('id',$id)
                ->first();

            $status = $getstatus->status;
            if($status==1){
                $upd_status = array('status' => 2);
                DB::table('mediaalerts')->where('id',$id)->update($upd_status);
                 return response()->json(['success' => 'Data Updated successfully.']);
            }
            else{
                
                $upd_status = array('status' => 1);
                DB::table('mediaalerts')->where('id',$id)->update($upd_status);
                return response()->json(['success' => 'Data Updated successfully.']);
                
   

            } 
        }
        
    }
    
    
    // Media Alert(end) //



    /*   CONTROLLER  end */
}