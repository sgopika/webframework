<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footerlink extends Model
{
    protected $fillable = [ 'url','iconclass','entitle', 'maltitle', 'entooltip', 'maltooltip','users_id'
      	];
}
