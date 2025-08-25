<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with(['editor', 'category'])
            ->findOrFail($id);

        $category = $article->category;

        $source = session('article_source');
        session()->forget('article_source');

        return view('admin.pages.article-show', compact('article', 'category', 'source'));
    }


    public function downloadPDF($id)
    {
        $article = Article::with('editor', 'category')->findOrFail($id);

        $pdf = Pdf::loadView('admin.pages.article-pdf', compact('article'));

        return $pdf->download($article->title . '.pdf');
    }
}
