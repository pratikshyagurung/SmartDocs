<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:255',
        ]);

        $nameParts = explode(' ', $request->full_name, 2);

        /** @var \App\Models\Editor $user */

        $user->update([
            'first_name' => $nameParts[0],
            'last_name'  => $nameParts[1] ?? '',
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'              => 'required',
            'new_password'              => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
        /** @var \App\Models\Editor $user */
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }
    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/users'), $imageName);

            // Optionally delete old image
            if ($user->profile_image && file_exists(public_path('uploads/users/' . $user->profile_image))) {
                unlink(public_path('uploads/users/' . $user->profile_image));
            }
            /** @var \App\Models\Editor $user */
            $user->update(['profile_image' => $imageName]);
        }

        return redirect()->back()->with('success', 'Profile image updated successfully!');
    }
}
