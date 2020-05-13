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
        'isAdmin' => 'boolean',
        'isEditor' => 'boolean',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function getIsAdminAttribute(){
        return $this->role->id == 3;
    }
    public function getIsEditorAttribute(){
        return $this->role->id >= 2;
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

    public function myNotifications(){
        return $this->hasMany('App\Notification');
    }
    public function unreadNotifications(){
        return $this->myNotifications()->where("read","=","0")->get();
    }
    public function notificationEndpoint(){
        return $this->hasMany('App\NotificationEndpoint');
    }
    public function userActions(){
        return $this->hasMany('App\UserAction');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function chats(){
        return $this->belongsToMany('App\Chat')->using('App\ChatParticipant');
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
