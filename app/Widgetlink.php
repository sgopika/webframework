<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widgetlink extends Model
{
    protected $fillable = [
        'file','alt','entooltip','maltooltip','entitle','maltitle','ensubtitle','malsubtitle','encontent','malcontent','homepagestatus','users_id'	
    ];
}
