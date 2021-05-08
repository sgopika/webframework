<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filetype extends Model
{
     protected $fillable = [
        'entitle','maltitle','contenttypes_id','users_id'
    ];
}
