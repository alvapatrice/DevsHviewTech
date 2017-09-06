<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetRedirectPath {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $this->getRedirectPath($request);
		return $next($request);
	}
    protected function getRedirectPath(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $previousUrl = redirect()->back()->getTargetUrl();

            $path = substr($previousUrl , strlen(route('home')), strlen($previousUrl));

            $path = (!$path ) ? '/': $path;

            if($path != '/auth/login' && $path != '/auth/register')
            {
                Session::put('redirectAfterLogin', $path);
                return;
            }
        }
    }

}
