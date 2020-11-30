<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_room extends Model
{
    protected $fillable = [
        'item_id', 'seller_id', 'buyer_id', 'created_at', 'updated_at'
    ];

    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id');
    }
    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

}
