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

        return User::where("name","like",'%' . $request->get("name") . '%')
            ->where("id","<>",$this->authUser()->id)
            ->get();
    }




    public function update(Request $request, User $user)
    {
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
        }
    }

    public function destroy(User $user)
    {
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
            $user->myFriendships()->delete();
            $user->friendshipsWithMe()->delete();
            $user->delete();
            return response("",200);
        }
        return response("",401);

    }


}
