<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Collection\Collection;

class PostController extends Controller
{

    public function index()
    {
        return $this->authUser()->posts;
    }
    public function postfeed()
    {
        return array_values(
            Post::all()
                ->whereIn("user_id",$this->authUser()->friends->pluck("id"))
                ->where("post_visibility",">=",1)
                ->toArray());
    }


    public function store(Request $request)
    {

        $request->validate([
            "text" => "required",
        ]);
        $uuid = null;
        $file_type = null;
        if($request->hasFile("media")) {
            $uuid = Str::uuid()->toString();
            $file =  $request->file("media");
            $file->move(base_path("/queue"), $uuid . "." .$file->getClientOriginalExtension());
            $file_type= $file->getClientOriginalExtension();
        }
        $post = new Post();
        $post->user_id = $this->authUser()->id;
        $post->post_visibility = $this->authUser()->post_visibility;
        $post->media_uuid = $uuid;
        $post->file_type = $file_type;
        $post->status = 1;
        $post->text = $request->get("text");

        return $post;
    }


    public function show(Post $post)
    {
        return $post;
    }


    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
