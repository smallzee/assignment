<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new Classes();
    }

    public function index()
    {
        $data['title'] = 'Classes';
        return view('admin.classes.index', $data);
    }

    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'name' => ['required', 'max:255'],
                    'subject' => ['required']
                );
                $fieldNames = array(
                    'name'     => 'Class Name',
                    'subject' => 'Subject'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $class = Classes::where('class_id', $request->class_id)->get();
                        $subjects = Classes::where('class_id', $request->class_id)->pluck('subject_id');
                        $subject_id = json_decode($subjects);
                        if (count($request->subject) >= count($subject_id)) {
                            $different = array_diff($request->subject,$subject_id);
                            if($different != null){
                                $this->create_new->update_now($request, $different);
                            }
                            Session::flash('success', 'Class Updated Successfully');
                            return redirect('admin/classes');
                        } else {
                            $different = array_diff($subject_id,$request->subject);
                            foreach ($different as $diff) {
                                Classes::where(['class_id' => $request->class_id, 'subject_id' => $diff])->delete();
                            }
                        }
                        Session::flash('success', 'Class Updated Successfully');
                        return redirect('admin/classes');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
                $rules = array(
                    'name' => ['required', 'max:255', 'unique:classes'],
                    'subject' => ['required']
                );
                $fieldNames = array(
                    'name'     => 'Class Name',
                    'subject' => 'Subject'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $request->session()->put('class_unique', mt_rand(1000, 9999));
                        $this->create_new->create($request);
                        Session::flash('success', 'Class Created Successfully');
                        return \back();
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        } else {
            $data['title'] = 'Create Class';
            $data['mode'] = 'create';
            $data['sn'] = 1;
            $data['classes'] = Classes::all()->groupBy('name');
            $data['subjects'] = Subject::all();
            return view('admin.classes.index', $data);
        }
    }

    public function edit($id)
    {
        try {
            $data['title'] = 'Edit Class';
            $data['mode'] = 'edit';
            $data['sn'] = 1;
            $data['classes'] = Classes::all()->groupBy('name');
            $data['subjects'] = Subject::all();
            $data['class_me'] = $class = Classes::where('class_id', $id)->with('subject:id,name')->get()->groupBy('class_id');
            $data['class_id'] = $id;
            $subjects = Classes::where('class_id', $id)->pluck('subject_id');
            $data['subs'] = json_decode($subjects);
            return view('admin.classes.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view($id)
    {
        try {
            $data['title'] = 'View Class';
            $data['sn'] = 1;
            $data['classes'] = Classes::simplePaginate(10);
            $data['class'] = $class_1 = Classes::where('class_id', $id)->first();
            $data['subjects'] = $subject = Subject::with('teacher:id,surname,last_name')->get();
            $data['subject_id'] = $class = Classes::where('class_id', $id)->with('subject:id,name')->with('teacher:id,surname,last_name')->get();
            $data['students'] = $student =  User::where(['class_id' => $id, 'role' => 'Student'])->get();
            //dd($student);
            return view('admin.classes.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            $student = User::where(['role' => 'Student', 'class_id' => $id])->count();
            dd($student);
            if($student <= 0)
            {
                Classes::where('class_id', $id)->delete();
                Session::flash('success', 'Class Deleted Successfully');
                return redirect('admin/classes');
            }else{
                Session::flash('error', 'Student is available for this class, can not delete');
                return redirect('admin/classes');
            }
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
