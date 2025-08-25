<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Document;
use App\Models\Category;
use App\Models\Report;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function categories(Request $request)
    {
        $userId = Auth::id();
        $minThreshold = 60; // in-progress threshold

        $inProgress = Article::with('category')
            ->whereHas('progress', function ($q) use ($userId, $minThreshold) {
                $q->where('user_id', $userId)
                    ->where('progress_seconds', '>=', $minThreshold);
            })
            ->latest()
            ->take(12)
            ->get();

        // Top Picks (by likes)
        $topPicks = Article::with(['editor', 'category'])
            ->where('status', 'published')
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->take(6)
            ->get();

        // Trending (by views)
        $trending = Article::with(['editor', 'category'])
            ->where('status', 'published')
            ->orderByDesc('views')
            ->take(6)
            ->get();

        $categories = Category::all();

        $articles = Article::query();
        if ($request->search) {
            $articles = $articles->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $articles = $articles->where('category_id', $request->category);
        }
        $articles = $articles->get();

        return view('user.pages.categories', compact(
            'articles',
            'inProgress',
            'topPicks',
            'trending',
            'categories'
        ));
    }
}
