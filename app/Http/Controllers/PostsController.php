<?php namespace App\Http\Controllers;

use App\Events\NewArticlePublished;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Image;
use App\Post;
use App\Repos\Dbrepos\PostDbRepo;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller {

    protected $post, $postModel, $category, $tag, $post_list, $categoryListForCombo, $tagListForCombo;

    public function __construct(PostDbRepo $post, Post $postModel, Tag $tag, Category $category)
    {
//        $this->middleware('auth');
        $this->post = $post;

        //temporary removed in future
        $this->postModel = $postModel;


        $this->category = $category;
        $this->tag = $tag;
        $this->post_list = $this->postModel->orderBy('id', 'DESC')->take(10)->get();
        $this->categoryListForCombo = $this->category->lists('title','id');
        $this->tagListForCombo = $this->tag->lists('title','id');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        $page_title = 'Posts';
        return view('admin.posts', compact('posts', 'page_title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Image $image)
	{
        $images = $image->all();
        $image_path = '/images/uploads/';
        $thumb_path = '/images/uploads/thumbs/';
        $page_title = 'Create New Post';

        return view('admin.createPost')
            ->with('post_list', $this->post_list)
            ->with('categoryListForCombo', $this->categoryListForCombo)
            ->with('tagListForCombo', $this->tagListForCombo)
            ->with('images', $images)
            ->with('image_path', $image_path)
            ->with('thumb_path', $thumb_path)
            ->with('page_title', $page_title);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostFormRequest $request)
	{
        $result = $this->post->insertPost($request);

        $recentPost =  $this->postModel->orderBy('id', 'DESC')->first();
        $recentPost->tags()->sync($request['tag_list']);

        return redirect()->route('admin.posts.list')->with('flash_message', 'Article Created Successfully');
 	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug, Image $image)
	{
        $images = $image->all();
        $image_path = '/images/uploads/';
        $thumb_path = '/images/uploads/thumbs/';

        $post = $this->postModel->where('slug', $slug)->with('tags')->first();

//        dd($post->tags);
        $selected_tags = [];

        foreach($post->tags as $tag)
        {
            $selected_tags[] = $tag->id;
        }
        return view('admin.editPosts', compact('post'))
            ->with('post_list', $this->post_list)
            ->with('categoryListForCombo', $this->categoryListForCombo)
            ->with('tagListForCombo', $this->tagListForCombo)
            ->with('images', $images)
            ->with('image_path', $image_path)
            ->with('thumb_path', $thumb_path)
            ->with('selected_tags', $selected_tags);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($slug, PostFormRequest $request)
	{
        $this->post->updatePost($slug, $request);

        //TODO: Create machenism to store query in cache
        //TODO: IT is not efficient to run these two queries every time

        $updatedPost =  $this->postModel->where('slug', $slug)->first();

        $updatedPost->tags()->sync($request['tag_list']);

        return redirect()->route('admin.posts.list')->with('flash_message', 'Article Updated Successfully');

	}

    public function publish(Request $request)
    {

        if( $this->post->publishPost($request) )
        {
            return redirect()->back()->with('flash_message', 'Article Published Successfully');
        }
        return redirect()->back()->with('flash_message', 'Could Not publish Article');
//        $this->post->updatePost($slug, $request);
//
//        //TODO: Create machenism to store query in cache
//        //TODO: IT is not efficient to run these two queries every time
//
//        $recentPost =  $this->postModel->orderBy('id', 'DESC')->first();
//
//        $recentPost->tags()->sync($request['tag_list']);
//
//        return redirect()->route('admin.posts.list')->with('flash_message', 'Article Updated Successfully');

    }

    public function unpublish( Request $request )
    {
        if( $this->post->unpublishPost($request))
        {
            return redirect()->back()->with('flash_message', 'Article Unpublished');
        }
        return redirect()->back()->with('flash_message', 'Could not unpublish Article');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($slug)
	{
		$deletedCount = $this->post->deleteArticle($slug);
        if(! $deletedCount)
        {
            return redirect()->route('admin.posts.list')->with('flash_message', 'Article could not be deleted');
        }
        return redirect()->route('admin.posts.list')->with('flash_message', 'Article Deleted Successfully');
	}

    public function returnWithParseData($returnViewPath,  $postList,  $categoryList, $tagList)
    {
        return view($returnViewPath)
            ->with('post_list',  $this->$postList)
            ->with('categoryListForCombo',  $this->$categoryList)
            ->with('tagListForCombo',  $this->$tagList);
    }

}
