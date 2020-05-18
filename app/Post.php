<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function getAuthorAttribute(){
        return $this->user()->name;
    }

    public function likes()
    {
        return $this->belongsToMany('App\User',"post_like","user_id","post_id")
            ->using('App\PostLike')->withPivot("liked");
    }
}
