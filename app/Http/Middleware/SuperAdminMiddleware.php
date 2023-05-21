<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //staff role ==0 , agent == 1, super admin ==2 deactivate user==3
        if (Auth::check()) {
            if (Auth::user()->role == "Admin") {
                return $next($request);
            } elseif (str_contains(Auth::user()->role, 'ban')) {
                Auth::logout();
                return redirect('/login')->with('message', 'Login to access the website info');
            } else {
                return redirect('/home')->with('message', 'Access Denied as you are not Super Admin!');
            }
        } else {
            return redirect('/login')->with('message', 'Login to access the website info');
        }

        //return $next($request);
    }
}
