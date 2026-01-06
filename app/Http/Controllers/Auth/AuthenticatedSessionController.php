<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show Login Page
     */
    public function create(): View
    {
        return view('auth.login'); // login with role dropdown
    }

    /**
     * Handle login for USER + AGENT using role selector
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'login_role' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // USER Login Attempt
        if ($request->login_role === 'user') {
            if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->route('user.dashboard');
            }
        }

        // AGENT Login Attempt
        if ($request->login_role === 'agent') {
            if (Auth::guard('agent')->attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->route('agent.dashboard');
            }
        }

        // If both fail
        return back()->with('error', 'Invalid Credentials');
    }

    /**
     * Logout USERS + AGENTS
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('agent')->check()) {
            Auth::guard('agent')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
