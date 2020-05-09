<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function user(){
        return $this->belongsToMany('App\User')->using('App\ChatParticipant');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
}
