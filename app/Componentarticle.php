<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componentarticle extends Model
{
    protected $fillable = [
        'entooltip','maltooltip','entitle','maltitle','ensubtitle','malsubtitle','encontent','malcontent','components_id','iconclass','homepagestatus','maplinks','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'	
    ];
}
