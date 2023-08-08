<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){

            //staff role ==0
            //agent role==1
            //super admin ==2
            //deactivate user ==3
            if(str_contains(Auth::user()->role, 'ban')){
                Auth::logout();
                return redirect('/login')->with('Fail', 'Login to access the website info');
            }else{
                return $next($request);
            }
        }else{
            return redirect('/login')->with('Fail', 'Login to access the website info');
        }

        //return $next($request);
    }
}
