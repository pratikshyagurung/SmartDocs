<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    // Show the form to create a new document
    public function create()
    {
        $categories = Category::all();
        return view('editor.documents.create', compact('categories'));
    }

    // Store a new document
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        Document::create([
            'editor_id' => Auth::id(),
            'title' => $request->title,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'content' => $request->input('content'),
            'status' => $request->status,
        ]);

        return redirect()->route('editor.documents.create')->with('success', 'Document created successfully!');
    }

    // Show a single document
    public function show($id)
    {
        $document = Document::where('editor_id', Auth::id())->findOrFail($id);
        return view('editor.documents.show', compact('document'));
    }

    // Show the form to edit a document
    public function edit($id)
    {
        $document = Document::where('editor_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('editor.documents.edit', compact('document', 'categories'));
    }

    // Update a document
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $document = Document::where('editor_id', Auth::id())->findOrFail($id);

        $document->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'content' => $request->input('content'),
            'status' => $request->status,
        ]);

        return redirect()->route('editor.documents.show', $id)->with('success', 'Document updated successfully!');
    }

    // Delete a document
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if ($document->editor_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $document->forceDelete(); // Permanently delete from DB

        return redirect()->route('editor.categories')->with('success', 'Document deleted successfully.');
    }
}
