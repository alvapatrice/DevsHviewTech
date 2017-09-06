<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Dbrepos\ThreadsDbRepo as Thread;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    protected $thread;

    function __construct( Thread $thread )
    {
        $this->middleware('auth.comment');
        $this->thread = $thread;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( Requests\CommentRequest $request )
    {
        if ( $this->thread->saveComment( $request ) )
        {
            return redirect()->back();
        } else
        {
            return redirect()->back()->with( 'flash_message', 'Problem Saving Your Comment, Please try again later' );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show( $id )
    {
        if ( $data = $this->thread->getComment( $id ) )
        {
            return $data;
        } else
        {
            return false;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit( $id )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update( Request $request )
    {
        if ( $this->thread->updateComment( $request ) )
        {
            return redirect()->back();
        } else
        {
            return redirect()->back();
        }

    }

    public function like( Request $request )
    {
        if($data =  $this->thread->likeComment($request))
        {
            return $data;
        }
        else {
            return "false";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy( $id )
    {
        //
    }

}
