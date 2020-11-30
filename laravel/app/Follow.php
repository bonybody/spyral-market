<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';
    protected $fillable = [
        'user_id', 'followed_user_id', 'created_at', 'updated_at'
    ];
}
