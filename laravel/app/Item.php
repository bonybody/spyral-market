<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'id', 'name', 'price', 'text', 'seller_id', 'status', 'image', 'category_id', 'sub_category_id'
    ];

    public function item_image()
    {
        return $this->hasOne('App\Item_image');
    }

    public function item_tags()
    {
        return $this->hasMany('App\Item_tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

    public function sales_history() {
        return $this->hasOne('App\Sales_history');
    }
}
