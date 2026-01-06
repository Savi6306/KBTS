<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthWebController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Web Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Role-based redirect
            if (auth()->user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }

            if (auth()->user()->role == 'agent') {
                return redirect('/agent/dashboard');
            }

            return redirect('/user/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Show register page (only user can register)
    public function showRegister()
    {
        return view('auth.register');
    }

    // Web Register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',   // default role
        ]);

        return redirect('/login')->with('success', 'Account created successfully!');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
