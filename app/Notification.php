<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * Notification setup.
     */
    public function setup($for_user,$title,$payload,$type,$from_id)
    {
        $this->user_id =$for_user;
        $this->title =$title;
        $this->payload =$payload;
        $this->type =$type;
        $this->from_id =$from_id;

        $this->sendNotification();
        $this->save();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }




    public function sendNotification(){
        error_log($this);
    }
}
