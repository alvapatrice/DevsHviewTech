<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Http\Request;
use App\Repos\Dbrepos\UserDbRepo as User;
use Illuminate\Contracts\Auth\Guard as Auth;

class SocialLoginController extends Controller {

    /**
     * @var Socialite
     */
    protected $socialite;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @param Socialite $socialite
     * @param User $user
     * @param Auth $auth
     */
    function __construct(Socialite $socialite, User $user, Auth $auth)
    {
        $this->socialite = $socialite;
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * @param $provider
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login($provider, Request $request)
    {
        return $this->execute($provider, $request->has('code'));
	}

    /**
     * @param $provider
     * @param $hasCode
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function execute($provider, $hasCode)
    {
        if( ! $hasCode)
        {
            return $this->getAuthorization($provider);

        }
        $user = $this->user->findByUsernameOrCreate($this->socialUser($provider));
        $this->auth->login($user, true);
        return redirect()->route('home');
    }

    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getAuthorization($provider)
    {
        if($provider == 'github')
        {
            return $this->socialite->driver($provider)->scopes(['user:email'])->redirect();
        }
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Laravel\Socialite\Contracts\User
     */
    public function socialUser($provider)
    {
        return $this->socialite->driver($provider)->user();;
    }

}
