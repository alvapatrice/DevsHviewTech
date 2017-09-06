<?php

namespace App\Listeners;

use App\Events\NewArticlePublished;
use App\Repos\Dbrepos\ThreadsDbRepo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CreateArticleAssociatedThread
 * @package App\Listeners
 */
class CreateArticleAssociatedThread
{

    /**
     * @var ThreadsDbRepo
     */
    protected $thread;

    /**
     * @param ThreadsDbRepo $thread
     */
    public function __construct(ThreadsDbRepo $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Handle the event.
     *
     * @param  NewArticlePublished  $event
     * @return void
     */
    public function handle(NewArticlePublished $event)
    {
        $this->thread->createArticleThread($event->post, [
            'title' => 'Article Discussion - ',
            'slug' => 'article-discussion-',
            'body' => 'General discussion about this Article, tell us what you think about this article, what can be improved and what you like or don\'t like about the article, help us to improve the quality and give you latest and greatest content possible.',
            'category_id' => 6 ]);
        $this->thread->createArticleThread($event->post, [
            'title' => 'Common Questions For Article - ',
            'slug' => 'common-questions-',
            'body' => 'Post your questions below related to article, try to give as much information as possible, provide the code which gives you error, use editor\'s insert code snippet functionality( last option of editor\'s toolbar ) to for syntax highlighting.',
            'category_id' => 3 ]);
        $this->thread->createArticleThread($event->post, [
            'title' => 'Common Errors Related To Article - ',
            'slug' => 'common-errors-',
            'body' => 'Post errors you encountered below related to article, tell us how you got the error, provide the code which gives you error, use editor\'s insert code snippet functionality( last option of editor\'s toolbar ) to for syntax highlighting.',
            'category_id' => 4 ]);
    }
}
