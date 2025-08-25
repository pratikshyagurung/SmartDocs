<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Document;
use App\Models\Report;
use App\Models\Category;


class EditorCategoryController extends Controller
{
    public function index(Request $request)
    {
        $editorId = Auth::id();
        $categoryId = $request->input('category_id');
        $type = $request->input('type');

        $categories = Category::with('editor')->select('id', 'name', 'slug', 'editor_id', 'image')->get();



        return view('editor.pages.categories', compact(

            'categories'
        ));
    }
    public function showByCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $search = $request->input('search');
        $date = $request->input('date');

        $articles = Article::where('category_id', $category->id)
            ->where('editor_id', Auth::id())
            ->when($search, fn($query) => $query->where('title', 'like', '%' . $search . '%'))
            ->when($date, fn($query) => $query->whereDate('created_at', $date))
            ->orderBy('created_at', 'desc')
            ->get();


        // Set session to indicate category source
        session(['article_source' => 'category']);


        return view('editor.pages.categories-details', compact('category', 'articles'));
    }
}
