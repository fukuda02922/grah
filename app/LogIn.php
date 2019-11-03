<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogIn extends Model
{
    //
    protected $fillable = ['user_id', 'mail_ad', 'password', 'session_key',];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
