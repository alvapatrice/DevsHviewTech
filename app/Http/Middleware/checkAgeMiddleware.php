<?php namespace App\Http\Middleware;

use Closure;

class checkAgeMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if( $request->input('userage') < 100 )
        {
            return redirect('home');
        }
		return $next($request);
	}

}
