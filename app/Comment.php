<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
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
