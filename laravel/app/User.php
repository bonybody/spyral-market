<?php

namespace App;

use App\Notifications\UserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'course_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    // user_detailsテーブルの取得
    public function user_detail()
    {
        return $this->hasOne('App\User_detail');
    }

    public function taken_subjects()
    {
        return $this->hasMany('App\Taken_subject');
    }

    public function items() {
        return $this->hasMany('App\Item', 'seller_id');
    }

    public function followers() {
        return $this->hasMany('App\Follow', 'followed_user_id');
    }
}
