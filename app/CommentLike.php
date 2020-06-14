<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommentLike extends Pivot
{
    public function comment(){
        return $this->belongsTo('App\Comment');
    }
}
