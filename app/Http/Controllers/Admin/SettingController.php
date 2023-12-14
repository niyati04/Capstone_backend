<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function profileSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required_with:password_confirmation',
            'password_confirmation' => 'required_with:password|same:password',
        ]);
        if ($validator->fails()) {
            return back()->with("errors", $validator->errors());
        }
        $admin = Admin::where('id', auth()->user()->id)->first();
        if ($admin) {
            $admin->name = $request->name ? $request->name : $admin->name;
            $admin->password = Hash::make($request->password);
            $admin->save();
            return back()->with('success', "Profile Updated Successfully");
        }
    }
}
