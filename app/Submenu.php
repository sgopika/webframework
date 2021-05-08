<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $fillable = [ 'file','iconclass','entitle', 'maltitle', 'entooltip', 'maltooltip','parentmenu','menulinktypes_id','pointto','users_id'
      	];
}
