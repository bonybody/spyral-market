<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registered_tag extends Model
{
    //
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
