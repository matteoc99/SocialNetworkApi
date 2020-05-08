<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\Person;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
            return User::all();
    }


    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
            $user->myFriendships()->delete();
            $user->friendshipsWithMe()->delete();
            $user->delete();
        }
    }

    public function friends()
    {
        return $this->authUser()->friends;
    }

    public function removeFriend(User $user, $friend)
    {
        $this->authUser()->myFriendships()->where("user_2_id", $friend)->delete();
        $this->authUser()->friendshipsWithMe()->where("user_1_id", $friend)->delete();
    }
}
