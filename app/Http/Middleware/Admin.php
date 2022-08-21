<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Illuminate\Http\Request;

class Admin
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
        if( !Auth::user()->is_admin() ){ // user not admin
            Session::flash('info', 'You are not allowed to access the page');
            return redirect()->back();
        }
        return $next($request);
    }
}
