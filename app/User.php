<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            "name"=>$this->name,
            "role"=>$this->role,
            ];
    }
}
