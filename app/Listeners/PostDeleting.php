<?php

namespace App\Listeners;

use App\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostDeleting
{
    use SerializesModels;

    public $post;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->post->likes()->delete();
        $event->post->comments()->delete();

    }
}
