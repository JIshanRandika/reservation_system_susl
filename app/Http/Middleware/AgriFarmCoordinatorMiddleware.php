<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class AgriFarmCoordinatorMiddleware
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
        if ($request->user() && $request->user()->roleNo != 3)
        {
            return new Response(view('unauthorized')->with('role', 'Agri Farm Coordinator'));
        }
        else if(Auth::check())
        {
            return $next($request);
        }
          return redirect('/login');
       
    }
}
