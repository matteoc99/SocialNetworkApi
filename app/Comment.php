<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $with = ['likes','replies',"user"];

    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies() {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function getAuthorAttribute(){
        return $this->user()->name;
    }

    public function likes()
    {
        return $this->belongsToMany('App\User',"comment_like")->withPivot("liked");

    }
    public function commentlikes()
    {
        return $this->hasMany('App\CommentLike');

    }
    public static function boot() {
        parent::boot();

        static::deleting(function($comment) {
            $comment->likes()->delete();
            $comment->replies()->delete();
        });
    }

}
