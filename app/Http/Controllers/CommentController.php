<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
/**
 * @group Comments
 *
 * APIs for managing comments
 */
class CommentController extends Controller
{
    /**
     * My Comments
     * returns comments of authenticated user
     * @authenticated
     */
    public function index()
    {
        return $this->authUser()->comments;
    }

    /**
     *
     * Store a new Comment
     * @authenticated
     * @bodyParam text string required The content of the comment
     */
    public function store(Request $request,Post $post)
    {

        $request->validate([
            "text" => "required",
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = $this->authUser()->id;
        $comment->parent_id = null;
        $comment->content = $request->get("text");
        $comment->save();
        return response($comment,200);
    }

    /**
     *
     * Store a new nested Comment
     *
     * used to store a response to another comment
     *
     * @authenticated
     * @bodyParam text string required The content of the comment
     */
    public function storeNested(Request $request,Post $post,Comment $comment)
    {

        $request->validate([
            "text" => "required",
        ]);
        $c = new Comment();
        $c->post_id = $post->id;
        $c->user_id = $this->authUser()->id;
        $c->parent_id = $comment->id;
        $c->content = $request->get("text");
        $c->save();
        return response($c,200);
    }

    /**
     * Comments of Post
     * @authenticated
     * @bodyParam text string required The content of the comment
     */
    public function commentsOfPost(Post $post)
    {
        return Comment::where(['post_id'=>$post->id,'parent_id'=>null])->get();
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
