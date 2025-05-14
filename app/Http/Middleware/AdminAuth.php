<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::User() && Auth::user()->hasRole('admin')) {
            return $next($request);
        } else {
            //Auth::logout();
            return redirect('/login');
            //return response()->json(['status' => 400, 'message' => 'you are not admin']);
        }
       // return $next($request);
    }
}
