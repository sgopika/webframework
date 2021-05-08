<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name','malname','offices_id','departments_id','designations_id','staffcategories_id','hierarchies_id','mobile','email','joindate','poster','alt','users_id'	
    ];
}
