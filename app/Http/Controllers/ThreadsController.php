<?php namespace App\Http\Controllers;

use App\Events\NewArticlePublished;
use App\ThreadCategory;
use App\Http\Requests;
use App\Http\Requests\ThreadCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repos\Dbrepos\ThreadsDbRepo as Thread;
use Illuminate\Support\Facades\Route;
use App\Post;

class ThreadsController extends Controller {

    protected $thread;
    protected $category;

    function __construct(Thread $thread, ThreadCategory $category)
    {
        $this->category = $category;
        $this->thread = $thread;
    }

    protected function isAdminRequest()
    {
        return (Route::getCurrentRoute()->getPrefix() == '/admin');

    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//        $categoriesWithThreads = $this->thread->getCategoriesWithThreads();
//		$recentThreads =  $this->thread->recentThreadsList(10);
//

        $threads  = $this->thread->getPaginatedThreads(15);
        if($this->isAdminRequest())
        {
            $page_title = 'Threads List';
            return view('admin.threads.index', compact('threads', 'page_title'));
        }
        $categories = $this->thread->getCatgories();
        if($threads)
        {
            return view('threads.index', compact('threads', 'categories'))->with('page_title', 'Fourms - Devartisans');
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categoryList = $this->category->lists('title','id');
		return view('threads.create', compact('categoryList'))->with('page_title', 'Create New Thread - Devartisans Forums');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ThreadCreateRequest $request)
	{
        if ( $this->thread->save($request) )
        {
           return redirect()->route('threads.list')->with('flash_message', 'Your Thread has Been Posted');
        }

        return redirect()->route('threads.list')->with('flash_message', 'Could not Create a Thread');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($category_slug, $thread_slug)
	{
        $thread = $this->thread->getThreadWithComments($thread_slug);
        if($thread)
        {
            $page_title = "{$thread->title} - {$thread->category->title} - Devartisans Fourms";
            return view('threads.single', compact('thread'))->with('page_title', $page_title);
        }
        else {
            abort(404);
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if($this->isAdminRequest())
        {
            $page_title = 'Edit Thread';
            $thread = $this->thread->getById($id);

            if($thread)
            {
                return view('admin.threads.edit', compact('thread', 'page_title'));
            }
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
     * @param Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		if($this->isAdminRequest())
        {
            $status = $this->thread->update($request, $id);
            if(! $status)
            {
                return redirect()->back()->withInput()->with('error_message', 'Thread Could not be Updated');
            }
            return redirect()->back()->with('flash_message', 'Thread Updated Successfully');
        }
	}

    public function showByCategory( $slug )
    {
        $categories = $this->thread->getCatgories();
        $threads  = $this->thread->getPaginatedThreadsByCategory(5, $slug);
        $page_title = ($threads[0] != null) ?  "{$threads[0]->category->title} - Devartisans Forums" : "No Articles -Devartisans Forums" ;
        if($threads)
        {
            return view('threads.index', compact('threads', 'categories'))->with('page_title', $page_title);
        }
    }
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$status = $this->thread->delete($id);

        if(!$status)
        {
            return redirect()->back()->with('error_message', 'Could Not Delete Thread');
        }

        return redirect()->back()->with('flash_message', 'Thread Deleted Successfully');
	}


    public function generateArticlesThread()
    {
        $posts = Post::all();

        foreach($posts as $post) {
            event(new NewArticlePublished($post));
        }
    }

}
