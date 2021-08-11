<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'max:255', 'unique:users,email,'.Auth::user()->id],
                'mobile' => ['max:255'],
                'address' => ['max:255'],
                'city' => ['max:255'],
                'state' => ['max:255'],
                'avatar' => 'image|mimes:jpg,jpeg,png|max:5000',
            );
            $fieldNames = array(
                'first_name'     => 'First Name',
                'last_name'     => 'Last Name',
                'email'     => 'Email',
                'mobile'   => 'Mobile Number',
                'city'  => 'City',
                'state'  => 'State',
                'address'  => 'Address',
                'avatar'   => 'Profile Picture',
            );
            //dd($request->all());
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                //dd($request->all());
                if ($request->file('avatar')) {
                    $file = $request->file('avatar');
                    $picture = 'SPP' . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
                    $pictureDestination = 'uploads/admin_avatar';
                    $file->move($pictureDestination, $picture);
                }
                $user = User::find(Auth::user()->id);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->city = $request->city;
                $user->state = $request->state;
                $user->avatar = $request->hasFile('avatar') ? $picture : $user->avatar;
                $user->save();
                Session::flash('success', 'Profile Updated Successfully');
                return \back();
            }
        } else {
            $data['title'] = 'My Profile';
            return view('admin.settings.profile', $data);
        }
    }
    
    public function assignment()
    {
        $data['title'] = 'All Assignments';
        $data['sn'] = 1;
        $data['assignments'] = $c = Assignment::with('student:id,first_name,last_name,matric_number')->with('faculty:id,name,code')->with('dept:id,name')->with('level:id,name')->with('semester:id,name')->with('course:id,course_title,course_code')->get();
        //dd($c);
        return view('admin.settings.assignments', $data);
    }
    
    public function delete_assignment($id)
    {
        try {
            $delete = Assignment::where('id', $id)->first();
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

    // public function about_us(Request $request)
    // {
    //     if ($_POST) {
    //         # code...
    //     } else {
    //         $data['title'] = 'About Us';
    //         return view('admin.web_settings.about', $data);
    //     }
    // }

    // public function contact_us(Request $request)
    // {
    //     if ($_POST) {
    //         # code...
    //     } else {
    //         $data['title'] = 'Contact Us';
    //         return view('admin.web_settings.contact', $data);
    //     }
    // }

    // public function slider(Request $request)
    // {
    //     if ($_POST) {
    //         # code...
    //     } else {
    //         $data['title'] = 'Home Page Slider';
    //         $data['sn'] = 1;
    //         $data['sliders'] = Slider::all();
    //         return view('admin.web_settings.slider', $data);
    //     }
    // }
}
