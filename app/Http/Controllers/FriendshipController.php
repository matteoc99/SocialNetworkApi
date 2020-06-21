<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\Http\Resources\UserLocationResource;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

/**
 * @group Friendships
 *
 * APIs for managing friendships
 */

class FriendshipController extends Controller
{

    /**
     *
     * List of Friends
     * @authenticated
     */
    public function friends()
    {
        return response()->json(["data"=>array_values($this->authUser()->friends->toArray())]);

    }

    /**
     * Location of Friends
     * @authenticated
     */
    public function friendsLocation()
    {
        return UserLocationResource::collection($this->authUser()->friends);
    }
    /**
     * Remove a Friend
     * @authenticated
     */
    public function removeFriend($friend)
    {
        $this->authUser()->myFriendships->where("user_2_id", $friend)->delete();
        $this->authUser()->friendshipsWithMe->where("user_1_id", $friend)->delete();
        return response("",200);

    }

    /**
     * Unaccepted Friend Requests
     * Friend Requests by other user towards me
     * TO BE USED AS NOTIFICATION
     *
     * @authenticated
     */
    public function friendrequests()
    {
        return response()->json(["data"=>array_values($this->authUser()->friendshipsWithMe->where("status", 0)->toArray())]);
    }
    /**
     * Pending Friend Requests
     * Friend Requests issued by the authenticated user
     * @authenticated
     */
    public function pendingfriendrequests()
    {
        return response()->json(["data"=>array_values($this->authUser()->myfriendships->where("status", 0)->toArray())]);
    }

    /**
     * Send a Friend Request
     * automatically accepts the friend request if the Friend has also requested friendship
     * @authenticated
     */
    public function requestFriend($friend)
    {



        $mutualRequest = Friendship::where("user_1_id","=",$friend)->where("user_2_id","=",$this->authUser()->id)->first();
        if (!$mutualRequest) {
            $alreadyRequested = Friendship::where("user_1_id","=",$this->authUser()->id)->where("user_2_id","=",$friend)->first();
            if (!$alreadyRequested) {

                $friendship = new Friendship();
                $friendship->status = 0;
                $friendship->user_1_id = $this->authUser()->id;
                $friendship->user_2_id = $friend;
                $friendship->save();

                $notification =  new Notification();
                $notification->setup($friend,"New Friendship request",$this->authUser()->name." requested your friendship",1,$this->authUser()->id);

                return response("friendship issued",200);

            }else{
                return response("already requested",200);
            }
        }else{
            $mutualRequest->status =1;
            $mutualRequest->save();
            $notification =  new Notification();
            $notification->setup($friend,"New Friendship",$this->authUser()->name." is now your friend",0,$this->authUser()->id);

            return response("mutual friendship accepted",200);

        }
    }
    /**
     * Accept a FriendRequest
     * @authenticated
     */
    public function acceptFriend($friend)
    {
        $friendReq = $this->authUser()->friendshipsWithMe->where("status", 0)->where("user_1_id","=",$friend)->first();
        if ($friendReq==null||$friendReq->status >= 1) {
            return response()->json(['error' => 'already accepted'], 400);
        }
        $friendReq->status = 1;
        $friendReq->update();
        $notification =  new Notification();
        $notification->setup($friend,"New Friendship",$this->authUser()->name." is now your friend",0,$this->authUser()->id);

        return response("",200);

    }
}
