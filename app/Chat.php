<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function user(){
        return $this->belongsToMany('App\User',"chat_participant","user_id","chat_id");
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
}
