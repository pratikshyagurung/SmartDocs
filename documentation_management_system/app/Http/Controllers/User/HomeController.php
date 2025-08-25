<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // <-- import Auth facade
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    // Map short keys to real route names
    private const DEST_MAP = [
        'home'         => 'user.home',
        'categories'   => 'user.categories',
        'all-articles' => 'user.all-articles',
        'about'        => 'user.about',
        'feedback'     => 'user.feedback',
        'profile'      => 'user.Userprofile',
    ];

    // Public landing page at "/"
    public function landing()
    {
        $user = Auth::user(); // editor knows this type now
        $profileImage = ($user && $user->profile_image)
            ? asset('uploads/users/' . $user->profile_image)
            : asset('images/profile.png');

        return view('user.pages.home', compact('profileImage'));
    }

    // Single gateway: if logged in -> target route; else -> login
    public function gate(string $dest)
    {
        if (!isset(self::DEST_MAP[$dest])) {
            abort(404);
        }

        $route = self::DEST_MAP[$dest];

        if (Auth::check()) {
            return redirect()->route($route);
        }

        // remember intended and send to login
        session()->put('url.intended', route($route));
        return redirect()->route('login');
    }
    public function index()
    {
        $categories = Category::withCount('articles')->get();

        $popularArticles = Article::published()
            ->orderBy('views', 'desc')
            ->limit(3)
            ->with('category')
            ->get();

        $recentArticles = Article::published()
            ->latest()
            ->limit(3)
            ->with('category')
            ->get();

        $user = Auth::user();
        $profileImage = ($user && $user->profile_image)
            ? asset('uploads/users/' . $user->profile_image)
            : asset('images/profile.png');

        return view('user.pages.home', compact(
            'categories',
            'popularArticles',
            'recentArticles',
            'profileImage'
        ));
    }


    public function allArticles(Request $request)
    {
        $sort = $request->get('sort', 'newest');
        $search = $request->get('search');
        $category = $request->get('category');

        $articles = Article::published()
            ->with('category')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($category, function ($query) use ($category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('id', $category);
                });
            })
            ->when($sort === 'oldest', function ($query) {
                return $query->oldest();
            })
            ->when($sort === 'views', function ($query) {
                return $query->orderBy('views', 'desc');
            })
            ->when($sort === 'alphabetical', function ($query) {
                return $query->orderBy('title', 'asc');
            })
            ->when($sort === 'newest', function ($query) {
                return $query->latest();
            })
            ->paginate(6);

        $categories = Category::has('articles')->get();

        return view('user.pages.all-articles', compact('articles', 'categories'));
    }
}
