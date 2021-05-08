<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'file','alt','entitle','maltitle','ensubtitle','malsubtitle','encontent','malcontent','endesc','maldesc','size','duration','filetypes_id','contenttypes_id','downloadtypes_id','archivepolicies_id','displaystatus','icon','users_id'	
    ];
}
