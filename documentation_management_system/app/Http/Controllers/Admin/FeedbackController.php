<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('message', 'like', "%{$request->search}%");
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pages.feedback', compact('feedbacks'));
    }
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedbacks')->with('success', 'Feedback deleted successfully.');
    }
}
