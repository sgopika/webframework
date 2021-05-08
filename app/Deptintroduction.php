<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deptintroduction extends Model
{
    
     protected $fillable = [
        'file1','alt1','enuser1','maluser1','endesg1','maldesg1','file2','alt2','enuser2','maluser2','endesg2','maldesg2','entooltip','maltooltip','entitle','maltitle','ensubtitle','malsubtitle','enbrief','malbrief','encontent','malcontent','homepagestatus','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'
    ];
}
