<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $with = 'replies';

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
        return $this->belongsToMany('App\User',"comment_like","user_id","comment_id")
            ->using('App\CommentLike')->withPivot("liked");
    }


}
