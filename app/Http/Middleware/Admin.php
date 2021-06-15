<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->usertype ='Admin') {
                return redirect()->route('home');
            }elseif (Auth::user()->usertype ='User') {
              return redirect()->route('admin.dashboard');
            }
        }else{
          return redirect()->route('login');
        }
        //return $next($request);
    }
}
