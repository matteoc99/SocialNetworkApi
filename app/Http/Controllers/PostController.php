<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Collection\Collection;

/**
 * @group Posts
 *
 * APIs for managing posts
 */
class PostController extends Controller
{

    /**
     * My Posts
     * returns a list of all posts of the user
     * @authenticated
     * @response Posts of the authenticated user
     */
    public function index()
    {
        return array_values($this->authUser()->posts->sortByDesc("id")->toArray());
    }

    /**
     *
     * Posts of Friends
     *
     * Returns the posts of friends
     *
     * @authenticated
     */
    public function postfeed()
    {
        return array_values(
            Post::all()
                ->whereIn("user_id", $this->authUser()->friends->pluck("id"))
                ->where("post_visibility", ">=", 1)
                ->sortByDesc("id")
                ->toArray());
    }


    /**
     *
     * Store a new post
     * @authenticated
     * @bodyParam text string required The content of the post
     * @bodyParam media file The media-file of the post
     */

    public function store(Request $request)
    {

        $request->validate([
            "text" => "required",
        ]);
        $uuid = null;
        $file_type = null;
        $posttype = 0;
        if ($request->hasFile("media")) {
            $file = $request->file("media");


            $uuid = Str::uuid()->toString();
            $file->move(base_path("/queue"), $uuid);

            $mime = mime_content_type(base_path("/queue/") . $uuid);

            if (strstr($mime, "video/")) {
                $posttype = 2;
            } else if (strstr($mime, "image/")) {
                $posttype = 1;
            } else {
                unlink(base_path("/queue/") . $uuid);
                $uuid = null;
            }

        }
        $post = new Post();
        $post->user_id = $this->authUser()->id;
        $post->post_visibility = $this->authUser()->post_visibility;
        $post->media_uuid = $uuid;
        $post->status = 1;
        $post->post_type = $posttype;
        $post->text = $request->get("text");

        $post->save();


        foreach ( $this->authUser()->friends->pluck("id") as $friend)
          $notification =  new Notification();
        $notification->setup($friend,"New Post",$this->authUser()->name." has posted something",2,$this->authUser()->id);

        return response($post, 200);

    }

    /**
     * Get Posts Of User
     * gets posts of user labled as public
     * @authenticated
     */
    public function postOfUser(User $user)
    {
        $posts = $user->posts;
        if ($this->authUser()->id != $user->id)
            $posts = $posts->where("post_visibility", ">", 0);
        return array_values($posts->toArray());
    }

    /**
     *
     * Update a post
     *
     * @authenticated
     * @bodyParam text string required The NEW content of the post
     * @bodyParam media file The media-file of the post, if the image has to be changed. leave empty to delete. leave it out to leave the image unchanged
     * @bodyParam post_visibility integer 0->private  1 -> friends(default)  2->all (Not implemented jet)
     */
    public function update(Request $request, Post $post)
    {
        if ($this->authUser()->id == $post->user->id || $this->authUser()->isEditor) {

            $request->validate([
                "text" => "required",
            ]);

            $posttype = 0;
            $uuid = $post->media_uuid;

            if ($request->exists("media")) {
                if ($request->hasFile("media")) {
                    $file = $request->file("media");

                    $uuid = Str::uuid()->toString();
                    $file->move(base_path("/queue"), $uuid);

                    $mime = mime_content_type(base_path("/queue/") . $uuid);

                    if (strstr($mime, "video/")) {
                        $posttype = 2;
                    } else if (strstr($mime, "image/")) {
                        $posttype = 1;
                    } else {
                        unlink(base_path("/queue/") . $uuid);
                        $uuid = null;
                    }
                }else{
                    $uuid = null;
                }
            }

            if ($post->media_uuid != $uuid) {
                $post->media_uuid = $uuid;
                $post->post_type = $posttype;
            }
            $post->text = $request->get("text");
            if ($request->exists("post_visibility")) {
                $post->post_visibility = $request->get("post_visibility");
            }
            $post->save();
            return response("", 200);
        }
        return response("", 401);
    }

    /**
     * Deletion
     * deletes a post by id
     * @authenticated
     */
    public function destroy(Post $post)
    {

        if ($this->authUser()->id == $post->user->id || $this->authUser()->isEditor) {
            $post->comments()->delete();
            $post->delete();
            return response("", 200);
        }
        return response("", 401);
    }
}
