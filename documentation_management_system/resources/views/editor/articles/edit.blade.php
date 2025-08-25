@extends('editor.inc.main')
@section('contents')

<style>
    .edit-article-form {
    max-width: 600px;
    margin: 2rem auto;
    padding: 1rem;
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.3rem;
    display: block;
    color: #333;
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 0.5rem 0.8rem;
    border: 1.5px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    font-family: inherit;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: #0f2a35; /* Your brand color */
    outline: none;
}

.form-textarea {
    resize: vertical;
}

.form-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-submit {
    align-self: flex-start;
    background-color: #0d47a1;
    color: white;
    font-weight: 600;
    padding: 0.7rem 1.5rem;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 1rem;
}

.btn-submit:hover {
    background-color: #092c62;
}

</style>
<div class="main-container">

<!-- Edit Article Form -->
<form method="POST" action="{{ route('editor.articles.update', $article->id) }}" enctype="multipart/form-data" class="edit-article-form" >
    @csrf
    @method('PUT')

    <label for="title" class="form-label">Title</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $article->title) }}"
        placeholder="Enter article title"
        required
        class="form-input"
    />

    <label for="category_id" class="form-label">Category</label>
    <select id="category_id" name="category_id" required class="form-select">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label for="content" class="form-label">Content</label>
    <textarea
        id="content"
        name="content"
        rows="6"
        placeholder="Write your article content here"
        required
        class="form-textarea"
    >{{ old('content', $article->content) }}</textarea>

    <label for="excerpt" class="form-label">Excerpt</label>
    <textarea
        id="excerpt"
        name="excerpt"
        rows="2"
        placeholder="Short excerpt or summary"
        class="form-textarea"
    >{{ old('excerpt', $article->excerpt) }}</textarea>

    <div class="mb-4">
        <label class="block font-medium mb-1">Featured Image</label>
        @if($article->image_path)
            <img src="{{ asset('storage/'.$article->image_path) }}" alt="{{ $article->image_alt ?? $article->title }}" class="h-24 mb-2 rounded">
        @endif
        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md">
        <input type="text" name="image_alt" value="{{ old('image_alt', $article->image_alt) }}" placeholder="Alt text" class="mt-2 w-full px-4 py-2 border rounded-md">
    </div>

    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" required class="form-select">
        <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
    </select>

    <button type="submit" class="btn-submit">Update Article</button>
</form>
</div>
@endsection
