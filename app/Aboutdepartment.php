<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutdepartment extends Model
{
   protected $fillable = [
        'entooltip','maltooltip','entitle','maltitle','ensubtitle','malsubtitle','encontent','malcontent','components_id','iconclass','homepagestatus','users_id'	
    ];
}
