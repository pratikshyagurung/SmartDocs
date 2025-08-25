<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Editor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.registerEditor');
    }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:editors,email',
            'password'   => 'required|confirmed|min:8',
        ]);

        $editor = Editor::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        // Log in the editor using the 'editor' guard
        Auth::guard('editor')->login($editor);

        return redirect()->route('editor.dashboard');
    }
    // Show login form for editor 
    public function showLoginForm()
    {
        return view('auth.loginEditor');
    }

    // Handle editor login 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('editor')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate(); // Prevent session fixation
            return redirect()->route('editor.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Handle logout for editor 
    public function logout(Request $request)
    {
        Auth::guard('editor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
