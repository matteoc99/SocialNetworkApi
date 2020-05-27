<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLocationResource;
use App\Http\Resources\UserLocationResourceCollection;
use App\User;
use Faker\Provider\Person;
use Illuminate\Http\Request;

/**
 * @group User
 *
 * APIs for managing user
 */
class UserController extends Controller
{

    /**
     *
     * Show all user with posts
     * ADMIN ONLY
     * @authenticated
     */
    public function index()
    {
        return User::with("posts")->get();
    }

    /**
     *
     * Update Geo Position
     * @bodyParam lat string required the Latitude
     * @bodyParam lng string required the Longitude
     * @authenticated
     */
    public function changeLoc(Request $request)
    {
        $request->validate([
            "lat" => "required",
            "lng" => "required",
        ]);

        $this->authUser()->lat = $request->get("lat");
        $this->authUser()->lng = $request->get("lng");
        $this->authUser()->save();
        return response("", 200);

    }

    /**
     * Suggestions
     * user suggestions given a part of the name
     * @bodyParam name string required the name to search for
     * @authenticated
     */
    public function suggestions(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
        ]);

        return User::where("name", "like", '%' . $request->get("name") . '%')
            ->where("id", "<>", $this->authUser()->id)
            ->get();
    }


    /**
     * Get user Info
     * returns the specified user
     * @authenticated
     */
    public function show(User $user)
    {
        if($user == null)
            return response("", 404);
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
            return response($user, 200);

        }
        return response("", 401);
    }

    public function update(Request $request, User $user)
    {


    }

    /**
     * Deletion
     * deletes a user by id
     * @authenticated
     */
    public function destroy(User $user)
    {

        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
            $user->myFriendships()->delete();
            $user->friendshipsWithMe()->delete();
            $user->posts()->with("comments")->delete();
            $user->posts()->delete();

            $user->delete();
            return response("", 200);
        }
        return response("", 401);

    }


}
