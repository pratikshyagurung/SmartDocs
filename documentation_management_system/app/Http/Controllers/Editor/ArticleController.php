<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $query = Article::with('category');

        if ($request->has('category')) {
            $query->whereHas('category', fn($q) => $q->where('name', $request->category));
            $category = Category::where('name', $request->category)->first();
        } else {
            $category = null;
        }

        $articles = $query->where('editor_id', Auth::id())->get();

        return view('editor.articles.show', compact('articles', 'category'));
    }

    // store()
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'image_alt'   => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // stores under storage/app/public/articles/...
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->input('content'),
            'excerpt' => Str::limit(strip_tags($request->input('content')), 150),
            'category_id' => $request->category_id,
            'editor_id'   => Auth::id(),
            'status'      => $request->status,
            'featured'    => false,
            'views'       => 0,
            'image_path'  => $imagePath,
            'image_alt'   => $request->image_alt,
        ]);

        return redirect()->back()->with('success', 'Article created successfully!');
    }


    public function edit($id)
    {
        $article = Article::where('id', $id)
            ->where('editor_id', Auth::id())
            ->firstOrFail();

        $categories = Category::all();
        return view('editor.articles.edit', compact('article', 'categories'));
    }

    // update()
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)
            ->where('editor_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'featured'    => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'image_alt'   => 'nullable|string|max:255',
        ]);

        // handle new image 
        if ($request->hasFile('image')) {
            if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $article->image_path = $request->file('image')->store('articles', 'public');
        }

        $article->title       = $request->title;
        $article->slug        = Str::slug($request->title) . '-' . uniqid(); // keep if you want changing slugs
        $article->content = $request->input('content');
        $article->excerpt = $request->excerpt
            ?? Str::limit(strip_tags($request->input('content')), 150);
        $article->category_id = $request->category_id;
        $article->status      = $request->status;
        $article->featured    = $request->has('featured');
        $article->image_alt   = $request->image_alt;
        $article->save();

        return redirect()->route('editor.categories.detail', $article->category->slug)
            ->with('success', 'Article updated successfully!');
    }

    public function show($id)
    {
        $article = Article::with(['editor', 'category'])
            ->where('editor_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $category = $article->category;

        $source = session('article_source');
        session()->forget('article_source');

        return view('editor.articles.show', compact('article', 'category', 'source'));
    }

    public function showByCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $search = $request->input('search');
        $date   = $request->input('date');

        $articles = Article::where('category_id', $category->id)
            ->where('editor_id', Auth::id())
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->when($date,   fn($q) => $q->whereDate('created_at', $date))
            ->latest()
            ->get();

        return view('editor.pages.categories-details', compact('category', 'articles'));
    }

    public function destroy($id)
    {
        $article = Article::where('id', $id)
            ->where('editor_id', Auth::id())
            ->firstOrFail();

        if ($article->editor_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $categorySlug = $article->category->slug;
        if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->forceDelete();

        return redirect()->back()->with('success', 'Article deleted successfully.');
    }

    public function myPosts(Request $request)
    {
        $editorId = Auth::id();
        $categoryId = $request->input('category_id');
        $searchTerm = $request->input('search');

        $articles = Article::with('category')
            ->where('editor_id', $editorId)
            ->where('status', 'published')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->latest()
            ->get();

        $documents = Document::with('category')
            ->where('editor_id', $editorId)
            ->where('status', 'published')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->latest()
            ->get();

        $categories = Category::all();

        session(['article_source' => 'my-posts']);

        return view('editor.pages.myPosts', compact('articles', 'documents', 'categories'));
    }

    public function performanceDashboard()
    {
        // All published articles across all editors
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

            $article->performance_score = round(($article->likes_count * 2) + ($article->views_count / 500), 1);

            return $article;
        });



        //rank by combined performance_score
        $articlesByRank = $articles->sortByDesc('performance_score')->values();


        $topPerformer = $articlesByRank->first();

        return view('editor.pages.topPerformer', [
            'topPerformer'   => $topPerformer,
            'articlesByViews' => $articlesByRank,
        ]);
    }


    // public function downloadPDF($id)
    // {
    //     $article = Article::where('id', $id)
    //         ->where('editor_id', Auth::id())
    //         ->firstOrFail();

    //     $pdf = Pdf::loadView('editor.pages.article-pdf', compact('article'));

    //     return $pdf->download($article->title . '.pdf');
    // }
    public function downloadPDF($id)
    {
        $article = Article::with('editor', 'category')->findOrFail($id);
        // Convert storage path to absolute path for DomPDF
        if ($article->image_path) {
            $article->image_path = public_path('storage/articles/' . basename($article->image_path));
        }

        $pdf = Pdf::loadView('editor.pages.article-pdf', compact('article'));

        return $pdf->download($article->title . '.pdf');
    }
}
