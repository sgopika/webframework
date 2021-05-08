<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componentpermission extends Model
{
     protected $fillable = [
        'components_id','usertypes_id','users_id'
    ];
}
