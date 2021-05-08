<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activityupload extends Model
{
    protected $fillable = [
        'file','alt','entitle','maltitle','size','duration','filetypes_id','contenttypes_id','activities_id','users_id'	
    ];
}
