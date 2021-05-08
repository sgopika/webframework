<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
      protected $fillable = [ 'iconclass', 'colorclass', 'entitle', 'maltitle', 'entooltip', 'maltooltip', 'components_id','menulinktypes_id', 'users_id'
      	];

}
