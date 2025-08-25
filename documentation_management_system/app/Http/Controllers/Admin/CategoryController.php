<?php

// app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.pages.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|unique:categories,name',
            'slug'  => 'required|string|unique:categories,slug',
            'image' => 'nullable|image|max:2048', // jpg, png, webp, etc.
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name'  => $request->name,
            'slug'  => $request->slug,
            'image' => $path,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    public function show($id)
    {
        $category = Category::with(['articles' => function ($q) {
            $q->where('status', 'published')->with('editor');
        }])->findOrFail($id);

        return view('admin.pages.categories-show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.categories-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'slug');

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
}
