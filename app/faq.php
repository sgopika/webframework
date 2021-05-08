<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    protected $fillable = [
        'enquestion','malquestion','enanswer','malanswer','users_id'
    ];
}
