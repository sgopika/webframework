<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocampaign extends Model
{
    protected $fillable = [
        'file','alt','entitle','maltitle','ensubtitle','malsubtitle','encontent','malcontent','endesc','maldesc','size','duration','filetypes_id','contenttypes_id','displaystatus','icon','users_id'	
    ];
}
