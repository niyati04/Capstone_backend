<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // register admin
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin,email',
            'password' => 'required|string|min:6',
            'cpassword' => 'required|string|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();
        if ($save) {
            return redirect()->route('admin.login')->with("success", "Admin Created Successfully");
        } else {
            return redirect()->back()->with("error", "Something went wrong.");
        }
    }


    // login admin
    public function check(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:admin,email',
            'password' => 'required|string|min:6',
        ], [
            "email.exists" => 'This email is not exists on our records.'
        ]);

        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $creds = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('error', 'Incorrect credentials');
        }
    }

    // logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Logout successfully.');
    }
}
