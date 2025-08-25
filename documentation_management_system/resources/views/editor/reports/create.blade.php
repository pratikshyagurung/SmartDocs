<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create New Report</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Create New Report</h2>

    @if(session('success'))
      <div class="mb-4 text-green-600 font-semibold">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('editor.reports.store') }}" method="POST">
      @csrf

      <!-- Title -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" />
      </div>

      <!-- Category -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Category</label>
        <select name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
          <option value="">Select category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="6" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"></textarea>
      </div>

      <!-- Status -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
          <option value="draft">Draft</option>
          <option value="finalized">Finalized</option>
        </select>
      </div>

      <!-- Submit -->
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
        Submit
      </button>
    </form>
  </div>
</body>
</html>

