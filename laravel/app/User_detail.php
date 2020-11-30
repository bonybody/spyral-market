<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    protected $fillable = [
        'user_id', 'display_name', 'message', 'url', 'image', 'created_at', 'updated_at',
    ];
    protected $primaryKey = 'user_id';

}
