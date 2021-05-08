<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Longalert extends Model
{
    protected $fillable = [
        'entitle','maltitle','ensubtitle','malsubtitle','enbrief','malbrief','encontent','malcontent','homepagestatus','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'	
    ];
}
