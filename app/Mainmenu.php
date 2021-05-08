<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{
	
     protected $fillable = [ 'file','iconclass','entitle', 'maltitle', 'entooltip', 'maltooltip','menulinktypes_id','pointto','users_id'
      	];
}
