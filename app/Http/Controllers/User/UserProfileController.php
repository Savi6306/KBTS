<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display the user profile page.
     */
    public function index()
    {
        // Authenticated user
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }
}
