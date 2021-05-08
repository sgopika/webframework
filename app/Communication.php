<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $fillable = [
        'communicationtypes_id','communicationto','subject','content','users_id'
    ];
}
