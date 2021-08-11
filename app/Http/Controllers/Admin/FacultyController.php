<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        // $this->create_new = new User();
        $this->create_new = new Faculties();
    }

    public function create(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'name' => ['required', 'max:255'],
                    'code' => ['required', 'max:255']
                );
                $fieldNames = array(
                    'name'   => 'Faculty Name',
                    'code'   => 'Faculty Code',
                );
                //dd($request->all());
                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $faculty = Faculties::find($request->id);
                        $faculty->name = $request->name;
                        $faculty->code = $request->code;
                        $faculty->save();
                        Session::flash('success', 'Faculty Updated Successfully');
                        return redirect('admin/faculties');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return redirect('admin/faculties');
                    }
                }
            } else {
                $rules = array(
                    'name' => ['required', 'max:255', 'unique:faculties'],
                    'code' => ['required', 'max:255', 'unique:faculties']
                );
                $fieldNames = array(
                    'name'   => 'Faculty Name',
                    'code'   => 'Faculty Code',
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
                            $check = Faculties::where(['name' => $request->name, 'code' => $request->code])->count();
                            if ($check > 0) {
                                Session::flash('error', 'Faculty Name has already been created');
                                return \back();
                            } else {
                                try {
                                    $this->create_new->create($request);
                                    Session::flash('success', 'Faculty Added Successfully');
                                    return redirect('admin/faculties');
                                } catch (\Throwable $th) {
                                    Session::flash('error', $th->getMessage());
                                    return \back();
                                }
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
            // ->with('subjects:id,name')->paginate(15)
            $data['faculties'] = $f = Faculties::withCount('department')->orderBy('id', 'ASC')->get();
            $data['title'] = 'Faculties';
            $data['sn'] = 1;
            $data['mode'] = 'index';
            return view('admin.faculties.index', $data);
        }
    }

    public function view($id)
    {
        try {
            $data['faculty'] = $f = Faculties::where(['id' => $id])->first();
            $data['departments'] = Department::withCount('course')->where('faculty_id', $id)->get();
            $data['title'] = 'Faculty of ' . $f->name . ' ' . $f->code;
            $data['sn'] = 1;
            return view('admin.faculties.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
    public function create_new()
    {
        try {
            $data['faculties'] = Faculties::orderBy('id', 'ASC')->get();
            $data['title'] = 'Faculties';
            $data['sn'] = 1;
            $data['mode'] = 'create';
            return view('admin.faculties.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function edit($id)
    {
        try {
            $data['faculty'] = $f = Faculties::where(['id' => $id])->first();
            $data['title'] = 'Edit Faculty ' . $f->name;
            $data['sn'] = 1;
            $data['mode'] = 'edit';
            return view('admin.faculties.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function delete($id)
    {
        try {
            Faculties::where(['id' => $id])->first()->delete();
            Department::where(['faculty_id' => $id])->delete();
            Session::flash('success', 'Faculty Deleted Successfully');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
