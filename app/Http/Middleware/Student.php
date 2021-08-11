<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Student
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
        //dd(Auth::user());
        if (Auth::user()->role == 'Student') {
            return $next($request);
        } elseif (Auth::user()->role == 'Lecturer') {
            return redirect('/lecturer');
        } elseif (Auth::user()->role == 'Admin') {
            return redirect('/admin');
        } else {
            Session::flash('permission_warning', 'Permission not granted');
            return redirect('/');
        }
    }
}
