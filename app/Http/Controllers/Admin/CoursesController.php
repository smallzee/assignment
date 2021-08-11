<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new Course();
    }
    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->course_id) {
                $rules['faculty_id'] = ['required', 'max:255'];
                if ($request->has('check')) {
                } else {
                    $rules['department_id'] = ['required', 'max:255'];
                }
                $rules['semester'] = ['required', 'max:255'];
                $rules['level'] = ['required', 'max:255'];
                $rules['course_title'] = ['required', 'max:255', 'unique:courses,course_title,' . $request->course_id];
                $rules['course_code'] = ['required', 'max:255', 'unique:courses,course_code,' . $request->course_id];
                $fieldNames = array(
                    'faculty_id'   => 'Faculty',
                    'department_id' => 'Department',
                    'level' => 'Level',
                    'course_title' => 'Course Title',
                    'course_code' => 'Course Code',
                );
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $c = Course::find($request->course_id);
                        $c->faculty_id = $request->faculty_id;
                        if ($request->has('department_id')) {
                            $c->department_id = $request->department_id;
                        } else {
                            $c->department_id = 0;
                        }
                        $c->semester = $request->semester;
                        $c->course_title = $request->course_title;
                        $c->course_code = $request->course_code;
                        $c->save();
                        Session::flash('success', 'Course Updated Successfully');
                        return redirect('admin/courses');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
                $rules['faculty_id'] = ['required', 'max:255'];
                if ($request->has('check')) {
                } else {
                    $rules['department_id'] = ['required', 'max:255'];
                }
                $rules['semester'] = ['required', 'max:255'];
                $rules['level'] = ['required', 'max:255'];
                $rules['course_title'] = ['required', 'max:255', 'unique:courses'];
                $rules['course_code'] = ['required', 'max:255', 'unique:courses'];
                $fieldNames = array(
                    'faculty_id'   => 'Faculty',
                    'department_id' => 'Department',
                    'level' => 'Level',
                    'course_title' => 'Course Title',
                    'course_code' => 'Course Code',
                );
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $check = Course::where(['course_title' => $request->course_title, 'faculty_id' => $request->faculty_id, 'course_code' => $request->course_code])->count();
                        if ($check > 0) {
                            Session::flash('error', 'Course has already been created');
                            return \back();
                        } else {
                            try {
                                //dd($request->all());
                                $this->create_new->create($request);
                                Session::flash('success', 'Course Added Successfully');
                                return redirect('admin/courses');
                            } catch (\Throwable $th) {
                                Session::flash('error', $th->getMessage());
                                return \back();
                            }
                        }
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['departments'] = Department::with('faculty:id,name,code')->orderBy('id', 'ASC')->get();
            $data['faculties'] = Faculties::orderBy('id', 'ASC')->get();
            $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['courses'] = $f = Course::with('faculty:id,name,code')->with('dept:id,name')->with('level_get:id,name')->with('semester_get:id,name')->orderBy('id', 'ASC')->get();
            //dd($f);
            $data['title'] = 'Courses';
            $data['sn'] = 1;
            $data['mode'] = 'create';
            return view('admin.courses.index', $data);
        }
    }

    public function create_page()
    {
        $data['title'] = 'Create Course';
        $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
        $data['departments'] = Department::orderBy('name', 'ASC')->get();
        $data['levels'] = Level::orderBy('id', 'ASC')->get();
        $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
        return view('admin.courses.create', $data);
    }

    public function dept(Request $request)
    {
        try {
            $departments = Department::where('faculty_id', $request->id)->orderBy('name', 'ASC')->get();
            return $departments;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function edit($id)
    {
        try {
            $data["course"] = $c = Course::find($id);
            //dd($c);
            $data['title'] = 'Edit Course ' . $c->name;
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['semesters'] = Semester::orderBy('id', 'ASC')->get();
            return view('admin.courses.create', $data);
        } catch (\Throwable $th) {
            Session::flash('eror', $th->getMessage());
            return back();
        }
    }

    public function view($faculty_id, $dept_id, $level_id, $semester_id, $course_id)
    {
        try {
            $data['faculty'] = Faculties::find($faculty_id);
            $data['department'] = Department::find($dept_id);
            $data['level'] = Level::find($level_id);
            $data['semester'] = Semester::find($semester_id);
            $data["course"] = $c = Course::find($course_id);
            $data['title'] = $c->name . ' Details';
            //dd($c);
            return view('admin.courses.view', $data);
        } catch (\Throwable $th) {
            Session::flash('eror', $th->getMessage());
            return back();
        }
    }

    public function delete($id)
    {
        try {
            Course::find($id)->delete();
            Session::flash('success', 'Course Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            Session::flash('eror', $th->getMessage());
            return back();
        }
    }
}
