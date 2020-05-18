<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLocationResource;
use App\Http\Resources\UserLocationResourceCollection;
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
        return User::with("posts")->get();
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
        }
    }


}
