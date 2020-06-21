<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostLike extends Pivot
{
    protected $primaryKey = ['user_id','post_id'];
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
