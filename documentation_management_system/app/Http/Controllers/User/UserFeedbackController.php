<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'role'    => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
            'email'   => $request->email,
            'role'    => $request->role,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function showFeedbacks()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')
            ->get()
            ->unique('email'); // keeps only the latest feedback per name

        return view('user.pages.feedback', compact('feedbacks'));
    }
}
