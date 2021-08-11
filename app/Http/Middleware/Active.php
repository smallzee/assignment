<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Active
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
        if (Auth::user()->status == "Active") {
            return $next($request);
        }else{
            Session::flash('warning', 'Your has been blocked');
            Auth::logout();
            return back()->withInput($request->all())->withErrors([
                'matric_number' => 'Access denied! Your account has been blocked.'
            ]);
        }
        return $next($request);
    }
}
