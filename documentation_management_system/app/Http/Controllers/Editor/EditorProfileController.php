<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('editor.pages.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:editors,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
        ]);

        /** @var \App\Models\Editor $user */
        $user->update($request->only('first_name', 'last_name', 'email', 'phone', 'address'));

        return back()->with('success', 'Profile updated successfully!');
    }

    // Update profile image
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/editors'), $name);

            // Delete old image if exists
            if ($user->profile_image && file_exists(public_path('uploads/editors/' . $user->profile_image))) {
                unlink(public_path('uploads/editors/' . $user->profile_image));
            }

            $user->profile_image = $name;
            /** @var \App\Models\Editor $user */

            $user->save();
        }

        return back()->with('success', 'Profile image updated successfully!');
    }

    // Change password
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(6)],
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password does not match.']);
        }

        $user->password = $request->new_password; // will be hashed automatically due to cast
        /** @var \App\Models\Editor $user */

        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
