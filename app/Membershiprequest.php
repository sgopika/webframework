<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membershiprequest extends Model
{
    protected $fillable = [
        'name','offices_id','departments_id','designations_id','mobile','email','users_id'	
    ];
}
