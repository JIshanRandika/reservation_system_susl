<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AVUCoordinator
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
        if ($request->user() && $request->user()->roleNo != 4)
        {
            return new Response(view('unauthorized')->with('role', 'Audio Visual Unit Coordinator'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
       
    }
}
