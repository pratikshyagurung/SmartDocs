<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;

class CategoryRedirectController extends Controller
{
    public function handle($slug)
    {
        switch ($slug) {
            case 'articles':
                return redirect()->route('editor.articles.create');
            case 'documents':
                return redirect()->route('editor.documents.create');
            case 'reports':
                return redirect()->route('editor.reports.create');
            case 'memos':
                return redirect()->route('editor.memos.create');
            default:
                abort(404);
        }
    }
}
