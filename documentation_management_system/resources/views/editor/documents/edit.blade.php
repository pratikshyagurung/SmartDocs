<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Document</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Document</h2>

    @if(session('success'))
      <div class="mb-4 text-green-600 font-semibold">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('editor.documents.update', $document->id) }}" method="POST">
      @csrf
      @method('PUT')

      <!-- Title -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input 
          type="text" 
          name="title" 
          required 
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" 
          value="{{ old('title', $document->title) }}"
        />
      </div>

      <!-- Category Type -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Category Type</label>
        <select 
          name="type" 
          required 
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
        >
          <option value="">Select type</option>
          @foreach($categories as $category)
            <option value="{{ $category->name }}" {{ old('type', $document->type) == $category->name ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Content -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Content</label>
        <textarea 
          name="content" 
          rows="6" 
          required 
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
        >{{ old('content', $document->content) }}</textarea>
      </div>

      <!-- Status -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select 
          name="status" 
          required 
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"
        >
          <option value="draft" {{ old('status', $document->status) == 'draft' ? 'selected' : '' }}>Draft</option>
          <option value="published" {{ old('status', $document->status) == 'published' ? 'selected' : '' }}>Published</option>
        </select>
      </div>

      <!-- Submit -->
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
        Update Document
      </button>
    </form>
  </div>
</body>
</html>
