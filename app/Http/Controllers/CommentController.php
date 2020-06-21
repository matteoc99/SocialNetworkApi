<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notification;
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
        $notification =  new Notification();
        $notification->setup($post->user_id,"New Comment",$this->authUser()->name." left a comment on one of your posts, go check it out.",3,$post->id);

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
        $notification =  new Notification();
        $notification->setup($comment->user_id,"New Reply",$this->authUser()->name." replied to your comment",4,$post->id);

        return response($c,200);
    }

    /**
     * Comments of Post
     * edit existing comment
     * @authenticated
     * @bodyParam text string required The content of the comment
     */
    public function commentsOfPost(Post $post)
    {
        return Comment::where(['post_id'=>$post->id,'parent_id'=>null])->orderBy("id")->get();
    }

    /**
     *
     * update a Comment
     * @authenticated
     * @bodyParam text string required The NEW content of the comment
     */
    public function update(Request $request, Comment $comment)
    {
        if ($this->authUser()->id == $comment->user->id || $this->authUser()->isEditor) {

            $request->validate([
                "text" => "required",
            ]);
            $comment->content = $request->get("text");
            $comment->save();
            return response($comment, 200);
        }
        return response("",401);
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
