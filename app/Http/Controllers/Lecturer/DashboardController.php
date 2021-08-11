<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lecturer');
    }

    public function index()
    {
        $data['title'] = 'My Dashboard';
        $data['class'] = Classes::where('class_id', Auth::user()->class_id)->first();
        $data['student'] = $u = User::where('id', Auth::user()->id)->with('faculty:id,name')->with('dept:id,name')->with('level:id,name')->with('course:id,course_title,course_code')->first();
        return view('lecturer.dashboard.index', $data);
    }
}
