<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lecturer');
    }

    public function index()
    {
        $data['title'] = 'Assignments';
        $data['sn'] = 1;
        $data['lecturer'] = $u = User::where('id', Auth::user()->id)->with('faculty:id,name')->with('dept:id,name')->with('course:id,course_title,course_code')->first();
        $data['class'] = Classes::where('class_id', Auth::user()->class_id)->first();
        $data['assignments'] = Assignment::where('course_id', Auth::user()->course_id)->with('student:id,first_name,last_name,matric_number')->with('faculty:id,name,code')->with('dept:id,name')->with('level:id,name')->with('semester:id,name')->with('course:id,course_title,course_code')->get();
        return view('lecturer.assignment.index', $data);
    }

    public function delete_assignment($id)
    {
        try {
            $delete = Assignment::where(['course_id' => Auth::user()->course_id, 'id' => $id])->first();
            if (File::exists(public_path('uploads/student_assignment/'.$delete->assignment))) {
                File::delete(public_path('uploads/student_assignment/'.$delete->assignment));
            }
            Session::flash('success', "Assignment Deleted Successfully");
            $delete->delete();
            return back();
        } catch (\Throwable $th) {
            Session::flash('error', "Assignment not Delete");
            return back();
        }
    }
}
