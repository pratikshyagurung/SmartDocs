<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Editor;

class AdminEditorController extends Controller
{
    public function manageEditors(Request $request)
    {
        $query = Editor::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }


        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $editors = $query->orderByDesc('created_at')->get();

        return view('admin.pages.editors', compact('editors'));
    }

    public function viewEditor($id)
    {
        $editor = Editor::findOrFail($id);
        return view('admin.pages.editors-view', compact('editor'));
    }

    public function editEditor($id)
    {
        $editor = Editor::findOrFail($id);
        return view('admin.pages.editors-edit', compact('editor'));
    }

    public function updateEditor(Request $request, $id)
    {
        $editor = Editor::findOrFail($id);

        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:editors,email,' . $editor->id,
            'phone' => 'nullable|string|max:20',
        ]);

        // Update fields
        $editor->first_name = $request->first_name;
        $editor->last_name  = $request->last_name;
        $editor->email      = $request->email;
        $editor->phone      = $request->phone;



        $editor->save();

        return redirect()->route('admin.editor.view', $editor->id)
            ->with('success', 'Editor updated successfully.');
    }


    public function deleteEditor($id)
    {
        $editor = Editor::findOrFail($id);
        $editor->delete();

        return redirect()->route('admin.editors')->with('success', 'Editor deleted successfully.');
    }
}
