<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CareTakerMiddleware
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
        if ($request->user() && $request->user()->roleNo != 9 )
        {
            return new Response(view('unauthorized')->with('role', 'Care Taker'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
    }
}
