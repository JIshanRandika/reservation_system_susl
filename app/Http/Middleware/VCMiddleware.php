<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class VCMiddleware
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
        if ($request->user() && $request->user()->roleNo != 2)
        {
            return new Response(view('unauthorized')->with('role', 'VC'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
       
    }
}
