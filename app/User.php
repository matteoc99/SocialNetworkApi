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
        'show_location' => 'boolean',
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
        return $this->friendsWithMe()->getResults()->merge($this->myFriends()->getResults())->where("pivot.status",">",0);
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
    public function postLikes()
    {
        return $this->belongsToMany('App\Post',"post_like")->withPivot("liked");

    }
    public function commentLikes()
    {
        return $this->belongsToMany('App\Comment',"comment_like")->withPivot("liked");

    }


    public function chats(){
        return $this->belongsToMany('App\Chat',"chat_participant","chat_id","user_id");
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            "name"=>$this->name,
            "show_location "=>$this->show_location,
            "role"=>$this->role,
            ];
    }




    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            foreach ($user->posts as $post) {
                $post->delete();
            }
            foreach ($user->chats as $chat) {
                $chat->delete();
            }
            $user->myFriendships()->delete();
            $user->friendshipsWithMe()->delete();
            $user->myNotifications()->delete();
            $user->messages()->delete();
        });
    }
}
