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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => "required",
            'email' => "required",
            "password" => "required",
            "lat" => "required",
            "lng" => "required",
        ]);

        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = $request->get("password");
        $user->lat = $request->get("lat");
        $user->lng = $request->get("lng");

        $user->save();

        return $user;
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
        //
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
        $user->myFriendships()->delete();
        $user->friendshipsWithMe()->delete();
        $user->delete();
    }

    public function friends(User $user)
    {
        return $user->friends;
    }

    public function removeFriend(User $user, $friend)
    {
        $user->myFriendships()->where("user_2_id", $friend)->delete();
        $user->friendshipsWithMe()->where("user_1_id", $friend)->delete();
    }
}
