<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = ['user_id', 'mail_ad', 'password', 'profile_url',];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log_ins()
    {
        return $this->hasMany('App\LogIn');
    }
}
