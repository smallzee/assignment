<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }

    public function index(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'email' => ['required', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'mobile' => ['max:255'],
                'address' => ['max:255'],
                'city' => ['max:255'],
                'state' => ['max:255'],
                'avatar' => 'image|mimes:jpg,jpeg,png|max:5000',
            );
            $fieldNames = array(
                'email' => 'Email',
                'first_name'     => 'First Name',
                'last_name'     => 'Last Name',
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
                    $pictureDestination = 'uploads/student_avatar';
                    $file->move($pictureDestination, $picture);
                }
                $user = User::find(Auth::user()->id);
                $user->first_name = $request->first_name;
                $user->email = $request->email;
                $user->last_name = $request->last_name;
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
            return view('student.settings.profile', $data);
        }
    }
    public function change_password()
    {
        $data['title'] = 'Change Password';
        return view('student.settings.password', $data);
    }
}
