<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\Http\Resources\UserLocationResource;
use App\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function friends()
    {
        return response()->json(["data"=>$this->authUser()->friends]);

    }

    public function friendsLocation()
    {
        return UserLocationResource::collection($this->authUser()->friends);
    }

    public function removeFriend($friend)
    {
        $this->authUser()->myFriendships->where("user_2_id", $friend)->delete();
        $this->authUser()->friendshipsWithMe->where("user_1_id", $friend)->delete();
    }

    public function friendrequests()
    {
        return response()->json(["data"=>array_values($this->authUser()->friendshipsWithMe->where("status", 0)->toArray())]);
    }
    public function pendingfriendrequests()
    {
        return response()->json(["data"=>array_values($this->authUser()->myfriendships->where("status", 0)->toArray())]);
    }

    public function requestFriend($friend)
    {
        $friendship = new Friendship();
        $friendship->status = 0;
        $friendship->user_1_id = $this->authUser()->id;
        $friendship->user_2_id = $friend;

        $friendship->save();
    }

    public function acceptFriend($friend)
    {
        $friendReq = $this->authUser()->friendshipsWithMe->where("status", 0)->where("user_1_id","=",$friend)->first();
        if ($friendReq==null||$friendReq->status >= 1) {
            return response()->json(['error' => 'already accepted'], 400);
        }
        $friendReq->status = 1;
        $friendReq->update();
    }
}
