<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'password' => 'nullable|min:6',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Avatar Upload
        //if ($request->hasFile('avatar')) {

            //$file = $request->file('avatar');
            //$filename = 'avatar_'.$admin->id.'.'.$file->getClientOriginalExtension();
            //$file->move(public_path('uploads/admin/'), $filename);

            //$admin->avatar = $filename;
        //}

        // Password update if provided
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
