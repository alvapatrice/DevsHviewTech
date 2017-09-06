<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repos\Dbrepos\PostDbRepo;
use Illuminate\Http\Request;

class SearchController extends Controller {

    /**
     * @var PostDbRepo
     */
    private $postRepo;

    public function __construct(PostDbRepo $postRepo)
    {

        $this->postRepo = $postRepo;
    }
	public function ajaxSearch($data)
    {
        return  $this->postRepo->searchArticles($data, ['id', 'slug', 'title'])->toJSON();
    }

}
