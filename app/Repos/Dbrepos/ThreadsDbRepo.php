<?php namespace App\Repos\Dbrepos;

use App\Thread;
use App\User;
use App\Comment;
use App\ThreadCategory as Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ThreadsDbRepo {

    protected $thread;
    protected $user;
    protected $comment;
    protected $category;

    function __construct( Thread $thread, User $user, Category $category, Comment $comment )
    {
        $this->thread = $thread;
        $this->user = $user;
        $this->comment = $comment;
        $this->category = $category;
    }

    public function recentThreadsList( $limit = 10 )
    {
        return $this->thread->with( 'category' )->take( $limit )->get();
    }

//    protected function createSlug( $title )
//    {
//        return preg_replace( '/\s+/', '-', $title );
//    }

    protected function createSlug( $text )
    {
        // replace non letter or digits by -
        $text = preg_replace( '~[^\\pL\d]+~u', '-', $text );

        // trim
        $text = trim( $text, '-' );

        // transliterate
        $text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );

        // lowercase
        $text = strtolower( $text );

        // remove unwanted characters
        $text = preg_replace( '~[^-\w]+~', '', $text );

        if ( empty($text) )
        {
            return 'n-a';
        }

        return $text;
    }

    public function getById( $id )
    {
        try
        {
            return $this->thread->find($id);
        }
        catch(\Excpetion $e)
        {
            return false;
        }
    }
    public function createArticleThread( $post, Array $data )
    {
        $user = User::firstOrCreate([
            'name' => 'Devartisans',
            'email' => 'devartisans@devartisans.com',
            'type' => 0
        ]);

        try
        {
            return $this->thread->create( [
                'title' => $data['title'] . $post->title,
                'slug' => $data['slug'] . $post->slug,
                'body' => $data['body'],
                'category_id' => $data['category_id'],
                'article_id' => $post->id,
                'user_id' => $user->id
            ] );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function getArticleThreads( $post )
    {
        try
        {
            return $this->thread->where('article_id', $post->id)->get();
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function getAllCategory()
    {
        try
        {
            return $this->category->lists('slug','id')->toArray();
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function update( $requestData, $id )
    {
        try
        {
            $thread = $this->thread->find($id);

            return $thread->update([
                'title' => $requestData['title'],
                'slug' => $requestData['slug'],
                'body' => $requestData['body'],
                'category_id' => $requestData['category_id'],
                'article_id' => $requestData['article_id'],
            ]);
        }
        catch( \Exception $e)
        {
            return false;
        }
    }


    public function save( $requestData )
    {
        if($requestData->get('posttype') != null)
        {
            $user =  User::firstOrCreate( [
                'name' => 'Guest',
                'email' => 'guest@devartisans.com',
                'type' => 4
            ]);
        }
        $id = (Auth::check()) ? Auth::user()->id : $user->id;
        try
        {
            return $this->thread->create( [
                'title' => $requestData['title'],
                'slug' => $this->createSlug( $requestData['title'] ),
                'body' => $requestData['body'],
                'category_id' => $requestData['category_id'],
                'user_id' => $id
            ] );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function getThreadWithComments( $slug )
    {
        try
        {
            return $this->thread->where( 'slug', $slug )
                                    ->with( 'category', 'user', 'comments.user.comments')
                                        ->firstOrFail();
        }
        catch ( ModelNotFoundException $e )
        {
            return false;
        }

    }

    public function getCategoriesWithThreads()
    {
        try
        {
            return $this->category->with( ['thread.user' => function ( $query )
            {
                $query->orderBy( 'updated_at', 'desc' )->take( 10 );
            }, 'thread.comments.user' => function ( $query )
            {
                $query->orderBy( 'updated_at', 'desc' );
            }] )->get();
        }
        catch ( \Exception $e )
        {
            return $e;
        }
    }

    public function delete( $id )
    {
        try
        {
            return $this->thread->where('id', $id)->delete();
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function getPaginatedThreads( $limit = 20)
    {
        try
        {
            return $this->thread->with( 'user', 'category', 'comments' )->orderBy( 'created_at', 'desc' )->paginate( $limit );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function getPaginatedThreadsByCategory( $limit = 20, $slug = '*' )
    {
        try
        {
            $category_id = $this->category->where('slug', $slug)->firstOrFail()->id;
            if($category_id)
            {
                return $this->thread->with( 'user', 'category', 'comments' )->where('category_id', $category_id)->orderBy( 'created_at', 'desc' )->paginate( $limit );
            }
            return false;
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }
    public function getCatgories()
    {
        try
        {
            return $this->category->all();
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function saveComment( $requestData )
    {
        if($requestData->get('posttype') != null)
        {
            $user =  User::firstOrCreate( [
                'name' => 'Guest',
                'email' => 'guest@devartisans.com',
                'type' => 4
            ]);
        }
        $id = (Auth::check()) ? Auth::user()->id : $user->id;
        try
        {
            return $this->comment->create( [
                'body' => $requestData['commentBody'],
                'thread_id' => $requestData['threadId'],
                'user_id' => $id,
                'likes' => 0
            ] );
        }
        catch ( \Exception $e )
        {
            return false;
        }

    }

    public function getComment( $id )
    {
        try
        {
            return $this->comment->find( $id );
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function updateComment( $requestData )
    {
        try
        {
            $comment = $this->comment->find($requestData['comment_id']);
            $comment->body = $requestData['editedComment'];
            $status = $comment->save();
            return $status;
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function likeComment( $requestData )
    {
        try
        {
            $comment = $this->comment->find($requestData['id']);
            $comment->likes = $comment->likes + 1;
            $status = $comment->save();
            if($status)
            {
                return $comment->likes;
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

}