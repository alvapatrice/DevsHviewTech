<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Repos\Dbrepos\CategoryDbRepo;
use App\Repos\Dbrepos\ThreadsDbRepo;
use Illuminate\Http\Request;
use App\Repos\Dbrepos\PostDbRepo;
use App\Repos\Ads\Ads;

class ArticlesController extends Controller {

    protected $articleRepo;
    /**
     * @var CategoryDbRepo
     */
    private $categoryRepo;
    protected $google_ads = [];
    protected $threadsRepo;

    public function __construct( PostDbRepo $articleRepo, CategoryDbRepo $categoryRepo, Ads $ads, ThreadsDbRepo $threadsRepo)
    {
        $this->articleRepo = $articleRepo;

        $this->categoryRepo = $categoryRepo;

        $this->google_ads = $ads->getAds();

        $this->threadsRepo = $threadsRepo;

    }

    public function index()
    {
        $articles = $this->articleRepo->getPaginatedArticles(10);
        $categories = $this->categoryRepo->getCategoryList();
        $ads_count = 0;
        $articles_count= 0;
        $viewtypes = ['large','list'];
        $ads = $this->google_ads;
        return view( 'articles.articles', compact( 'articles', 'categories', 'viewtypes', 'parentCategory', 'articles_count', 'ads', 'ads_count' ) );
    }

    public function show( $slug )
    {
        $article = $this->articleRepo->getBySlug( $slug );
        if ( $article )
        {
            $tagList = [];
            $nextArticle= $this->articleRepo->getNextArticle($article);
            $prevArticle = $this->articleRepo->getPrevArticle($article);
            $threads = $this->threadsRepo->getArticleThreads($article);
            $threadCategories = $this->threadsRepo->getAllCategory();
            $relatedArticles = [];
            $categories = $this->categoryRepo->getCategoryList();
            $breadcrumb = $this->categoryRepo->getCategoryBreadCrumb( $article );
            $keywords = 'Web-development';

            foreach ($article->tags->toArray() as $tags)
            {
                $keywords .= ', ' . $tags['title'];
                $tagList[] = $tags['slug'];
            }
            $ads = $this->google_ads;
            $relatedArticles = $this->articleRepo->getArticlesSlugByTags($tagList);
            $categoryArticles = $this->articleRepo->getPopularArticlesFromSameCategory($article);
            $articleCounter = 0;

            return view( 'articles.single', compact( 'article', 'categories', 'breadcrumb', 'keywords', 'relatedArticles','prevArticle', 'nextArticle', 'categoryArticles', 'articleCounter', 'ads', 'threads', 'threadCategories' ) );
        }
        else {
            abort(404);
        }
    }
}
