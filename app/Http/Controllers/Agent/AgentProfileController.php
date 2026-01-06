<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentProfileController extends Controller
{
    // Show profile form
    public function edit()
    {
        $agent = Auth::user();
        return view('agent.profile.edit', compact('agent'));
    }

    // Update profile
    public function update(Request $request)
    {
        $agent = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $agent->id,
            'password' => 'nullable|min:6',
        ]);

        $agent->name = $request->name;
        $agent->email = $request->email;

        if ($request->password) {
            $agent->password = Hash::make($request->password);
        }

        $agent->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
