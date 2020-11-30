<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_tag extends Model
{
    //
    protected $fillable = [
        'item_id',
        'tag_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
