<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    //
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
