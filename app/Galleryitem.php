<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galleryitem extends Model
{
    protected $fillable = [
        'poster','alt','galleries_id','entooltip','maltooltip','users_id'	
    ];
}
