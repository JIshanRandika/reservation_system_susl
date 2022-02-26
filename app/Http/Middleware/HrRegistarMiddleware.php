<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HrRegistarMiddleware
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
        if ($request->user() && $request->user()->roleNo != 7 )
        {
            return new Response(view('unauthorized')->with('role', 'Admin Registrar'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
    }
}
