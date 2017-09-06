<?php

namespace App\Events;

use App\Events\Event;
use App\Post;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class NewArticlePublished
 * @package App\Events
 */
class NewArticlePublished extends Event
{
    use SerializesModels;

    /**
     * @var Post
     */
    public $post;


    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
