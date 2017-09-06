<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagFormRequest;
use App\Repos\Dbrepos\TagDbRepo;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller {

    protected $tag, $tag_list, $repo;
    public function __construct(Tag $tag, TagDbRepo $repo)
    {
//        $this->middleware('auth');

        $this->tag = $tag;
        $this->tag_list = $this->tag->orderBy('id', 'DESC')->take(10)->get();
        $this->repo = $repo;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
    public function adminIndex()
    {
        $tags = $this->repo->getPaginatedList(10);
        $page_title = 'All Tags List';
        return view('admin.tags', compact('tags', 'page_title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $page_title = 'Create New Tag';
        return view('admin.createTag')
            ->with('tag_list', $this->tag_list)
            ->with('page_title', $page_title);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TagFormRequest $request)
	{
        $result = $this->repo->insertTag($request);

        if(! $result )
        {
            return redirect()->route('admin.tags.list')->with('flash_message', 'Tag could not be created');
        }
        return redirect()->route('admin.tags.list')->with('flash_message', 'Tag Created Successfully');

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
	public function edit($slug)
	{
        $tag = $this->tag->where('slug', $slug)->first();
        return view('admin.editTags', compact('tag'))->with('tag_list', $this->tag_list);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($slug, TagFormRequest $request)
	{
        $result = $this->repo->updateTag($slug, $request);

        if(! $result )
        {
            return redirect()->route('admin.tags.list')->with('flash_message', 'Tag could not be Updated');
        }
        return redirect()->route('admin.tags.list')->with('flash_message', 'Tag Updated Successfully');
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
