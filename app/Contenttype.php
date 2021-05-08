<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenttype extends Model
{
     protected $fillable = [
        'entitle','maltitle','users_id'
    ];
}
