<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Mediaalert extends Model
{
    protected $fillable = [
        'entitle','maltitle','ensubtitle','malsubtitle','enbrief','malbrief','encontent','malcontent','poster','alt','file','size','duration','homepagestatus','filetypes_id','contenttypes_id','contributor_status','contributor_userid','contributor_timestamp','moderator_remarks','moderator_status','moderator_userid','moderator_timestamp','lock_status','approve_status','approve_userid','approve_timestamp','users_id'	
    ];
}
