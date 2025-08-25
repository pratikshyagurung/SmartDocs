<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function manageUsers(Request $request)
    {
        $query = User::query()->where('role', '!=', 'admin');

        // Search by first_name, last_name, full name, or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $users = $query->orderByDesc('created_at')->get();

        return view('admin.pages.users', compact('users'));
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.pages.users-view', compact('user'));
    }

    // Show edit form
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users-edit', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only(['first_name', 'last_name', 'email', 'phone']);

        $user->update($data);

        return redirect()->route('admin.users.view', $user->id)->with('success', 'User updated successfully.');
    }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
