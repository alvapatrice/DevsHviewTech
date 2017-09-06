<?php namespace App\Repos\Dbrepos;

use App\Book;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;

/**
 * Class BookDbRepo
 * @package App\Repos\Dbrepos
 */
class BookDbRepo {

    /**
     * @var Book
     */
    protected $book;

    /**
     * BookDbRepo constructor.
     */
    public function __construct( Book $book )
    {
        $this->book = $book;
    }


    /**
     * @param Request $request
     * @param $bookFullName
     * @return bool
     */
    public function saveToDb(Request $request, $bookFullName)
    {

        $this->book->title        =       $request->get('title');
        $this->book->slug         =       $request->get('slug');
        $this->book->book_path    =       $this->getBookPath( $bookFullName );
        $this->book->description  =       $request->get('description');
        $this->book->cover_image  =       $request->get('cover_image');
        $this->book->category_id  =       $request->get('category_id');
        $this->book->open_count   =       0;
        $this->book->book_type    =       $request->get('book_type');


        return $this->book->save();
    }

    /**
     * @param UploadedFile $book
     * @param $bookname full name of the book to be uploaded
     * @param Factory $storage
     * @return bool
     */
    public function uploadBook(UploadedFile $book, $bookname, Factory $storage)
    {
        $filesystem = new Filesystem;
        try
        {
            return $storage->disk('bookstorage')->put($bookname,  $filesystem->get($book));
        }
        catch(\Exception $e)
        {
            //if FileNotFoundException is thrown, return false
            return false;
        }
    }

    /**
     * @param int $limit
     */
    public function getPaginatedBooks( $limit = 10 )
    {
        return $this->book->paginate($limit);
    }

    /**
     * @param $id
     * @return Book|bool
     */
    public function getById( $id )
    {
        try
        {
            return $this->book->find($id);
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    /**
     * @param $bookFullName
     * @return string
     */
    protected function getBookPath( $bookFullName )
    {
        return '/books/' . $bookFullName;
    }

}