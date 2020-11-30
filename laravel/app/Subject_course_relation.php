<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_course_relation extends Model
{
    //
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
