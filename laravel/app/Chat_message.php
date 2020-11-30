<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model
{
    protected $fillable = [
        'room_id', 'sender_id', 'text'
    ];
}
