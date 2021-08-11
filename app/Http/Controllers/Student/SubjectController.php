<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }

    public function index()
    {
        $data['title'] = 'Assignments';
        $data['sn'] = 1;
        $data['class'] = Classes::where('class_id', Auth::user()->class_id)->first();
        $data['assignments'] = Assignment::where('user_id', Auth::user()->id)->with('faculty:id,name,code')->with('dept:id,name')->with('level:id,name')->with('semester:id,name')->with('course:id,course_title,course_code')->get();
        return view('student.assignment.index', $data);
    }

    public function download_pdf()
    {
        $subjects = DB::table('users')
            ->join('results', 'results.student_id', '=', 'users.email')
            ->join('subjects', 'subjects.id', '=', 'results.subject_id')
            ->where('users.email', Auth::user()->email)
            ->where('results.student_id', Auth::user()->email)
            ->select('results.*', 'users.*', 'subjects.*')
            ->get();
        $sn = 1;
        $class = Classes::where('class_id', Auth::user()->class_id)->first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf->loadView('result', compact(['subjects', 'sn', 'class']));
        return $pdf->download(Auth::user()->surname . ' ' . Auth::user()->last_name . ' ' . $class->name . ' result.pdf');
    }

    public function submit(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'semester_id' => ['required', 'max:255'],
                'course_id' => ['required', 'max:255'],
                'assignment' => ['required', 'mimes:jpg,jpeg,png,xlsx,xls,docx,csv,txt,doc,pdf', 'max:10000']
            );
            $fieldNames = array(
                'semester_id' => 'Semester',
                'course_id'     => 'Course',
                'assignment'     => 'Assignment',
            );
            //dd($request->all());
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                //dd($request->all());
                if ($request->file('assignment')) {
                    $file = $request->file('assignment');
                    $picture = 'Assignment' . Auth::user()->matric_number . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
                    $pictureDestination = 'uploads/student_assignment';
                    $file->move($pictureDestination, $picture);
                }
                $user = new Assignment();
                $user->user_id = Auth::user()->id;
                $user->faculty_id = Auth::user()->faculty_id;
                $user->dept_id = Auth::user()->dept_id;
                $user->level_id = Auth::user()->level_id;
                $user->semester_id = $request->semester_id;
                $user->course_id = $request->course_id;
                $user->assignment = $request->hasFile('assignment') ? $picture : $user->assignment;
                $user->save();
                Session::flash('success', 'Assignment Submitted Successfully');
                return redirect('student/assignments');
            }
        } else {
            $data['title'] = 'Submit Assignment';
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
            $data['courses'] = $f = Course::where(['faculty_id' => Auth::user()->faculty_id, 'department_id' => Auth::user()->dept_id, 'level' => Auth::user()->level_id])->with('faculty:id,name,code')->with('dept:id,name')->with('level_get:id,name')->with('semester_get:id,name')->orderBy('id', 'ASC')->get();
            return view('student.assignment.submit', $data);
        }
    }

    public function course(Request $request)
    {
        try {
            $courses = Course::where(['faculty_id' => Auth::user()->faculty_id, 'department_id' => Auth::user()->dept_id, 'level' => Auth::user()->level_id, 'semester' => $request->semester_id])->orderBy('id', 'ASC')->get();
            return $courses;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete_assignment($id)
    {
        try {
            $delete = Assignment::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
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
