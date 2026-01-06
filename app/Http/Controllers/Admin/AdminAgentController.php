<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAgentController extends Controller
{
    public function index()
    {
        $agents = User::where('role','agent')->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }
public function show(User $user)
{
    $user->load('assignedTickets');
    return view('admin.agents.show', compact('user'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'agent';

        User::create($data);

        return redirect()->route('admin.agents.index')
                         ->with('success','Agent created');
    }

    public function destroy(User $user)
    {
        // only delete if agent
        if ($user->role !== 'agent') {
            return back()->with('error','Not an agent');
        }

        $user->delete();
        return back()->with('success','Agent deleted');
    }
}
