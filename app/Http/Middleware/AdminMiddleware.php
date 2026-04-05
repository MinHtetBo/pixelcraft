<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      if(auth()->user()){

            if(auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin'){

                if($request->route()->getName() == 'login' || $request->route()->getName() == 'register' || $request->route()->getName() == 'dashboard' ){

                    return back();

                }
                return $next($request);

            }
        return back();
      }
      return $next($request);
    }
}
