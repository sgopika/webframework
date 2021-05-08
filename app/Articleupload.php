<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articleupload extends Model
{
   protected $fillable = [
        'file','alt','entitle','maltitle','size','duration','filetypes_id','contenttypes_id','articles_id','users_id'	
    ];
}
