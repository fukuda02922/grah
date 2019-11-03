<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string image_url
 * @property mixed title
 * @property mixed body
 * @property mixed mem_no
 */
class Post extends Model
{
    //
    protected $fillable = ['title', 'body', 'image_url', 'mem_no', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
