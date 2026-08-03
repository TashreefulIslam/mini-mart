<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleRole(User $user)
    {
        $current = Auth::user();
        if ($current->id === $user->id) {
            return back()->withErrors(['error' => 'You cannot change your own role.']);
        }

        $user->role = $user->role === 'admin' ? 'customer' : 'admin';
        $user->save();
        return back()->with('success', 'User role updated.');
    }

    public function destroy(User $user)
    {
        $current = Auth::user();
        if ($current->id === $user->id) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
