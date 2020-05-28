<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentLike;
use App\Post;
use App\PostLike;
use Illuminate\Http\Request;

/**
 * @group Likes
 *
 * APIs for managing likes
 */

class LikeController extends Controller
{
    /**
     * Like Post
     * likes a post by id
     * @authenticated
     */
    public function likePost (Post $post)
    {

        $alreadyLiked =$post->likes()->where("id","=",$this->authUser()->id)->get();

        if($alreadyLiked->count() ==0)
        {
            $like = new PostLike();
            $like->user_id=$this->authUser()->id;
            $like->post_id=$post->id;
            $like->liked = true;
            $like->save();
        }else{
            $post->likes()->updateExistingPivot($this->authUser()->id,['liked' => true ]);
        }
        return response("liked", 200);

    }

    /**
     * Dislike Post
     * dislikes a post by id
     * @authenticated
     */
    public function dislikePost (Post $post)
    {
        $alreadyLiked =$post->likes()->where("id","=",$this->authUser()->id)->get();

        if($alreadyLiked->count() ==0)
        {
            $like = new PostLike();
            $like->user_id=$this->authUser()->id;
            $like->post_id=$post->id;
            $like->liked = false;
            $like->save();
        }else{
            $post->likes()->updateExistingPivot($this->authUser()->id,['liked' => false ]);
        }
        return response("disliked", 200);

    }

    /**
     * Like Comment
     * likes a comment by id
     * @authenticated
     */
    public function likeComment (Comment $comment)
    {
        $alreadyLiked =$comment->likes()->where("id","=",$this->authUser()->id)->get();
        error_log($alreadyLiked->count());
        if($alreadyLiked->count() ==0)
        {
            $like = new CommentLike();
            $like->user_id=$this->authUser()->id;
            $like->comment_id=$comment->id;
            $like->liked = true;
            $like->save();
        }else{
            $comment->likes()->updateExistingPivot($this->authUser()->id,['liked' => true ]);
        }
        return response("liked", 200);
    }
    /**
     * Dislike Comment
     * dislikes a comment by id
     * @authenticated
     */
    public function dislikeComment (Comment $comment)
    {
        $alreadyLiked =$comment->likes()->where("id","=",$this->authUser()->id)->get();
        error_log($alreadyLiked->count());
        if($alreadyLiked->count() ==0)
        {
            $like = new CommentLike();
            $like->user_id=$this->authUser()->id;
            $like->comment_id=$comment->id;
            $like->liked = false;
            $like->save();
        }else{
            $comment->likes()->updateExistingPivot($this->authUser()->id,['liked' => false ]);
        }
        return response("disliked", 200);
    }

}
