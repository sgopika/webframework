<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicelink extends Model
{
     protected $fillable = [
        'entitle','order','users_id'
    ];
}
