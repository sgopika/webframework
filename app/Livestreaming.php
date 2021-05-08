<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class livestreaming extends Model
{
    protected $fillable = [
        'date','entitle','maltitle','url','users_id'	
    ];
}
