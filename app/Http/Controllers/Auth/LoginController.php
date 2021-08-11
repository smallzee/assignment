<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'matric_number';
    }

    public function login(Request $request)
    {
        $credentials = $request->only('matric_number', 'password');

        if (Auth::attempt(['matric_number' => $request->matric_number, 'password' => $request->password])) {
            if (Auth::user()->status == "Active") {
                $request->session()->regenerate();
                return redirect()->guest(route('login'));
            } else {
                Session::flash('warning', 'Your has been blocked');
                Auth::logout();
                return back()->withInput($request->all())->withErrors([
                    'matric_number' => 'Access denied! Your account has been blocked.'
                ]);
            }
        }
        Session::flash('error', 'The provided credentials do not match our records');
        return back()->withInput($request->all())->withErrors([
            'matric_number' => 'The provided credentials do not match our records.'
        ]);
    }

    public function redirectTo()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case 'Student':
                return '/student';
                break;

            case 'Lecturer':
                return '/lecturer';
                break;

            case 'Admin':
                return '/admin';
                break;
            default:
                return '/logout';
                break;
        }
    }

    public function index()
    {
        $data['title'] = 'Sign In';
        $data['nav'] = 'login';
        return view('auth.login', $data);
    }

    public function logout(Request $request)
    {
        Session::flash('success', 'Successfully Logout');
        Auth::logout();
        return redirect('login');
    }
}
