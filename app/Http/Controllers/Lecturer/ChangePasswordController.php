<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function change(Request $request)
    {
        $rules = array(
            'old_password'     => 'required',
            'new_password'  => ['required', 'min:8', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/'],
            'confirm_new_password' => 'required'
        );

        $fieldNames = array(
            'old_password'     => 'Current Password',
            'new_password'  => 'New Password',
            'confirm_new_password' => 'Confirm New Password'
        );
        //dd($request);
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            $request->session()->flash('warning', 'Password must 8 character long, maximum of 16 character, One English uppercase characters (A – Z), One English lowercase characters (a – z), One Base 10 digits (0 – 9) and One Non-alphanumeric (For example: !, $, #, or %)');
            return back()->withErrors($validator);
        } else {
            $current_password = Auth::user()->password;
            if (Hash::check($request->old_password, $current_password)) {
                if ($request->new_password == $request->confirm_new_password) {
                    $user_id = Auth::user()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request->new_password);
                    $obj_user->save();
                    $request->session()->flash('success', 'Password changed successfully');
                    return \back();
                } else {
                    $request->session()->flash('warning', 'Password not set');
                    return back()->withErrors(['new_password' => 'The New password and Confirm password not match']);
                }
            } else {
                $request->session()->flash('warning', 'Password Wrong');
                return back()->withErrors(['old_password' => 'Please enter correct current password']);
            }
        }
    }
}
