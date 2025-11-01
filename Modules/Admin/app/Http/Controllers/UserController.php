<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        
        if ($search) {
            $users = User::where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            })->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        return view('admin::users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin::users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = now(); // Auto-verify email upon admin creation

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(int $user): View
    {
        $user = User::find($user);
        
        if (!$user) {
            abort(404, 'User not found');
        }

        return view('admin::users.show', compact('user'));
    }

    public function edit(int $user): View
    {
        $user = User::find($user);
        
        if (!$user) {
            abort(404, 'User not found');
        }

        return view('admin::users.edit', compact('user'));
    }

    public function update(Request $request, int $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user,
            'role' => 'required|in:user,admin',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $userModel = User::find($user);
        
        if (!$userModel) {
            abort(404, 'User not found');
        }

        $data = $request->only(['name', 'email', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $userModel->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(int $user): RedirectResponse
    {
        $user = User::find($user);
        
        if (!$user) {
            abort(404, 'User not found');
        }

        // Prevent deletion of current admin user
        if ($user->id === auth()->id() && $user->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete your own admin account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}