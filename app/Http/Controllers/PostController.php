<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
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
