<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Repos\Dbrepos\BookDbRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Filesystem\Factory as Storage;

/**
 * Class BooksController
 * @package App\Http\Controllers
 */
class BooksController extends Controller
{

    /**
     * @var Book
     */
    protected $book;
    /**
     * @var Category
     */
    protected $categories;

    /**
     * @param Book $book
     * @param Category $category
     */
    public function __construct( Book $book, Category $category)
    {
        $this->book = $book;
        $this->categories = $category;
    }

    /**
     * @return bool
     */
    protected function isAdminRequest()
    {
        return (Route::getCurrentRoute()->getPrefix() == '/admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BookDbRepo $bookDbRepo)
    {
        if($this->isAdminRequest())
        {
            $page_title = 'All Books';
            $books = $bookDbRepo->getPaginatedBooks(10);
            return view('admin.books.index', compact('page_title', 'books'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if($this->isAdminRequest())
        {
            $page_title = 'Add new Book';
            $categories = $this->categories->lists('title', 'id');
            return view('admin.books.create', compact('page_title', 'categories'));
        }
    }

    /**
     * @param Request $request
     * @param Storage $storage
     * @param BookDbRepo $bookDbRepo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Storage $storage, BookDbRepo $bookDbRepo)
    {
        if($this->isAdminRequest())
        {
                $book = $request->file('pdf');

                $timestamp = $this->getTimestamp();

                $bookFullName = $this->getBookFullName( $timestamp, $book );

                $bookDbRepo->uploadBook($book, $bookFullName, $storage);

                $bookDbRepo->saveToDb($request, $bookFullName);

                return redirect()->back()->with('flash_message', 'Book Uploaded Successfully');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function download(BookDbRepo $bookDbRepo,  $id )
    {
        $book = $bookDbRepo->getById($id);

        if( ! $book)
        {
            return redirect()->back()->with('error_message', 'No Book Exist with this ID');
        }

        $book_path = storage_path(). '/app' . $book->book_path;

        return response()->download($book_path);

    }

    /**
     * @return mixed
     */
    protected function getTimestamp()
    {
        return str_replace( [' ', ':'], '-', Carbon::now()->toDateTimeString() );
    }

    /**
     * @param $timestamp
     * @param $book
     * @return string
     */
    protected function getBookFullName( $timestamp, $book )
    {
        return $timestamp . '-' . $book->getClientOriginalName();
    }
}
