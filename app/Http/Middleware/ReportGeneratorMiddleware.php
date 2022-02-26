<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ReportGeneratorMiddleware
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
        if ($request->user() && $request->user()->roleNo != 10 )
        {
            return new Response(view('unauthorized')->with('role', 'Report Generator '));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
    }
}
