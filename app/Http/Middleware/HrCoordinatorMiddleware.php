<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HrCoordinatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->roleNo != 5)
        {
            return new Response(view('unauthorized')->with('role', 'Holiday Resort Coordinator'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
    }
}
