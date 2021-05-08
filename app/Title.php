<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
     protected $fillable = [
        'entitle','maltitle','ensubtitle','malsubtitle','users_id'
    ];
}
