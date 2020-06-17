<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with = ["likes","user"];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getAuthorAttribute()
    {
        return $this->user()->name;
    }


    public function likes()
    {
        return $this->belongsToMany('App\User', "post_like")->withPivot("liked");
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            foreach ($post->comments as $comments) {
                $comments->delete();
            }
        });
    }

}
