<?php namespace App\Repos\Dbrepos;

use App\Events\NewArticlePublished;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class PostDbRepo implements PostDbRepoInterface {

    public function getBySlug( $slug )
    {
        try
        {
            $post = Post::with( 'category', 'user' )->where( 'slug', $slug )->first();
            $post->viewcount = $post->viewcount + 1;
            $post->save();
            return $post;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function getColumns( Array $columns )
    {
        return Post::with( 'category' )->where('published_at', '<=', Carbon::now())->orderBy( 'id', 'DESC' )->get( $columns );

    }

    public function getPaginatedArticles( $limit = 12 )
    {
        return Post::with( 'category' )->where('published_at', '<=', Carbon::now())->orderBy( 'id', 'DESC' )->paginate($limit);

    }

    public function getByCategory( $id )
    {
        return Post::where( 'category_id', $id )->get();
    }

    private function saveData( $requestData, $post, $temperPublishAt = false)
    {
        $post->title = $requestData['title'];
        $post->slug = $requestData['slug'];
        $post->subtitle = $requestData['subtitle'];
        $post->description = $requestData['description'];
        $post->body = $requestData['body'];
        $post->category_id = $requestData['postCategory_id'];
        $post->user_id = Auth::user()->id;
        $post->image = $requestData['image'];
        if($temperPublishAt)
        {
            $post->published_at = Carbon::now()->addYear(1)->format('Y-m-d');
        }
        return $post->save();

    }

    public function updatePost( $slug, $requestData )
    {
        $post = Post::where( 'slug', $slug )->first();

        $post = $this->saveData( $requestData, $post );

        return $post;
    }

    public function publishPost( $requestData )
    {
        try
        {
            $post = Post::find( $requestData['post_id'] );
            $post->published_at = $requestData['publish_date'];
            $status = $post->save();
            return $status;
        }
        catch ( \Exception $e )
        {
            return false;
        }
    }

    public function unpublishPost( $requestData )
    {
        try
        {
            $post = Post::find($requestData['post_id']);
            $post->published_at = Carbon::now()->addYear(1)->format('Y-m-d');
            $status = $post->save();
            return $status;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function insertPost( $requestData )
    {
        $post = new Post;

        $status = $this->saveData( $requestData, $post, true );

        Event::fire(new NewArticlePublished($post));

        return $status;

    }

    protected function getSearchDataInChunks($data)
    {
        $data = explode(' ', $data);
        return $data;
    }
    public function searchArticles( $requestData, array $columns )
    {
        $requestData = $this->getSearchDataInChunks($requestData);
        return Post::where( function($query) use ($requestData) {
            for($i =0; $i < count($requestData); $i++)
            {
                $query->Where('title', 'LIKE', "%$requestData[$i]%");
            }
        })->where('published_at', '<=', Carbon::now())->get( $columns );
//        return Post::where( 'title', 'LIKE', "%$requestData%" )->where('published_at', '<=', Carbon::now())->get( $columns );
    }

    public function deleteArticle( $slug )
    {
        return Post::where( 'slug', $slug )->delete();
    }

    public function getArticlesFromMultipleCategories( array $categories )
    {
        $ids = [];
        foreach ($categories as $category)
        {
            $ids[] = $category['id'];
        }
        return Post::whereIn( 'category_id', $ids )->where('published_at', '<=', Carbon::now())->paginate(10);
    }

    public function getArticlesSlugByTags( array $tagList )
    {
        $tags = Tag::whereIn('slug', $tagList)->get();
        $slugs = [];
        $posts = [];
        $index = 0;
        foreach( $tags as $tag)
        {
            foreach( $tag->posts->toArray() as $post )
            {
                if( ! in_array($post['slug'], $slugs))
                {
                    $slugs[] = $post['slug'];
                    $posts[$index]['slug'] = $post['slug'];
                    $posts[$index]['title'] = $post['title'];
                    $posts[$index]['image'] = $post['image'];
                    $index = $index + 1;
                }
            }
        }
        shuffle($posts);
        $posts = array_splice($posts, 0 , 4);
        return $posts;
    }

    public function getPrevArticle( $article )
    {
        $post = new Post;
        $prevArticle = $post->where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        if( !$prevArticle)
        {
            $prevArticle = $post->where('id', '>', $article->id)->orderBy('id', 'desc')->first();
        }
        return $prevArticle->toArray();
    }

    public function getNextArticle( $article )
    {
        $post = new Post;
        $nextArticle = $post->where('id', '>', $article->id)->orderBy('id', 'asc')->first();
        if( !$nextArticle )
        {
            $nextArticle = $post->where('id', '<', $article->id)->orderBy('id', 'asc')->first();
        }
        return $nextArticle->toArray();
    }

    public function getPopularArticlesFromSameCategory($article)
    {
        $post = new Post;
        try
        {
            return $post->where('category_id', $article->category->id)->orderBy('viewcount', 'desc')->take(5)->get();
        }
        catch(\Exception $e)
        {
            return false;
        }

    }
}
