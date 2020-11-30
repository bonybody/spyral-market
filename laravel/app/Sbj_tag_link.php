<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sbj_tag_link extends Model
{
    //
    protected $table = 'sbj_tag_links';
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
