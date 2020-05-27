<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
/**
 * @group Comments
 *
 * APIs for managing comments
 */
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Deletion
     * deletes a Comment by id
     * @authenticated
     */
    public function destroy(Comment $comment)
    {
        if ($this->authUser()->id == $comment->user->id || $this->authUser()->isEditor) {
            $comment->delete();
            return response("",200);
        }
        return response("",401);
    }
}
