<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'poster','alt','entooltip','maltooltip','entitle','maltitle','ensubtitle','malsubtitle','enauthor','malauthor','enbrief','malbrief','encontent','malcontent','startdate','enddate','homepagestatus','activitytypes_id','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'	
    ];
}
