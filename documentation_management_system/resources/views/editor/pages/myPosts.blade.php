@extends('editor.inc.main')

@section('contents')
  <style>
    .container {
      max-width: 1100px;
      margin: auto ;
      margin-top: 112px;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .post-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .post-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      transition: box-shadow 0.3s ease;
    }

    .post-card:hover {
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .post-card h2 {
      font-size: 20px;
      margin: 0 0 8px;
    }

    .meta {
      font-size: 14px;
      color: #888;
      margin-bottom: 8px;
    }

    .category {
      font-size: 14px;
      color: #333;
      margin-bottom: 10px;
    }

    .post-card p {
      font-size: 15px;
      color: #555;
      line-height: 1.5;
    }

    .no-posts {
      color: #777;
      font-style: italic;
      margin-top: 40px;
      text-align: center;
    }
  </style>

  <div class="container">

    <div class="mb-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 ">
          
          <!-- Search & Filters Container -->
          <div class="flex flex-wrap gap-4 items-center w-full md:w-auto">
      
            <div class="flex items-center">
              <!-- Search Icon Button -->
              <button id="searchToggle" aria-label="Toggle Search" class="p-2 rounded-full bg-blue-800 hover:bg-blue-700 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                  </svg>
              </button>
          
              <!-- Search Input Container (hidden initially) -->
              <div id="searchInputContainer"
                  class="overflow-hidden max-w-0 transition-all duration-500 ml-3 rounded-lg"
                  style="background: linear-gradient(to right, #012b5b, #0277bd, #ffffff);">
                  <form id="searchForm" method="GET" action="{{ route('editor.myPosts') }}">
                      <input
                          type="text"
                          name="search"
                          placeholder="Search by title ..."
                          value="{{ request('search') }}"
                          class="w-64 md:w-80 px-4 py-2 bg-transparent placeholder-white text-white focus:outline-none"
                      />
                  </form>
              </div>
          </div>
      
            <!-- Filters & Sort -->
            <form id="filterForm" method="GET" action="{{ route('editor.myPosts') }}">
                <select name="category_id" id="typeFilter" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0F2A35]">
                    <option value="">All Types</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </form>
            

          </div>
          
        </div>
    </div>

    <div class="post-list">
      @forelse($articles as $article)
      <div class="post-card flex items-center border p-4 rounded-md shadow-sm">
        {{-- Article Image --}}
        @if($article->image_path)
            <div class="w-32 h-32 flex-shrink-0 mr-4">
                <img src="{{ asset('storage/' . $article->image_path) }}" 
                     alt="{{ $article->image_alt ?? $article->title }}" 
                     class="w-full h-full object-cover rounded-md">
            </div>
        @endif
    
        {{-- Article Content --}}
        <div class="flex-1">
            <div class="meta text-sm text-gray-500 mb-1">
                Article | {{ $article->created_at->format('d M Y') }}
            </div>
            <h2 class="text-lg font-semibold">{{ $article->title }}</h2>
            <div class="category text-sm text-gray-600">
                Category: <strong>{{ $article->category->name ?? 'Uncategorized' }}</strong>
            </div>
            <p class="text-gray-700 mt-2">{{ Str::limit($article->excerpt, 120) }}</p>
        </div>
    
        {{-- Button --}}
        <div class="ml-4">
            <a href="{{ route('editor.articles.show', $article->id) }}"
               class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                View Details
            </a>
        </div>
    </div>
    
      @empty
          {{-- No articles --}}
      @endforelse
      
    </div>

    @if($articles->isEmpty() && $documents->isEmpty())
        <p class="no-posts">No posts found.</p>
    @endif

  </div>

  <script>
    const toggleBtn = document.getElementById('searchToggle');
    const inputContainer = document.getElementById('searchInputContainer');
  
    toggleBtn.addEventListener('click', () => {
      if (inputContainer.style.maxWidth === '320px') {
        inputContainer.style.maxWidth = '0';
        inputContainer.querySelector('input').value = '';
      } else {
        inputContainer.style.maxWidth = '320px';
        inputContainer.querySelector('input').focus();
      }
    });

    // Auto-submit form when category is selected
    document.getElementById('typeFilter').addEventListener('change', function() {
      document.getElementById('filterForm').submit();
    });
  </script>
@endsection