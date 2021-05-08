<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newslettervolume extends Model
{
    protected $fillable = [
        'poster','alt','entitle','maltitle','entooltip','maltooltip','newsletters_id','releasedate','size','duration','filetypes_id','contenttypes_id','archivepolicies_id','users_id'	
    ];
}
