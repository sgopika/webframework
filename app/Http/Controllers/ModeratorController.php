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

 
class ModeratorController extends Controller
{
    public function moderatorhome(Request $request)
    {
    	return view('moderatordashboard');
    }

    public function contributeditems(Request $request, $val)
    {

    	return view('moderator.contributeditems',compact('val'));
    }

    public function contributedactivitieslist(Request $request, $val)
    {
    	if($val==1){
    		$listdata = Activity::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
    	} else{
    		$listdata = Activity::where('contributor_status',1)->where('moderator_status',2)->get();
    	} 
    	

    	return view('moderator.contributedactivitieslist',compact('listdata','val'));
    }

    public function contributedactverify(Request $request, $id)
    {
        if($request->ajax())
        {
        	$formdata = array(
        		'moderator_status' =>  1,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s')
        	);
            Activity::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedactupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
        	
            Activity::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedarticleslist(Request $request, $val)
    {
        if($val==1){
            $listdata = Article::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Article::where('contributor_status',1)->where('moderator_status',2)->get();
        }
        

        return view('moderator.contributedarticleslist',compact('listdata','val'));
    }

    public function contributedartverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Article::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedartupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Article::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedgallerieslist(Request $request, $val)
    {
        if($val==1){
            $listdata = Gallery::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Gallery::where('contributor_status',1)->where('moderator_status',2)->get();
        } 

        return view('moderator.contributedgallerieslist',compact('listdata','val'));
    }

    public function contributedgallverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Gallery::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedgallupdate(Request $request)
    {
        if($request->ajax())
        {
           $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Gallery::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributednewsletterlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Newsletter::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else {
            $listdata = Newsletter::where('contributor_status',1)->where('moderator_status',2)->get();
        }
        

        return view('moderator.contributednewsletterlist',compact('listdata','val'));
    }

    public function contributednewsverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Newsletter::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributednewsupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Newsletter::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedshortalertlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Shortalert::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Shortalert::where('contributor_status',1)->where('moderator_status',2)->get();
        } 
        

        return view('moderator.contributedshortalertlist',compact('listdata','val'));
    }

    public function contributedshortverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Shortalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedshortupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Shortalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedlongalertlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Longalert::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Longalert::where('contributor_status',1)->where('moderator_status',2)->get();
        } 
        

        return view('moderator.contributedlongalertlist',compact('listdata','val'));
    }

    public function contributedlongverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Longalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedlongupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Longalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedmediaalertlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Mediaalert::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Mediaalert::where('contributor_status',1)->where('moderator_status',2)->get();
        }

        return view('moderator.contributedmediaalertlist',compact('listdata','val'));
    }

    public function contributedmediaverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Mediaalert::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedmediaupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Mediaalert::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function contributedabtportallist(Request $request, $val)
    {
        if($val==1){
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->where('components_id',5)->get();
        } else {
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('components_id',5)->get();
        }
        

        return view('moderator.contributedabtportallist',compact('listdata','val'));
    }

    public function contributedabtportalverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedabtportalupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function contributedabtdeptlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->where('components_id',4)->get();
        } else {
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('components_id',4)->get();
        }
        

        return view('moderator.contributedabtdeptlist',compact('listdata','val'));
    }

    public function contributedabtdeptverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedabtdeptupdate(Request $request)
    {
        if($request->ajax())
        {
           $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributeddeptintrolist(Request $request, $val)
    {
        if($val==1){
            $listdata = Deptintroduction::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->get();
        } else{
            $listdata = Deptintroduction::where('contributor_status',1)->where('moderator_status',2)->get();
        }
        
        

        return view('moderator.contributeddeptintrolist',compact('listdata','val'));
    }

    public function contributeddeptintroverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Deptintroduction::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributeddeptintroupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Deptintroduction::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedwhatsnewlist(Request $request, $val)
    {
        if($val==1){
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',0)->orWhere('moderator_status',1)->where('approve_status',0)->where('components_id',3)->get();
        } else{
            $listdata = Componentarticle::where('contributor_status',1)->where('moderator_status',2)->where('components_id',3)->get();
        } 
        

        return view('moderator.contributedwhatsnewlist',compact('listdata','val'));
    }

    public function contributedwhatsnewverify(Request $request, $id)
    {
        if($request->ajax())
        {
            $formdata = array(
                'moderator_status' =>  1,
                'moderator_userid' =>  Auth::user()->id,
                'moderator_timestamp' =>  date('Y-m-d H:i:s')
            );
            Componentarticle::whereId($id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function contributedwhatsnewupdate(Request $request)
    {
        if($request->ajax())
        {
            $statusid = $request->status_id;
            if($statusid==1){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'moderator_status' =>  2,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' =>  1
        		);
            }else if($statusid==2){
                $formdata = array(
        		'moderator_remarks' =>  $request->moderator_remarks,
        		'contributor_status' => 2,
                'moderator_status' =>  0,
        		'moderator_userid' =>  Auth::user()->id,
        		'moderator_timestamp' =>  date('Y-m-d H:i:s'),
        		'lock_status' => 0
        		);
            }
            Componentarticle::whereId($request->hidden_id)->update($formdata);
        }
        return response()->json(['success' => 'Data is successfully updated']);
    }

}
