<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communicationattachment extends Model
{
    protected $fillable = [
        'communications_id','file','users_id'
    ];
}
