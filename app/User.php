<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    /**
     * User constructor.
     */
    public function __construct()
    {
        //defaults
        $this->role_id=1;
        $this->post_visibility=1;
        $this->show_location=1;
        $this->online=0;
    }

    public function role(){
        return $this->belongsTo('App\Role');

    }
    public function myFriends()
    {
        return $this->belongsToMany('App\User',"friendship","user_2_id","user_1_id")
            ->using('App\Friendship')->withPivot("status");
    }
    public function friendsWithMe()
    {
        return $this->belongsToMany('App\User',"friendship","user_1_id","user_2_id")
            ->using('App\Friendship')->withPivot("status");
    }

    public function getFriendsAttribute(){
        return $this->friendsWithMe()->getResults()->merge($this->myFriends()->getResults());

    }

    public function myFriendships(){
        return $this->hasMany('App\Friendship',"user_1_id","id");
    }
    public function friendshipsWithMe(){
        return $this->hasMany('App\Friendship',"user_2_id","id");
    }




}
