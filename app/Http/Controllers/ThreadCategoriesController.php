<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ThreadCategory as Category;
use Illuminate\Http\Request;

class ThreadCategoriesController extends Controller {

    protected $category;

    public function __construct( Category $category )
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->with( 'thread' )->paginate( 10 );
        $page_title = 'Thread Categories List';

        return view( 'admin.threadCategories', compact( 'categories', 'page_title') );
    }

    public function edit( $slug )
    {
        $category = $this->category->where( 'slug', $slug )->firstOrFail();
        return view( 'admin.editThreadCategories', compact( 'category' ) );
    }

    public function update( $slug, Request $request )
    {
        $category = $this->category->where( 'slug', $slug )->first();
        $category->title = $request['title'];
        $category->slug = $request['slug'];
        $category->description = $request['description'];
        $status = $category->save();
        if ( $status )
        {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'Category Has Been Updated' );
        } else
        {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'Could Not update category' );
        }

    }

    public function create()
    {
        $page_title = 'Create New Thread Category';
        return view( 'admin.createThreadCategories', compact('page_title') );
    }

    public function store( Request $request )
    {
        $status = false;
        try
        {
            $this->category->title = $request['title'];
            $this->category->slug = $request['slug'];
            $this->category->description = $request['description'];
            $status = $this->category->save();
        }
        catch ( \Exception $e )
        {
            $status = false;
        }

        if ( $status )
        {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'New Category Has Been Created' );
        } else
        {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'Could not create new category' );
        }
    }

    public function destroy( $slug )
    {
        $deleteCount = false;
        try
        {
            $deleteCount = $this->category->where( 'slug', $slug )->delete();
        }
        catch (\Exception $e)
        {
            $deleteCount = false;
        }
        if($deleteCount)
        {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'Deleted Selected Category' );
        }
        else {
            return redirect()->route( 'admin.threads.category.list' )->with( 'flash_message', 'Could not Delete Selected Category' );
        }
    }

}
