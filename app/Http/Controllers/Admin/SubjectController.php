<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_new = new Subject();
    }

    public function index()
    {
        // $data['teachers'] = User::where('role', 'Teacher')->paginate(15);
        $data['title'] = 'Subjects';
        return view('admin.subject.index', $data);
    }

    public function create(Request $request)
    {
        if($_POST){
            if($request->id){
                $rules = array(
                    'name' => ['required', 'max:255'],
                );
                $fieldNames = array(
                    'name'     => 'Subject Name'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        // dd($request->all());
                        $subject = Subject::find($request->id);
                        $subject->name = $request->name;
                        $subject->save();
                        Session::flash('success', 'Subject Updated Successfully');
                        return redirect('admin/subjects');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }else{
                $rules = array(
                    'name' => ['required', 'max:255', 'unique:subjects'],
                );
                $fieldNames = array(
                    'name'     => 'Subject Name'
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $this->create_new->create($request);
                        Session::flash('success', 'Subject Created Successfully');
                        return \back();
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            }
        }else{            
            $data['sn'] = 1;
            $data['title'] = 'Create Subjects';
            $data['mode'] = 'create';
            $data['subjects'] = Subject::simplePaginate(10);
            return view('admin.subject.index', $data);
        }
    }

    public function edit($id)
    {
        try {            
            $data['sn'] = 1;
            $data['mode'] = 'edit';
            $data['title'] = 'Edit Subjects';
            $data['subject'] = Subject::find($id);
            $data['subjects'] = Subject::simplePaginate(10);
            return view('admin.subject.index', $data);
        } catch (\Throwable $th) {
            return redirect('admin/subjects');
        }
    }

    public function delete($id)
    {
        try {
            $data['subject'] = Subject::find($id)->delete();
            Session::flash('success', 'Subject Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
