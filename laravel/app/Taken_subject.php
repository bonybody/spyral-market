<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taken_subject extends Model
{
    //
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
