<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Category;
use App\Post;
use App\Repos\Dbrepos\CategoryDbRepo;
use App\Repos\Dbrepos\PostDbRepo;
use Illuminate\Http\Request;
use App\Repos\Ads\Ads;

class CategoriesController extends Controller {

    protected $category, $category_list, $categoryListForCombo, $categoryRepo, $articleRepo;
    protected $google_ads = [];

    public function __construct(Category $category, CategoryDbRepo $repo, PostDbRepo $articleRepo, Ads $ads)
    {
//        $this->middleware('auth');
        $this->categoryRepo = $repo;
        $this->category = $category;
        $this->articleRepo = $articleRepo;
        $this->category_list = $this->category->orderBy('id', 'DESC')->take(10)->get();
        $this->categoryListForCombo = $this->category->lists('title','id')->toArray();
        $this->google_ads = $ads->getAds();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->categoryRepo->getCategoryListAll();
        $page_title = "Categories - Devartisans";

        return view('categories.index', compact('categories', 'page_title', 'articles'));
	}

    public function adminIndex()
    {
        $categories = $this->categoryRepo->getPaginatedList(12);
        $page_title = "All Categories";
        return view('admin.categories', compact('categories', 'page_title'));
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $page_title = 'Create New Category';
        return view('admin.createCategories')
            ->with('category_list', $this->category_list)
            ->with('categoryListForCombo', $this->categoryListForCombo)
            ->with('page_title', $page_title);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoryFormRequest $request)
	{

        $result = $this->categoryRepo->insertCategory($request);

        if (!$result)
        {
            return redirect()->route('admin.categories.list')->with('flash_message', 'Category could not be created');
        }
        return redirect()->route('admin.categories.list')->with('flash_message', 'Category Created Successfully');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{

        $categories_array = $this->categoryRepo->getCategoryWithChildren($slug);

        $articles = $this->articleRepo->getArticlesFromMultipleCategories($categories_array);

        $categories = $this->categoryRepo->getCategoryList();
        $viewtypes = ['large', 'list'];
        $ads_count = 0;
        $articles_count= 0;
        $ads = $this->google_ads;
        $page_title = "Articles - {$categories_array[0]['title']} - Devartisans";
		return view('categories.single', compact('articles', 'categories', 'viewtypes', 'page_title','ads_count', 'articles_count', 'ads'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug)
	{
        $category = $this->category->where('slug', $slug)->first();
		return view('admin.editCategories', compact('category'))->with('category_list', $this->category_list)->with('categoryListForCombo', $this->categoryListForCombo);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($slug, CategoryFormRequest $request)
	{
        $result = $this->categoryRepo->updateCategory($slug, $request);

        if (! $result )
        {
            return redirect()->route('admin.categories.list')->with('flash_message', 'Category could not be updated');
        }
        return redirect()->route('admin.categories.list')->with('flash_message', 'Category Updated Successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
