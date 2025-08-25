<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'article_id' => $id,
            'user_id'    => Auth::id(),
            'comment' => $request->input('content'),
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $parentComment = Comment::findOrFail($id);

        Comment::create([
            'article_id' => $parentComment->article_id,
            'user_id'    => Auth::id(),
            'parent_id'  => $parentComment->id,
            'comment' => $request->input('content'),
        ]);

        return back()->with('success', 'Reply posted successfully!');
    }
}
