<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'poster','alt','date','entitle','maltitle','entooltip','maltooltip','activities_id','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'	
    ];
}
