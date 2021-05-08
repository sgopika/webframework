<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staffcommittee extends Model
{
    protected $fillable = [
        'hierarchies_id','staffs_id','committees_id','users_id'	
    ];
}
