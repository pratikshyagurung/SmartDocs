<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProgress;
use App\Models\Article;


class UserCategoriesController extends Controller
{
    public function index()
    {

        $userId = Auth::id();

        $inProgress = UserProgress::with('article.editor')
            ->where('user_id', $userId)
            ->where('progress_seconds', '>=', 60)
            ->get()
            ->pluck('article');

        // User preference (Top Picks): fetch categories user reads the most
        $userPreferences = UserProgress::where('user_id', $userId)
            ->with('article.category')
            ->get()
            ->pluck('article.category_id')
            ->countBy()
            ->sortDesc()
            ->keys()
            ->take(3);

        $topPicks = Article::with('editor')
            ->whereIn('category_id', $userPreferences)
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        // Trending: most viewed
        $trending = Article::with('editor')
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(6)
            ->get();

        return view('categories.index', compact('inProgress', 'topPicks', 'trending'));
    }
}
