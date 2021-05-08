<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'deptcategories_id','entitle','maltitle','users_id'
    ];
}
