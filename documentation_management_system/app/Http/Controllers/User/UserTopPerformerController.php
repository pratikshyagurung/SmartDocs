<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class UserTopPerformerController extends Controller
{
    public function performanceDashboard()
    {
        $user = Auth::user();
        $profileImage = ($user && $user->profile_image)
            ? asset('uploads/users/' . $user->profile_image)
            : asset('images/profile.png');

        // All published articles with related editor and likes
        $articles = Article::with(['editor', 'likes', 'category'])
            ->published()
            ->get();

        // Enrich with metrics
        $articles = $articles->map(function ($article) {
            $article->likes_count      = $article->likes->count();
            $article->views_count      = (int) $article->views;
            $article->engagement_rate  = $article->views_count
                ? round(($article->likes_count / $article->views_count) * 100, 1)
                : 0.0;

            // Performance score 
            $article->performance_score = round(($article->likes_count * 2) + ($article->views_count / 500), 1);

            return $article;
        });

        // Rank by performance_score descending
        $articlesByRank = $articles->sortByDesc('performance_score')->values();

        $topPerformer = $articlesByRank->first();

        return view('user.pages.top-performer', [
            'topPerformer'   => $topPerformer,
            'articlesByViews' => $articlesByRank,
            'profileImage'    => $profileImage,
        ]);
    }
}
