<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\UsersImport;
use App\Models\Result;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
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
        $data['title'] = 'All Students';
        $data['sn'] = 1;
        $data['students'] = User::where('role', 'Student')->with('faculty:id,name')->with('dept:id,name')->paginate(15);
        return view('admin.students.index', $data);
    }

    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'faculty_id' => ['required', 'max:255'],
                    'department_id' => ['required', 'max:255'],
                    'level_id' => ['required', 'max:255'],
                    'matric_number' => ['required', 'max:255', 'unique:users,matric_number,' . $request->id],
                    'email' => ['required', 'max:255', 'unique:users,email,' . $request->id],
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                );
                $fieldNames = array(
                    'faculty_id'   => 'Student Faculty',
                    'department_id' => 'Student Department',
                    'level_id'   => 'Student Level',
                    'matric_number' => 'Student Matric Number',
                    'first_name'   => 'Student First Name',
                    'last_name' => 'Student Last Name',
                    'email' => 'Student Email',
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
                        $user->matric_number = $request->matric_number;
                        $user->first_name = $request->first_name;
                        $user->last_name = $request->last_name;
                        $user->faculty_id = $request->faculty_id;
                        $user->dept_id = $request->department_id;
                        $user->level_id = $request->level_id;
                        $user->save();
                        // $this->check_student();
                        Session::flash('success', 'Student Updated Successfully');
                        return redirect('admin/students');
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
                    'matric_number' => ['required', 'max:255', 'unique:users,matric_number'],
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'email' => ['required', 'max:255', 'email', 'unique:users,email'],
                );
                $fieldNames = array(
                    'faculty_id'   => 'Student Faculty',
                    'department_id' => 'Student Department',
                    'level_id'   => 'Student Level',
                    'matric_number' => 'Student Matric Number',
                    'first_name'   => 'Student First Name',
                    'last_name' => 'Student Last Name',
                    'email' => 'Student Email'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $this->create_new->create_student($request);
                        // $this->check_student();
                        Session::flash('success', 'Student Created Successfully');
                        return redirect('admin/students');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['title'] = 'Create New Students';
            $data['sn'] = 1;
            $data['mode'] = 'create';
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['classes'] = Classes::all()->groupBy('class_id');
            return view('admin.students.create', $data);
        }
    }


    public function create_bulk(Request $request)
    {
        $rules = array(
            'bulk_faculty_id' => ['required', 'max:255'],
            'bulk_department_id' => ['required', 'max:255'],
            'bulk_level_id' => ['required', 'max:255'],
            'bulk_student' => ['required', 'mimes:csv,xlsx,xls'],
        );
        $fieldNames = array(
            'bulk_faculty_id'   => 'Student Faculty',
            'bulk_department_id' => 'Student Department',
            'bulk_level_id'   => 'Student Level',
            'bulk_student'   => 'Student Bulk File',
        );
        //dd($request->all());
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $request->session()->put('bulk_faculty_id', $request->bulk_faculty_id);
                $request->session()->put('bulk_department_id', $request->bulk_department_id);
                $request->session()->put('bulk_level_id', $request->bulk_level_id);
                Excel::import(new UsersImport, request()->file('bulk_student'));
                // $this->check_student();
                Session::flash('success', 'Student Uploaded Successfully');
                $request->session()->forget('bulk_faculty_id');
                $request->session()->forget('bulk_department_id');
                $request->session()->forget('bulk_level_id');
                return redirect('admin/students');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function edit($id)
    {
        try {
            $data['student'] = User::where(['id' => $id, 'role' => 'Student'])->first();
            $data['title'] = 'Edit Student';
            $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
            $data['departments'] = Department::orderBy('name', 'ASC')->get();
            $data['levels'] = Level::orderBy('id', 'ASC')->get();
            $data['classes'] = Classes::all()->groupBy('class_id');
            return view('admin.students.edit', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }


    public function view($id)
    {
        try {
            $data['student'] = $u = User::where(['id' => $id, 'role' => 'Student'])->with('faculty:id,name')->with('dept:id,name')->with('level:id,name')->first();
            $data['title'] = $u->first_name . ' ' . $u->last_name;
            return view('admin.students.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function block($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Student', 'status' => 'Active'])->first();
            $check->status = 'Blocked';
            $check->save();
            Session::flash('success', 'Student Blocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function unblock($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Student', 'status' => 'Blocked'])->first();
            $check->status = 'Active';
            $check->save();
            Session::flash('success', 'Student Unblocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            $teacher = User::where(['id' => $id, 'role' => 'Student'])->first();
            $teacher->delete();
            Session::flash('success', 'Student Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    // public function check_student()
    // {
    //     $check = User::where('role', 'Student')->get();
    //     foreach ($check as $students) {
    //         $chk = Result::where('student_id', $students->email)->get();
    //         if ($chk->count() < 1) {
    //             $class = Classes::where('class_id', $students->class_id)->get();
    //             foreach ($class as $subject) {
    //                 $this->create_new_result->create($subject, $students->email);
    //             }
    //         } elseif ($chk->count() > 0) {
    //             $subjects = Classes::where('class_id', $students->class_id)->pluck('subject_id');
    //             $chk_std = Result::where('student_id', $students->email)->pluck('subject_id');
    //             $subject_id = json_decode($subjects);
    //             $chk_std = json_decode($chk_std);
    //             $different = array_diff($subject_id, $chk_std);
    //             if ($different != null) {
    //                 foreach ($different as $diff) {
    //                     $subjects = Classes::where('subject_id', $diff)->get();
    //                     $this->create_new_result->update_now($subjects, $students->email);
    //                 }
    //             }
    //         }
    //     }
    // }
}
