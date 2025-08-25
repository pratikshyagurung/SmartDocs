<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProgress;
use App\Models\Article;

class UserProgressController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'progress_seconds' => 'required|integer|min:0|max:3600', // max 1 hour
        ]);

        $userId = Auth::id();
        $progressSeconds = $request->progress_seconds;

        if ($progressSeconds >= 120) { // 2 minutes = 120 seconds
            // Delete progress if it reaches 2 min
            UserProgress::where('user_id', $userId)
                ->where('article_id', $request->article_id)
                ->delete();
        } else {
            // Update or create progress
            UserProgress::updateOrCreate(
                ['user_id' => $userId, 'article_id' => $request->article_id],
                ['progress_seconds' => $progressSeconds]
            );
        }

        return response()->json(['status' => 'success']);
    }

    public function list()
    {
        $userId = Auth::id();

        $inProgress = UserProgress::with('article.category')
            ->where('user_id', $userId)
            ->where('progress_seconds', '>', 0)
            ->get();

        return response()->json($inProgress);
    }

    public function show(Request $request, $slug)
    {
        $article = Article::with(['category', 'editor'])
            ->withCount('likes')
            ->where('slug', $slug)
            ->firstOrFail();

        $article->increment('views');
        $category = $article->category;

        $source = $request->query('source', 'all-articles');
        $categorySlugParam = $request->query('category', $category->slug ?? 'uncategorized');

        if (!in_array($source, ['my-posts', 'category', 'all-articles'], true)) {
            $source = 'all-articles';
        }

        $likedByMe = Auth::check()
            ? $article->likes()->where('user_id', Auth::id())->exists()
            : false;

        // fetch in-progress for user
        $inProgress = collect();
        if (Auth::check()) {
            $userId = Auth::id();
            $inProgress = UserProgress::with('article.category')
                ->where('user_id', $userId)
                ->where('progress_seconds', '>', 0)
                ->get();
        }

        return view('user.pages.article-show', compact(
            'article',
            'category',
            'source',
            'categorySlugParam',
            'likedByMe',
            'inProgress'
        ));
    }
}
