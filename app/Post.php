<?php

namespace App;

class Post extends Votable
{

    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    protected $appends = ['content_preview', 'rating', 'voted'];

    protected $preview_length = 300;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function getContentPreviewAttribute()
    {
        if (mb_strlen($this->content, 'UTF-8') <= $this->preview_length) {
            return $this->content;
        }
        $preview_string = mb_substr($this->content, 0, $this->preview_length, 'UTF-8');
        return mb_substr($preview_string, 0, mb_strripos($preview_string, ' ', 0, 'UTF-8'), 'UTF-8') . '...';
    }
}
