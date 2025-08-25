<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Document;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Editor;
use App\Models\Feedback;
use App\Models\Comment;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Total articles
        $totalArticles = Article::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalEditors = Editor::count();
        $totalCombined = $totalUsers + $totalEditors;
        $activeEditors = Editor::count();
        $activeUsers = User::where('role', '!=', 'admin')->count();
        $categoriesWithCounts = Category::withCount('articles')->get();
        $recentArticles = Article::with('category', 'editor')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        // Chart data
        $timeRange = request('time_range', '6');
        list($labels, $data) = $this->generateChartData($timeRange);

        // User comments
        $userCommentsQuery = Comment::with('article', 'replies', 'user');
        if ($request->filled('date')) {
            $userCommentsQuery->whereDate('created_at', $request->date);
        }
        $userComments = $userCommentsQuery->latest()->paginate(5);

        // Feedbacks
        $feedbacksQuery = Feedback::with('user')->orderBy('created_at', 'desc');
        if ($request->filled('feedback_date')) {
            $feedbacksQuery->whereDate('created_at', $request->feedback_date);
        }
        $feedbacks = $feedbacksQuery->paginate(5)->withQueryString();

        // Users
        $usersQuery = User::where('role', '!=', 'admin')->orderBy('created_at', 'desc');
        if ($request->filled('user_date')) {
            $usersQuery->whereDate('created_at', $request->user_date);
        }
        $users = $usersQuery->paginate(5)->withQueryString();

        // Editors
        $editorsQuery = Editor::with('articles')->orderBy('created_at', 'desc');
        if ($request->filled('editor_date')) {
            $editorsQuery->whereDate('created_at', $request->editor_date);
        }
        $editors = $editorsQuery->paginate(5)->withQueryString();

        // Articles with comment, like, and views counts
        $articleStats = Article::withCount(['comments', 'likes'])
            ->orderBy('comments_count', 'desc')
            ->take(5)
            ->get();

        $articleLabels = $articleStats->pluck('title');
        $articleComments = $articleStats->pluck('comments_count');
        $articleLikes = $articleStats->pluck('likes_count');
        $articleViews = $articleStats->pluck('views');

        return view('admin.pages.dashboard', compact(
            'totalArticles',
            'totalUsers',
            'activeEditors',
            'activeUsers',
            'categoriesWithCounts',
            'recentArticles',
            'labels',
            'data',
            'userComments',
            'timeRange',
            'totalCombined',
            'feedbacks',
            'users',
            'editors',
            'articleLabels',
            'articleComments',
            'articleLikes',
            'articleViews'
        ));
    }

    private function generateChartData($timeRange)
    {
        $labels = [];
        $data = [];

        if ($timeRange === 'ytd') {
            $currentMonth = Carbon::now()->month;
            for ($i = 1; $i <= $currentMonth; $i++) {
                $month = Carbon::create()->month($i)->format('M');
                $labels[] = $month;
                $data[] = Article::whereMonth('created_at', $i)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();
            }
        } else {
            $months = (int) $timeRange;
            $articles = Article::selectRaw('COUNT(*) as count, MONTH(created_at) as month, YEAR(created_at) as year')
                ->where('created_at', '>=', Carbon::now()->subMonths($months - 1)->startOfMonth())
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->keyBy(fn($item) => $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT));

            for ($i = 0; $i < $months; $i++) {
                $date = Carbon::now()->subMonths($i);
                $monthKey = $date->format('Y-m');
                $labels[] = $date->format('M Y');
                $data[] = $articles->has($monthKey) ? $articles[$monthKey]->count : 0;
            }
            $labels = array_reverse($labels);
            $data = array_reverse($data);
        }

        return [$labels, $data];
    }
    public function topPerformers(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $limit = (int) $request->get('limit', 10);

        // Time window: this month 
        $start = now()->startOfMonth();
        $end   = now()->endOfMonth();

        // Pull articles this month 
        $articles = Article::with(['editor', 'category'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        // Decorate per-article metrics used in Blade
        $articlesByViews = $articles->map(function ($a) {
            $views = (int) ($a->views ?? 0);
            $likes = (int) $a->likes()->count();
            $engagement = $views > 0 ? round(($likes / $views) * 100) : 0;
            $score = ($views * 0.6) + ($likes * 4) + ($engagement * 0.4);

            $a->views_count = $views;
            $a->likes_count = $likes;
            $a->engagement_rate = $engagement;
            $a->performance_score = (int) round($score);
            return $a;
        });

        // pick top performer
        $articlesByViews = $articlesByViews->sortByDesc('views_count')->values();
        $topPerformer = $articlesByViews->sortByDesc('performance_score')->first();

        $topLikedArticles = Article::with(['category', 'editor'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->take($limit)
            ->get();

        $topCommentedArticles = Article::with(['category', 'editor'])
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->take($limit)
            ->get();

        $topViewedArticles = Article::with(['category', 'editor'])
            ->orderByDesc('views')
            ->take($limit)
            ->get();

        $topEditorsByArticles = Editor::withCount('articles')
            ->orderByDesc('articles_count')
            ->take($limit)
            ->get();

        $topEditorsByLikes = Editor::with(['articles' => fn($q) => $q->withCount('likes')])
            ->get()
            ->map(function ($editor) {
                $editor->total_likes = $editor->articles->sum('likes_count');
                return $editor;
            })
            ->sortByDesc('total_likes')
            ->take($limit)
            ->values();

        $topUsersByComments = User::withCount('comments')
            ->orderByDesc('comments_count')
            ->take($limit)
            ->get();

        return view('admin.pages.TopPerformers', [
            'limit'                => $limit,
            'articlesByViews'      => $articlesByViews->take($limit),
            'topPerformer'         => $topPerformer,
            'topLikedArticles'     => $topLikedArticles,
            'topCommentedArticles' => $topCommentedArticles,
            'topViewedArticles'    => $topViewedArticles,
            'topEditorsByArticles' => $topEditorsByArticles,
            'topEditorsByLikes'    => $topEditorsByLikes,
            'topUsersByComments'   => $topUsersByComments,
        ]);
    }
}
