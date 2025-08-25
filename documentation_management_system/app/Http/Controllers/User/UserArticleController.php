<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\UserProgress;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserArticleController extends Controller
{
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

        $inProgress = collect();

        if (Auth::check()) {
            $userId = Auth::id();

            UserProgress::updateOrCreate(
                ['user_id' => $userId, 'article_id' => $article->id],
                ['progress_seconds' => 1]
            );

            $inProgress = UserProgress::with('article.category')
                ->where('user_id', $userId)
                ->where('progress_seconds', '>', 0)
                ->get();
            // dd($inProgress);
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


    public function toggleLike(Request $request, Article $article)
    {
        // Middleware('auth') guarantees a user here
        $userId = $request->user()->id;

        $existing = $article->likes()->where('user_id', $userId)->first();

        if ($existing) {
            $existing->delete();            // unlike
        } else {
            $article->likes()->create([
                'user_id' => $userId,       // like
            ]);
        }

        return back();
    }




    public function downloadPDF($id)
    {
        $article = Article::with('editor', 'category')->findOrFail($id);
        // Convert storage path to absolute path for DomPDF
        if ($article->image_path) {
            $article->image_path = public_path('storage/articles/' . basename($article->image_path));
        }

        $pdf = Pdf::loadView('user.pages.article-pdf', compact('article'));




        return $pdf->download($article->title . '.pdf');
    }
}
