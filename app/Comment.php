<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }

    public function replyTo()
    {
        return $this->belongsTo('App\Comments', 'parent_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }

}
