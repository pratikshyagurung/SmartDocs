<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Document;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;



class EditorDashboardController extends Controller
{
    public function index()
    {
        if (!Auth::guard('editor')->check()) {
            return redirect()->route('loginEditor');
        }

        $editorId = Auth::id();

        // Get categories with article counts 
        $categoriesWithCounts = Category::withCount([
            'articles' => function ($query) use ($editorId) {
                $query->where('editor_id', $editorId);
            }
        ])->get();

        // Count active users but exclude admins
        $activeUsers = User::where('role', '!=', 'admin')->count();

        // Recent articles
        $recentArticles = Article::with('category')
            ->where('editor_id', $editorId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Get the selected time range or default to 6 months
        $timeRange = request('time_range', '6');

        // Generate chart data based on selected time range
        list($labels, $data) = $this->generateChartData($editorId, $timeRange);


        return view('editor.pages.dashboard', compact(
            'categoriesWithCounts',
            'activeUsers',
            'recentArticles',
            'labels',
            'data',
            'timeRange'
        ));
    }

    private function generateChartData($editorId, $timeRange)
    {
        $labels = [];
        $data = [];

        if ($timeRange === 'ytd') {
            // Year to Date data
            $startOfYear = Carbon::now()->startOfYear();
            $currentMonth = Carbon::now()->month;

            for ($i = 1; $i <= $currentMonth; $i++) {
                $month = Carbon::create()->month($i)->format('M');
                $labels[] = $month;

                $count = Article::where('editor_id', $editorId)
                    ->whereMonth('created_at', $i)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();

                $data[] = $count;
            }
        } else {
            // Monthly data for selected time range
            $months = (int) $timeRange;

            $articles = Article::selectRaw('COUNT(*) as count, MONTH(created_at) as month, YEAR(created_at) as year')
                ->where('editor_id', $editorId)
                ->where('created_at', '>=', Carbon::now()->subMonths($months - 1)->startOfMonth())
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->keyBy(function ($item) {
                    return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                });

            // Generate labels and data for each month in the range
            for ($i = 0; $i < $months; $i++) {
                $date = Carbon::now()->subMonths($i);
                $monthKey = $date->format('Y-m');
                $label = $date->format('M Y');

                $labels[] = $label;
                $data[] = $articles->has($monthKey) ? $articles[$monthKey]->count : 0;
            }

            // Reverse to show chronological order
            $labels = array_reverse($labels);
            $data = array_reverse($data);
        }

        return [$labels, $data];
    }


    public function categories()
    {
        $editorId = Auth::id();

        $articles = Article::where('editor_id', $editorId)->latest()->get();
        $documents = Document::where('editor_id', $editorId)->latest()->get();


        $categories = Category::all();

        return view('editor.pages.categories', compact('articles', 'documents', 'categories', 'reports'));
    }

    public function dashboard(Request $request)
    {
        $editorId = Auth::id();

        // Categories with article counts
        $categoriesWithCounts = Category::withCount([
            'articles' => function ($query) use ($editorId) {
                $query->where('editor_id', $editorId);
            }
        ])->get();

        $activeUsers = User::where('role', '!=', 'admin')->count();

        $recentArticles = Article::with('category')
            ->where('editor_id', $editorId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Article chart data (last 6 months)
        $articles = Article::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->where('editor_id', $editorId)
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->pluck('count', 'month');

        $labels = [];
        $data = [];
        foreach (range(0, 5) as $i) {
            $month = Carbon::now()->subMonths($i)->format('M');
            $labels[] = $month;
            $data[] = $articles[Carbon::now()->subMonths($i)->month] ?? 0;
        }
        $labels = array_reverse($labels);
        $data = array_reverse($data);

        $userCommentsQuery = Comment::with('article', 'replies')
            ->where('user_id', $editorId);

        if ($request->filled('date')) {
            $userCommentsQuery->whereDate('created_at', $request->date);
        }


        $userComments = $userCommentsQuery->latest()->paginate(5);

        $startDate = $request->start_date ? Carbon::parse($request->start_date) : null;
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : null;

        $articleQuery = Article::withCount(['comments', 'likes'])
            ->where('editor_id', $editorId);


        if ($startDate && $endDate) {
            $articleQuery->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
        }

        $articleStats = $articleQuery->orderBy('comments_count', 'desc')->take(5)->get();

        $articleLabels = $articleStats->pluck('title')->toArray();
        $articleComments = $articleStats->pluck('comments_count')->toArray();
        $articleLikes = $articleStats->pluck('likes_count')->toArray();
        $articleViews = $articleStats->pluck('views')->toArray();

        return view('editor.pages.dashboard', compact(
            'categoriesWithCounts',
            'activeUsers',
            'recentArticles',
            'labels',
            'data',
            'userComments',
            'articleLabels',
            'articleComments',
            'articleLikes',
            'articleViews'
        ));
    }
}
