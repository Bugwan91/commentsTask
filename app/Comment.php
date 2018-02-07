<?php

namespace App;

class Comment extends Votable
{

    protected $fillable = [
        'content', 'user_id', 'reply_to_id'
    ];

    protected $appends = ['rating', 'voted'];

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
        return $this->belongsTo('App\Comments', 'reply_to_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'reply_to_id', 'id');
    }

    public function parseAllReplies()
    {
        $comments = $this->replies;
        foreach ($comments as $comment) {
            $comment->user;
            $comment->parseAllReplies();
        }
    }

}
