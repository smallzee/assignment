<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\UsersImport;
use App\Models\Course;
use App\Models\Result;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new User();
        $this->create_new_result = new Result();
    }

    public function index()
    {
        $data['title'] = 'All Lecturer';
        $data['sn'] = 1;
        $data['lecturers'] = User::where('role', 'Lecturer')->with('faculty:id,name')->with('dept:id,name')->with('course:id,course_title,course_code')->paginate(15);
        return view('admin.lecturer.index', $data);
    }

    
    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'faculty_id' => ['required', 'max:255'],
                    'department_id' => ['required', 'max:255'],
                    'level_id' => ['required', 'max:255'],
                    'course_id' => ['required', 'max:255'],
                    'semester_id' => ['required', 'max:255'],
                    'lecturer_id' => ['required', 'max:255', 'unique:users,matric_number,'.$request->id],
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'email' => ['required', 'max:255', 'email', 'unique:users,email,'.$request->id],
                );
                $fieldNames = array(
                    'faculty_id'   => 'Lecturer Faculty',
                    'department_id' => 'Lecturer Department',
                    'course_id' => 'Lecturer Course',
                    'level_id' => 'Level',
                    'semester_id' => 'Semester',
                    'lecturer_id'   => 'Lecturer ID',
                    'first_name'   => 'Lecturer First Name',
                    'last_name' => 'Lecturer Last Name',
                    'email' => 'Lecturer Email'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $user = User::find($request->id);
                        $user->email = $request->email;
                        $user->matric_number = $request->lecturer_id;
                        $user->first_name = $request->first_name;
                        $user->last_name = $request->last_name;
                        $user->faculty_id = $request->faculty_id;
                        $user->dept_id = $request->department_id;
                        $user->level_id = $request->level_id;
                        $user->course_id = $request->course_id;
                        $user->save();
                        // $this->check_student();
                        Session::flash('success', 'Lecturer Updated Successfully');
                        return redirect('admin/lecturers');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
                $rules = array(
                    'faculty_id' => ['required', 'max:255'],
                    'department_id' => ['required', 'max:255'],
                    'level_id' => ['required', 'max:255'],
                    'course_id' => ['required', 'max:255'],
                    'semester_id' => ['required', 'max:255'],
                    'lecturer_id' => ['required', 'max:255', 'unique:users,matric_number'],
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'email' => ['required', 'max:255', 'email', 'unique:users,email'],
                );
                $fieldNames = array(
                    'faculty_id'   => 'Lecturer Faculty',
                    'department_id' => 'Lecturer Department',
                    'course_id' => 'Lecturer Course',
                    'level_id' => 'Level',
                    'semester_id' => 'Semester',
                    'lecturer_id'   => 'Lecturer ID',
                    'first_name'   => 'Lecturer First Name',
                    'last_name' => 'Lecturer Last Name',
                    'email' => 'Lecturer Email'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $this->create_new->create_lecturer($request);
                        // $this->check_student();
                        Session::flash('success', 'Lecturer Created Successfully');
                        return redirect('admin/lecturers');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['title'] = 'Add New Lecturer';
            $data['sn'] = 1;
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['courses'] = Course::orderBy('id', 'ASC')->get();
            $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
            $data['classes'] = Classes::all()->groupBy('class_id');
            return view('admin.lecturer.create', $data);
        }
    }

    public function view($id)
    {
        try {
            $data['lecturer'] = $u = User::where(['id' => $id, 'role' => 'Lecturer'])->with('faculty:id,name')->with('dept:id,name')->with('level:id,name')->first();
            $data['title'] = $u->first_name . ' ' . $u->last_name;
            return view('admin.lecturer.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }


    public function course(Request $request)
    {
        try {
            $course = Course::where(['faculty_id' => $request->faculty_id, 'department_id' => $request->department_id, 'level' => $request->level_id, 'semester' => $request->semester_id])->orderBy('course_title', 'ASC')->get();
            return $course;
        } catch (\Throwable $th) {
            return false;
        }
    }

    
    public function edit($id)
    {
        try {
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['courses'] = Course::orderBy('id', 'ASC')->get();
            $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
            $data['classes'] = Classes::all()->groupBy('class_id');
            $data['lecturer'] = User::where(['id' => $id, 'role' => 'Lecturer'])->first();
            $data['title'] = 'Edit Lecturer';
            $data['sn'] = 1;
            $data['mode'] = 'edit';
            return view('admin.lecturer.edit', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function block($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Lecturer', 'status' => 'Active'])->first();
            $check->status = 'Blocked';
            $check->save();
            Session::flash('success', 'Lecturer Blocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function unblock($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Lecturer', 'status' => 'Blocked'])->first();
            $check->status = 'Active';
            $check->save();
            Session::flash('success', 'Lecturer Unblocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            $teacher = User::where(['id' => $id, 'role' => 'Lecturer'])->first();
            // $check = Subject::where('teacher_id', $id)->first();
            // $check->teacher_id = null;
            // $check->save();
            $teacher->delete();
            Session::flash('success', 'Lecturer Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}

