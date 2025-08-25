@extends('editor.inc.main')

@section('contents')


<style>
    .category-details, .published-articles {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 40px;
        box-shadow: 0 6px 16px var(--card-shadow);
    }

    .category-details .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .category-details h2 {
        font-size: 1.8rem;
        color: var(--primary);
        margin: 0;
    }

    .category-details .meta {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 10px;
    }

    .category-details .meta i {
        margin-right: 8px;
    }
    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filters input, .filters select {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        font-size: 0.95rem;
        min-width: 200px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filters input:focus, .filters select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(13, 71, 161, 0.2);
    }

    /* Table Section */
    .table-container {
        overflow-x: auto;
        box-shadow: 0 8px 16px var(--card-shadow);
        border-radius: 12px;
        background: var(--card-bg);
        margin-bottom: 50px;
    }

    #documentsTable {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    #documentsTable thead tr {
        background-color: var(--primary);
        color: white;
        text-align: left;
        user-select: none;
    }

    #documentsTable th, #documentsTable td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    #documentsTable th {
        font-weight: 600;
        font-family: 'Montserrat', sans-serif;
    }

    #documentsTable td {
        color: var(--text-color);
    }

    #documentsTable tbody tr:last-child td {
        border-bottom: none;
    }

    #documentsTable tbody tr:hover {
        background-color: var(--primary-light);
        cursor: pointer;
    }

    /* Buttons */
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-view {
        background-color: rgba(13, 71, 161, 0.1);
        color: var(--primary);
    }

    .btn-view:hover {
        background-color: rgba(13, 71, 161, 0.2);
    }

    .btn-edit {
        background-color: rgba(46, 125, 50, 0.1);
        color: var(--success);
    }

    .btn-edit:hover {
        background-color: rgba(46, 125, 50, 0.2);
    }

    .btn-delete {
        background-color: rgba(198, 40, 40, 0.1);
        color: var(--error);
    }

    .btn-delete:hover {
        background-color: rgba(198, 40, 40, 0.2);
    }

    .btn-icon {
        width: 16px;
        height: 16px;
    }

</style>
@php
    $editArticleData = $editArticleData ?? null;
@endphp

<div class="main-container">

    <!-- Section 1: Category Details -->
    <div class="category-details">

        <!-- Flex Header with Title and Button -->
        <div class="header-row">
            <h2><i class="fas {{ $category->icon }}"></i> {{ $category->name }}</h2>
            <button 
                id="toggleFormBtn"
                class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition"
            >
                Create Your {{ $category->name }}
            </button>
        </div>

        <!-- Meta Info -->
        <div class="meta"><i class="fas fa-link"></i> Slug: {{ $category->slug }}</div>
        <div class="meta"><i class="fas fa-calendar-alt"></i> Created: {{ $category->created_at->format('F j, Y') }}</div>
        <div class="meta"><i class="fas fa-hashtag"></i> Articles: {{ $category->articles->count() }}</div>
    </div>

    <!-- Article Creation Form -->
    <div id="articleForm" class="bg-white rounded-lg shadow p-6 mb-10 hidden">
        <form method="POST" action="{{ route('editor.articles.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Content</label>
                <textarea name="content" rows="6" class="w-full px-4 py-2 border rounded-md" required></textarea>
            </div>

            <!-- Category (readonly) -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Category</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Featured Image</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md">
                <input type="text" name="image_alt" placeholder="Alt text (optional)" class="mt-2 w-full px-4 py-2 border rounded-md">
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-md">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Submit Article
                </button>
            </div>
        </form>
    </div>
    <form method="GET"
    action="{{ route('editor.categories.detail', $category->slug) }}"
    class="filters">

  <input type="text"
         name="search"
         placeholder="Search {{ $category->name }}..."
         value="{{ request('search') }}" />

  <input type="date"
         name="date"
         value="{{ request('date') }}" />

  <button type="submit" class="btn btn-view">Filter</button>
</form>

    <div class="table-container">
        <table id="articlesTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Date Published</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ Str::limit($article->content, 50, '...') ?? '-' }}</td>
                        <td>
                            @if($article->image_path)
                              <img src="{{ asset('storage/'.$article->image_path) }}" alt="{{ $article->image_alt ?? $article->title }}" style="height:48px;width:48px;object-fit:cover;border-radius:6px">
                            @else
                              —
                            @endif
                          </td>
                        <td>{{ $article->created_at->format('Y-m-d') }}</td>
                        <td>
                            <span class="status-badge {{ $article->status === 'published' ? 'status-published' : 'status-draft' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('editor.articles.show', $article->id) }}" class="btn btn-edit">View</a>
                        
                            <a href="{{ route('editor.articles.edit', $article->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('editor.articles.destroy', $article->id) }}"
                                method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this article?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-delete">Delete</button>
                          </form>
                            
                        </td>
                    </tr>
                @endforeach
                @if ($articles->isEmpty())
                    <tr>
                        <td colspan="5" style="text-align: center;">No articles found.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        
    </div>


    <!-- Back Link -->
    <a href="{{ route('editor.categories') }}" class="back-link inline-block text-blue-700">← Back to Categories</a>
</div>



<!-- Toggle Form Script -->
<script>
    document.getElementById('toggleFormBtn').addEventListener('click', () => {
        document.getElementById('articleForm').classList.toggle('hidden');
    });
</script>
<script>
    // auto-submit when date changes (optional)
    const dateInput = document.querySelector('input[name="date"]');
    if (dateInput) dateInput.addEventListener('change', () => dateInput.form.submit());
  </script>

@endsection
