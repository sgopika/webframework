<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
       'file','alt', 'entitle','maltitle','ensubtitle','malsubtitle','iconclass','users_id'
    ];
}
