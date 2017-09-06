<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ForumReplyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() || $request->get('posttype') != null)
        {
            return $next($request);
        }
        else
        {
            return redirect()->back()->with('flash_message', 'You must be logged in to reply');
        }
    }
}
