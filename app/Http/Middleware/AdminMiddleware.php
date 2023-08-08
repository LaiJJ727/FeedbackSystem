<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            //staff role ==0
            //agent role==1
            //super admin ==2
            //deactivate user==3
            if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Agent' || Auth::user()->role == 'Housekeep') {
                return $next($request);
            } elseif (str_contains(Auth::user()->role, 'ban')) {
                Auth::logout();
                return redirect('/login')->with('Fail', 'Login to access the website info');
            } else {
                return redirect('/home')->with('Fail', 'Access Denied as you are not Admin!');
            }
        } else {
            return redirect('/login')->with('Fail', 'Login to access the website info');
        }
        // return $next($request);
    }
}
