<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new User();
    }

    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'surname' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'subject_id' => ['required']
                );
                $fieldNames = array(
                    'surname'   => 'Surname',
                    'last_name' => 'Last Name',
                    'subject_id' => 'Subject'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        try {
                            $check = User::where(['role' => 'Teacher', 'class_id' => $request->subject_id])->count();
                            if ($check > 0) {
                                Session::flash('error', 'A teacher has been assigned to this subject');
                                return \back();
                            } else {
                                $user = User::find($request->id);
                                $user->surname = $request->surname;
                                $user->last_name = $request->last_name;
                                $user->class_id = $request->subject_id;
                                $user->save();
                                $subject = Subject::find($request->subject_id);
                                $subject->teacher_id = $request->id;
                                $subject->save();
                                Session::flash('success', 'Teacher Updated Successfully');
                                return redirect('admin/teachers');
                            }
                        } catch (\Throwable $th) {
                            Session::flash('error', $th->getMessage());
                            return \back();
                        }
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
                $rules = array(
                    'surname' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'subject_id' => ['required']
                );
                $fieldNames = array(
                    'surname'   => 'Surname',
                    'last_name' => 'Last Name',
                    'subject_id' => 'Subject'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        try {
                            $check = User::where(['role' => 'Teacher', 'class_id' => $request->subject_id])->count();
                            if ($check > 0) {
                                Session::flash('error', 'A teacher has been assigned to this subject');
                                return \back();
                            } else {
                                $teacher = $this->create_new->create($request);
                                $subject = Subject::find($request->subject_id);
                                $subject->teacher_id = $teacher->id;
                                $subject->save();
                                Session::flash('success', 'Teacher Created Successfully');
                                return \back();
                            }
                            
                        } catch (\Throwable $th) {
                            Session::flash('error', $th->getMessage());
                            return \back();
                        }
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['teachers'] = User::where('role', 'Teacher')->with('subjects:id,name')->paginate(15);
            $data['title'] = 'Teachers';
            $data['sn'] = 1;
            $data['mode'] = 'create';
            $data['subjects'] = Subject::all();
            return view('admin.teachers.index', $data);
        }
    }

    public function edit($id)
    {
        try {
            $data['teacher_one'] = User::where(['id' => $id, 'role' => 'Teacher'])->first();
            $data['teachers'] = User::where('role', 'Teacher')->with('subjects:id,name')->paginate(15);
            $data['title'] = 'Teachers';
            $data['sn'] = 1;
            $data['mode'] = 'edit';
            $data['subjects'] = Subject::all();
            return view('admin.teachers.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function block($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Teacher', 'status' => 'Active'])->first();
            $check->status = 'Blocked';
            $check->save();
            Session::flash('success', 'Teacher Blocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function unblock($id)
    {
        try {
            $check = User::where(['id' => $id, 'role' => 'Teacher', 'status' => 'Blocked'])->first();
            $check->status = 'Active';
            $check->save();
            Session::flash('success', 'Teacher Unblocked Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            $teacher = User::where(['id' => $id, 'role' => 'Teacher'])->first();
            $check = Subject::where('teacher_id', $id)->first();
            $check->teacher_id = null;
            $check->save();
            $teacher->delete();
            Session::flash('success', 'Teacher Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
