<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    protected $fillable = [ 'url','iconclass','entitle', 'maltitle', 'entooltip', 'maltooltip','users_id'
      	];
}
