<?php namespace App\Http\Controllers;

use App\Repos\Dbrepos\PostDbRepo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesApiController extends Controller {

    protected $article;

    public function __construct(PostDbRepo $article)
    {
        $this->article = $article;
    }

    public function articles()
    {
        $articles =  $this->article->getColumns(['title','slug','body', 'image']);

        return view('blog.test', compact('articles'));
    }

}
