<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'file','alt','entitle','maltitle','enaddress','maladdress','phonenumbers','map','email','users_id'	
    ];
}
