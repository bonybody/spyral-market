<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function taken_subject()
    {
        return $this->hasMany('App\Taken_subject');
    }

}
