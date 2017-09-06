<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Snippet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SnippetController extends Controller {

    protected $snippet;
    public function __construct(Snippet $snippet)
    {
        $this->snippet = $snippet;
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

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        if($request->ajax()) {
            if ( Session::token() !== $request->input('_token') ) {
                return response()->json( array(
                    'msg' => 'Token Mismatch error!'
                ) );
            }
//            $snippet = new Snippet;
//            $snippet->tag('1234');
//            $snippet->body($request->input('snippetBody'));
//            $snippet->lang('javascript');
//            $snippet->save();
            $tag = mt_rand();
            $this->snippet->insert([
               'tag' => $tag,
                'body' => $request['snippetBody'],
                'lang' => $request['snippetLang']
            ]);
            return "##". $tag. "##" ;
        }
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
		if($request->ajax()) {
            $snippet =  $this->snippet->where('tag', $id)->first();
            $snippet->body = rawurldecode($snippet->body);
            return $snippet->toJson();
        }
            $snippet =  $this->snippet->where('tag', $id)->first();
            $snippet->body = rawurldecode($snippet->body);
            return $snippet;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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

}
