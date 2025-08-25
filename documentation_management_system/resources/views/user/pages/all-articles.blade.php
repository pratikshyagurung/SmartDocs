@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

<style>
  .allArticlehero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: 530px;
      border-radius: 40px;
      position: relative;
      overflow: hidden;
    }

    .allArticlehero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 40px;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .allArticlehero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 40px;
      z-index: 2;
    }

    .allArticlehero nav {
      position: relative;
      z-index: 4;
      padding: 20px 63px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 18px;
      width: 100%;
    }

    nav .left {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    nav .left span {
      background: #fff;
      color: #000;
      padding: 6px 12px;
      font-size: 12px;
      font-weight: 600;
      border-radius: 9999px;
    }

    nav .left ul {
      display: flex;
      list-style: none;
      gap: 24px;
      font-size: 14px;
      font-weight: 500;
      color: #ccc;
    }

    nav .left ul li a:hover {
      color: #fff;
    }

    nav .right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .profile-icon img {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      border: 2px solid #fff;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .profile-icon img:hover {
      transform: scale(1.05);
    }

    .logout-btn {
      border: 1px solid #fff;
      background: transparent;
      color: #fff;
      padding: 8px 16px;
      border-radius: 9999px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .logout-btn:hover {
      background: #fff;
      color: #000;
    }

    /* Additional custom styles */
    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .article-card {
        transition: all 0.3s ease;
    }
    .profile-dropdown {
        display: none;
        position: absolute;
        right: 0;
        z-index: 10;
        margin-top: 0.5rem;
        min-width: 10rem;
        padding: 0.5rem 0;
        background-color: white;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .profile-dropdown.show {
        display: block;
        margin-top: 180px;
    }
    .profile-dropdown a {
        display: block;
        padding: 0.5rem 1rem;
        color: #4b5563;
        font-size: 0.875rem;
    }
    .profile-dropdown a:hover {
        background-color: #f3f4f6;
        color: #111827;
    }
    .profile-container {
        position: relative;
    }

    /* Hero text styles */
    .white-gradient-text {
        background: linear-gradient(90deg, rgba(255,255,255,1), rgba(255,255,255,0.7), rgba(255,255,255,0.4));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
    }
    .vertical-bar-white {
        color: white;
        font-weight: 900;
        user-select: none;
    }
    .hero-content h1 {
        color: #fff;
        font-size: 50px;
        font-weight: 700;
        line-height: 1.3;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeSlideUp 1s forwards;
        animation-delay: 0.3s;
    }

    .fade-in-left, .fade-in-right {
        opacity: 0;
        animation: fadeSlideSide 1s forwards;
    }
    .fade-in-left {
        transform: translateX(-20px);
        animation-delay: 0.6s;
    }
    .fade-in-right {
        transform: translateX(20px);
        animation-delay: 0.6s;
    }

    .button-animate {
        opacity: 0;
        transform: scale(0.95);
        animation: fadeScaleIn 0.8s forwards;
        animation-delay: 1s;
        transition: transform 0.3s ease;
    }
    .button-animate:hover {
        transform: scale(1.05);
    }

    @keyframes fadeSlideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeSlideSide {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeScaleIn {
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .bottom-60 {
        bottom: 13rem; /* 208px */
    }
    .right-14 {
        right: 9.5rem; /* 152px */
    }
</style>

<div class="allArticlehero">
    <img src="/gif/typing.gif" alt="Hero Background">
    
    <!-- Navbar with consistent styling -->
    <nav>
        <div class="left">
            <a href="{{ route('user.home') }}"><span>Smart Docs</span></a>
            <ul>
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.all-articles') }}">All Articles</a></li>
                <li><a href="{{ route('user.categories') }}">Categories</a></li>
                <li><a href="{{ route('user.top-performer') }}">Top Performer</a></li>
                <li><a href="{{ route('user.about') }}">About</a></li>
                <li><a href="{{ route('user.feedback') }}">Feedbacks</a></li>
            </ul>
        </div>
        <div class="right">
            <!-- Profile Icon -->
            <div class="profile-icon">
                <a href="{{ route('user.Userprofile') }}">
                    <img src="{{ auth()->user()->profile_image ? asset('uploads/users/' . auth()->user()->profile_image) : '/images/profile.png' }}" 
                    alt="Profile">
                  </a>
            </div>
            
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    Log Out
                </button>
            </form>
        </div>
    </nav>
<!-- Hero text -->
<div class="hero-content relative z-10 flex items-center justify-center h-full mx-20 my-8">

    <style>
      .white-gradient-text {
        background: linear-gradient(90deg, rgba(255,255,255,1), rgba(255,255,255,0.7), rgba(255,255,255,0.4));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
  
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
      }
      .vertical-bar-white {
        color: white;
        font-weight: 900;
        user-select: none;
      }
      .hero-content h1 {
        color: #fff;
        font-size: 50px;
        font-weight: 700;
        line-height: 1.3;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeSlideUp 1s forwards;
        animation-delay: 0.3s;
      }
  
      .fade-in-left, .fade-in-right {
        opacity: 0;
        animation: fadeSlideSide 1s forwards;
      }
      .fade-in-left {
        transform: translateX(-20px);
        animation-delay: 0.6s;
      }
      .fade-in-right {
        transform: translateX(20px);
        animation-delay: 0.6s;
      }
  
      .button-animate {
        opacity: 0;
        transform: scale(0.95);
        animation: fadeScaleIn 0.8s forwards;
        animation-delay: 1s;
        transition: transform 0.3s ease;
      }
      .button-animate:hover {
        transform: scale(1.05);
      }
  
      @keyframes fadeSlideUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
  
      @keyframes fadeSlideSide {
        to {
          opacity: 1;
          transform: translateX(0);
        }
      }
  
      @keyframes fadeScaleIn {
        to {
          opacity: 1;
          transform: scale(1);
        }
      }
  
      .bottom-60 {
        bottom: 13rem; /* 208px */
      }
      .right-14 {
        right: 9.5rem; /* 152px */
      }
    </style>
  
    <div class="absolute top-6 left-6 max-w-xs text-right px-5 py-3">
      <h1 class="white-gradient-text">
        <span class="vertical-bar-white">|</span> All Articles
      </h1>
    </div>
  
    <!-- Left bottom text -->
    <div class="absolute bottom-70 left-6 text-white text-sm px-4 py-2 max-w-xs text-right fade-in-left">
      <p class="leading-relaxed">
        Dive into a curated collection <br>of expert articles and resources— <br>designed to guide, inform, and <br> inspire your learning journey.
      </p>
    </div>
  
    <!-- Right top paragraph -->
    <div class="absolute top-6 right-6 text-white text-sm px-5 py-3 max-w-xs text-left fade-in-right">
      <p class="leading-relaxed">
        Welcome to your knowledge space. Browse categorized articles, tutorials, and documentation — built for clarity, simplicity, and speed.
      </p>
    </div>
  
    <!-- Bottom right button -->
    <div class="absolute bottom-60 right-14">
      <button
        class="bg-gray-300 text-black font-semibold px-5 py-2 rounded-full shadow-md border border-gray-600 flex items-center gap-2 hover:bg-white hover:text-black transition duration-300 ease-in-out button-animate"
      >
        Write Ascend
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M7 7h10v10" />
        </svg>
      </button>
    </div>
  </div>
  

    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filter/Sort Controls -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0 ml-4">
                <label for="sort" class="block text-sm font-medium text-gray-700">Sort by</label>
                <select id="sort" name="sort" onchange="handleSortChange(this)"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0F2A35] focus:border-[#0F2A35] sm:text-sm rounded-md">
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="views" {{ request('sort') === 'views' ? 'selected' : '' }}>Most Viewed</option>
                    <option value="alphabetical" {{ request('sort') === 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                </select>
            </div>

            <form method="GET" action="{{ route('user.all-articles') }}" class="flex items-center gap-4">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full border border-gray-300 rounded-md py-2 px-4 pl-10 text-base placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0F2A35] focus:border-[#0F2A35]"
                        placeholder="Filter articles...">
                    <div class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <button type="submit" class="hidden sm:inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#0F2A35] hover:bg-[#0d212b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0F2A35]">
                    Search
                </button>
            </form>
        </div>
    
        <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($articles as $article)
            <div class="article-card bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                      <div >
                        @if($article->image_path)
                            <img 
                                src="{{ asset('storage/' . $article->image_path) }}" 
                                alt="{{ $article->image_alt ?? $article->title }}" 
                                class="w-10 h-10 object-cover rounded"
                            >
                        @else
                            <i class="fas fa-file-alt text-xl" style="color:#0F2A35"></i>
                        @endif
                    </div>
                    
                        <div class="ml-4">
                            <div class="flex items-center">
                                @if($article->created_at->diffInDays() < 7)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">New</span>
                                @endif
                                <span class="ml-2 text-xs text-gray-500">{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="mt-1 text-lg font-medium text-gray-900">{{ $article->title }}</h3>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-gray-600">
                        {{ Str::limit($article->excerpt, 120) }}
                    </p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs font-medium" style="color:#0F2A35">{{ $article->category->name }}</span>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ number_format($article->views) }} views</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.article.show', $article->slug) }}" class="inline-flex items-center text-sm font-medium hover:underline" style="color:#0F2A35">
                            Read article
                            <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($articles->hasPages())
        <div class="mt-12 flex items-center justify-between">
            
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $articles->firstItem() }}</span> to 
                    <span class="font-medium">{{ $articles->lastItem() }}</span> of 
                    <span class="font-medium">{{ $articles->total() }}</span> articles
                </p>
            </div>
            <div class="flex space-x-2">
                {{-- Previous Page Link --}}
                @if ($articles->onFirstPage())
                    <span class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-white cursor-not-allowed">
                        Previous
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    @if ($page == $articles->currentPage())
                        <span class="px-3 py-1 border rounded-md text-sm font-medium text-white hover:bg-[#0d212b]" style="background-color:#0F2A35; border-color:#0F2A35">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-white cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>

    <script>
        function handleSortChange(select) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', select.value);
            window.location.href = url.toString();
        }
        </script>
@endsection