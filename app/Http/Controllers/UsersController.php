<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Dbrepos\UserDbRepo as User;
use Illuminate\Http\Request;

class UsersController extends Controller {

    protected $user;

    /**
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    public function adminHome()
    {
        return view( 'admin.dashboard' );
    }

    public function index()
    {
        $users = $this->user->getPaginatedUsers( 10 );
        $page_title = 'All Users List';
        return view( 'admin.users', compact( 'users', 'page_title' ) );
    }

    public function show( $id )
    {
        if ( $user = $this->user->getUserInfoById( $id ) )
        {
            return view( 'user.single', compact( 'user' ) );
        }
        return redirect()->back()->with( 'flash_message', 'Could not fetch User Info' );
    }

    public function create()
    {
        $user_type = [0, 1, 2, 3, 4];
        $user_status = [0, 1];
        $page_title = 'Create New User';
        return view('admin.createUser', compact('user_type', 'user_status', 'page_title'));
    }

    public function store( Requests\UserCreateRequest $request )
    {
        $status = $this->user->create($request);
        if($status)
        {
            return redirect()->route('admin.user.list')->with('flash_message', 'New user created');
        }
        else {
            return redirect()->route('admin.user.list')->with('flash_message', 'Could not create user');

        }
    }

    public function edit( $id )
    {
        $user_type = [0, 1, 2, 3, 4];
        $user_status = [0, 1];
        $user = $this->user->getUserInfoById( $id );
        if ( $user )
        {
            return view( 'admin.editUser', compact( 'user', 'user_type', 'user_status' ) );
        }
    }

    public function update( $id, Request $request )
    {
        $status = $this->user->update( $id, $request );

        if ( $status )
        {
            return redirect()->route( 'admin.user.list' )->with( 'flash_message', 'User Has Been updated' );
        } else
        {
            return redirect()->route( 'admin.user.list' )->with( 'flash_message', 'Could Not update User' );

        }

    }

    public function destroy( $id )
    {
        $deleteCount = $this->user->delete($id);

        if($deleteCount)
        {
            return redirect()->route('admin.user.list')->with('flash_message', 'User Has Been deleted');
        }
        else {
            return redirect()->route('admin.user.list')->with('flash_message', 'Could not delete user');
        }

    }
}
