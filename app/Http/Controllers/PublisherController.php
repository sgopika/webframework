<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Activity;
use App\Article;
use App\Gallery;
use App\Newsletter;
use App\Shortalert;
use App\Longalert;
use App\Mediaalert;
use App\Componentarticle;
use App\Deptintroduction;
use Auth;

class PublisherController extends Controller
{
    public function publisherhome(Request $request)
    {
    	return view('publisherdashboard');
    }

    public function moderateditems(Request $request, $val)
    {
    	return view('publisher.moderateditems',compact('val'));
    }

    public function moderatedactivitieslist(Request $request, $val)
    {
        if($val==1){
    	   $listdata = Activity::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else {
            $listdata = Activity::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

    	return view('publisher.moderatedactivitieslist',compact('listdata','val'));
    }

    public function moderatedactapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Activity::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedactupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
                'approve_remarks' =>  $request->approve_remarks,
                'approve_status' =>  2,
				'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s'),
                'lock_status' =>  1
            );
				
            }else if($statusid==2){
               $formdata = array(
                'approve_remarks' =>  $request->approve_remarks,
				'contributor_status' => 2,
                'approve_status' =>  0,
				'moderator_status' =>  0,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s'),
                'lock_status' =>  0
            );
            }
            
            Activity::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedarticleslist(Request $request, $val)
    {
        if($val==1){
           $listdata = Article::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else{
            $listdata = Article::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        }

        return view('publisher.moderatedarticleslist',compact('listdata','val'));
    }

    public function moderatedartapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Article::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedartupdate(Request $request)
    {
        if($request->ajax())
        {
				$statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Article::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedgallerylist(Request $request, $val)
    {
        if($val==1){
           $listdata = Gallery::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else{
            $listdata = Gallery::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

        return view('publisher.moderatedgallerylist',compact('listdata','val'));
    }

    public function moderatedgallapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Gallery::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedgallupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Gallery::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatednewsletterlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Newsletter::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else {
            $listdata = Newsletter::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        }

        return view('publisher.moderatednewsletterlist',compact('listdata','val'));
    }

    public function moderatednewsapprove(Request $request, $id)
    {
        if($request->ajax())
        {

            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Newsletter::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatednewsupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Newsletter::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function moderatedshortalertlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Shortalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else{
            $listdata = Shortalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

        return view('publisher.moderatedshortalertlist',compact('listdata','val'));
    }

    public function moderatedshortapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Shortalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedshortupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Shortalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedlongalertlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Longalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else{
            $listdata = Longalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

        return view('publisher.moderatedlongalertlist',compact('listdata','val'));
    }

    public function moderatedlongapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Longalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedlongupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Longalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function moderatedmediaalertlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Mediaalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else {
            $listdata = Mediaalert::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

        return view('publisher.moderatedmediaalertlist',compact('listdata','val'));
    }

    public function moderatedmediaapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Mediaalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedmediaupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Mediaalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedabtportallist(Request $request, $val)
    {
        if($val==1){
           $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->where('components_id',5)->get();
        } else {
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->where('components_id',5)->get();
        } 

        return view('publisher.moderatedabtportallist',compact('listdata','val'));
    }

    public function moderatedabtportalapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedabtportalupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedabtdeptlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->where('components_id',4)->get();
        } else{
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->where('components_id',4)->get();
        }

        return view('publisher.moderatedabtdeptlist',compact('listdata','val'));
    }

    public function moderatedabtdeptapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedabtdeptupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderateddeptintrolist(Request $request, $val)
    {
        if($val==1){
           $listdata = Deptintroduction::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->get();
        } else{
            $listdata = Deptintroduction::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->get();
        } 

        return view('publisher.moderateddeptintrolist',compact('listdata','val'));
    }

    public function moderateddeptintroapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Deptintroduction::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderateddeptintroupdate(Request $request)
    {
        if($request->ajax())
        {
           $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Deptintroduction::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedwhatsnewlist(Request $request, $val)
    {
        if($val==1){
           $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',0)->orWhere('approve_status',1)->where('components_id',3)->get();
        } else{
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('approve_status',2)->where('components_id',3)->get();
        }

        return view('publisher.moderatedwhatsnewlist',compact('listdata','val'));
    }

    public function moderatedwhatsnewapprove(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'approve_status' =>  1,
                'approve_userid' =>  Auth::user()->id,
                'approve_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function moderatedwhatsnewupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
				if($statusid==1){
					$formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'approve_status' =>  2,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  1
				);
					
				}else if($statusid==2){
				   $formdata = array(
					'approve_remarks' =>  $request->approve_remarks,
					'contributor_status' => 2,
                	'approve_status' =>  0,
					'moderator_status' =>  0,
					'approve_userid' =>  Auth::user()->id,
					'approve_timestamp' =>  date('Y-m-d H:i:s'),
					'lock_status' =>  0
				);
				}
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }
}
