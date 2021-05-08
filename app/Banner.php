<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'file','alt','entitle','maltitle','ensubtitle','malsubtitle','users_id'	
    ];
}
