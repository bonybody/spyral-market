<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_history extends Model
{
    protected $fillable = [
        'item_id', 'buyer_id', 'seller_id',
        'status'
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
