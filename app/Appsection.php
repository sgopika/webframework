<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appsection extends Model
{
    protected $fillable = [
        'appdepartments_id','ensectionname','malsectionname','ensectiondetails','malsectiondetails','contributor_status','contributor_userid','contributor_timestamp','moderator_status', 'moderator_userid', 'moderator_timestamp', 'approve_status', 'approve_userid', 'approve_timestamp','users_id'	
    ];
}
