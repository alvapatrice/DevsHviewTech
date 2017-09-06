<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Repos\Subscriber\SubscriptionHandler;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
    protected  $redirectTo = '/';

	public function __construct(Request $request)
	{
		$this->middleware('remember.url');
		$this->redirectTo = (Session::has('redirectAfterLogin')) ? Session::get('redirectAfterLogin') : '/';
		$this->page_title = 'Login';
        $this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'type' => 4
		]);
	}


	/**
	 * Subscribe New User
	 *
	 * @param Request $request
	 * @return message string
     */
	public function subscribe( Request $request )
	{
		if( ! $request->isXmlHttpRequest())
		{
			return "false";
		}
		$subscriptionHandler = new SubscriptionHandler($this);
		return $subscriptionHandler->subscribe($request);
	}

	public function subscription_failed($message )
	{
		return "false";
//		return redirect()->back()->with('flash_message', $message);
	}

	public function subscription_succeed( $message )
	{
		return "true";
//		return redirect()->back()->with('flash_message', $message);
	}
}
