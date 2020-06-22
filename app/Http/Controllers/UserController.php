<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\UserLocationResource;
use App\Http\Resources\UserLocationResourceCollection;
use App\User;
use Faker\Provider\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return response("ok", 200);

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
            "name" => "required",
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
        if ($user == null)
            return response("", 404);
        return response($user, 200);
    }

    /**
     * Update a User
     * @authenticated
     * Change user settings
     *
     * @bodyParam name string required name of the user
     * @bodyParam email string required email of the user
     * @bodyParam post_visibility integer required 0->private  1 -> friends  2->all (Not implemented jet)
     * @bodyParam show_location boolean required show or don't show location on map
     * @bodyParam profile_image file the profile picture
     */
    public function update(Request $request, User $user)
    {
        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {

            $request->validate([
                "name" => "required",
                "email" => "required|email",
                "post_visibility" => "required",
                "show_location" => "required",
            ]);

            $uuid = $user->profile_image;

            $user->name = $request->get("name");
            $user->email = $request->get("email");
            $user->post_visibility = $request->get("post_visibility");
            $user->show_location = $request->get("show_location");

            if ($request->filled('notifications_status')) {
                $user->notifications_status = $request->get("notifications_status");
            }
            if ($request->filled('auto_renew')) {
                $user->auto_renew = $request->get("auto_renew");
            }

            if ($request->hasFile("profile_image")) {
                $file = $request->file("profile_image");

                $uuid = Str::uuid()->toString();
                $file->move(base_path("/queue"), $uuid);

                $mime = mime_content_type(base_path("/queue/") . $uuid);

                if (!(strstr($mime, "image/"))) {
                    unlink(base_path("/queue/") . $uuid);
                    $uuid = null;
                }
            }
            $user->profile_image = $uuid;
            $user->save();

            return response($user, 200);
        }
        return response("unauthorized", 401);
    }

    /**
     * Deletion
     * deletes a user by id
     * @authenticated
     */
    public function destroy(User $user)
    {

        if ($this->authUser()->id == $user->id || $this->authUser()->isEditor) {
            $user->delete();
            return response("", 200);
        }
        return response("", 401);

    }


}
