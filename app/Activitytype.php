<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytype extends Model
{
   protected $fillable = [
        'entitle','maltitle','users_id'
    ];
}
