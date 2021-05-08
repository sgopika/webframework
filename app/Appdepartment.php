<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appdepartment extends Model
{
    protected $fillable = [
        'deptcategories_id','departments_id','entitle','maltitle','enabout','malabout','enstructure','malstructure','encontact','malcontact','enrelatedlinks','malrelatedlinks','enservices','malservices','contributor_status','contributor_userid','contributor_timestamp','moderator_status', 'moderator_userid', 'moderator_timestamp', 'approve_status', 'approve_userid', 'approve_timestamp','users_id'	
    ];
}
