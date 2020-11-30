<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['name'];
    public function sbj_tag_link()
    {
        return $this->hasMany('App\Sbj_tag_link');
    }
}
