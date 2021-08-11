<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        if (Auth::user()->role == 'Admin') {
            return $next($request);
        } elseif (Auth::user()->role == 'Lecturer') {
            return redirect('/lecturer');
        } elseif (Auth::user()->role == 'Student') {
            return redirect('/student');
        } else {
            Session::flash('permission_warning', 'Permission not granted');
            return redirect('/');
        }
    }
}
