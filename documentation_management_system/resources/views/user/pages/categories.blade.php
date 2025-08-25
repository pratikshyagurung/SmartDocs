@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
      .categorieshero {
          margin: 24px auto 0;
          width: calc(100% - 64px);
          max-width: 1200px;
          height: 530px;
          border-radius: 40px;
          position: relative;
          overflow: hidden;
        }

        .categorieshero img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          border-radius: 40px;
          position: absolute;
          top: 0;
          left: 0;
          z-index: 1;
        }

        .categorieshero::before {
          content: "";
          position: absolute;
          inset: 0;
          background: rgba(0, 0, 0, 0.5);
          border-radius: 40px;
          z-index: 2;
        }

        .categorieshero nav {
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


        .scroll-wrapper {
              overflow: hidden;
              position: relative;
            }
          
            .scroll-container {
              display: flex;
              gap: 1.5rem;
              overflow-x: auto;
              scroll-snap-type: x mandatory;
              scroll-behavior: smooth;
            }
          
            .scroll-container::-webkit-scrollbar {
              display: none;
            }
          
            .scroll-card {
              flex: 0 0 16rem;
              scroll-snap-align: start;
            }
          
            .scroll-arrow {
              position: static;
              top: auto;
              transform: none;
              box-shadow: none;
              border: none;
              background: transparent;
              padding: 0;
              cursor: pointer;
            }
          
            .scroll-arrow svg {
              transition: color 0.3s;
            }
          
            .scroll-arrow:hover svg {
              color: #0F2A35;
            }
    </style>

    <div class="categorieshero">
      <img src="/images/laptop with docs.jpg" alt="CategoriesHero Background">

    <!-- Fixed Navbar inside categorieshero -->
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
        <section class="relative z-10 text-white px-6 md:px-20 py-24 overflow-hidden shadow-xl rounded-3xl">
            <!-- Gradient Background Layer -->
            <div class="absolute inset-0  -z-10"></div>
          
            <div class="relative max-w-5xl mx-auto space-y-10">
              <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
                Categories that <span class="text-white">organize knowledge</span><br />
                for clarity and action.
              </h1>
              <p class="text-lg text-white-700 max-w-2xl">
                Find exactly what you're looking for across a well-structured collection of articles, guides, and resources...
              </p>
              <div>
                <span class="inline-flex items-center gap-3 text-white font-semibold ">
                    Explore All Docs 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
                  
              </div>
            </div>
        </section>
          
    </div>
    
    <div class="max-w-7xl mx-auto px-8 sm:px-8 lg:px-10 py-10">

          
        <!-- In Progress Section -->
        <div class="mb-12">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">In Progress (<span id="in-progress-count">0</span>)</h2>
            <div class="flex gap-2">
              <button id="in-progress-left" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
              </button>
              <button id="in-progress-right" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>
          </div>

          <div class="scroll-wrapper">
            <div id="in-progress-scroll" class="scroll-container">
            </div>
          </div>
        </div>



        <!-- Top Picks Section -->
        <div class="mb-12">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Top Picks for You</h2>
            <div class="flex gap-2">
              <button id="top-picks-left" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
              </button>
              <button id="top-picks-right" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>
          </div>
          <div class="scroll-wrapper">
            <div id="top-picks-scroll" class="scroll-container">
              @forelse($topPicks as $article)
              <a href="{{ route('user.article.show', $article->slug) }}?source=category&category={{ $article->category->slug ?? 'uncategorized' }}"
                class="scroll-card bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden group"
                aria-label="Open {{ $article->title }}">
                @if($article->image_path)
                <img 
                    src="{{ asset('storage/' . $article->image_path) }}" 
                    alt="{{ $article->image_alt ?? $article->title }}" 
                    class="w-full h-40 object-cover"
                >
            @else
                <img 
                    src="{{ asset('images/laptop with icons.jpg') }}" 
                    alt="Default article image" 
                    class="w-full h-40 object-cover"
                >
            @endif
                           <div class="p-4">
                 <p class="text-xs text-gray-500 mb-1">{{ $article->category->name ?? 'General' }}</p>
                 <h3 class="font-semibold group-hover:underline">{{ $article->title }}</h3>
                 <p class="text-sm text-gray-500">
                   By: {{ trim(($article->editor->first_name ?? '').' '.($article->editor->last_name ?? '')) }}
                 </p>
                 <p class="text-xs text-gray-400 mt-1">{{ $article->likes_count ?? 0 }} Likes</p>
               </div>
             </a>
              @empty
                <p class="text-gray-500">No recommendations yet.</p>
              @endforelse
            </div>
          </div>
        </div>

        <!-- Trending Section -->
        <div class="mb-12">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Trending for You</h2>
            <div class="flex gap-2">
              <button id="trending-left" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
              </button>
              <button id="trending-right" class="scroll-arrow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>
          </div>
          <div class="scroll-wrapper">
            <div id="trending-scroll" class="scroll-container">
              @forelse($trending as $article)
              <a href="{{ route('user.article.show', $article->slug) }}?source=category&category={{ $article->category->slug ?? 'uncategorized' }}"
                class="scroll-card bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden group"
                aria-label="Open {{ $article->title }}">
                @if($article->image_path)
                <img 
                    src="{{ asset('storage/' . $article->image_path) }}" 
                    alt="{{ $article->image_alt ?? $article->title }}" 
                    class="w-full h-40 object-cover"
                >
            @else
                <img 
                    src="{{ asset('images/laptop with icons.jpg') }}" 
                    alt="Default article image" 
                    class="w-full h-40 object-cover"
                >
            @endif
                           <div class="p-4">
                 <p class="text-xs text-gray-500 mb-1">{{ $article->category->name ?? 'General' }}</p>
                 <h3 class="font-semibold group-hover:underline">{{ $article->title }}</h3>
                 <p class="text-sm text-gray-500">
                   By: {{ trim(($article->editor->first_name ?? '').' '.($article->editor->last_name ?? '')) }}
                 </p>
                 <p class="text-xs text-gray-400 mt-1">{{ $article->likes_count ?? 0 }} Likes | {{ $article->views ?? 0 }} Views</p>
               </div>
             </a>
              @empty
                <p class="text-gray-500">No trending articles available.</p>
              @endforelse
            </div>
          </div>
        </div>

    </div>


      
      <!-- JS Scroll Setup -->
      <script>
        function setupScroll(containerId, leftId, rightId) {
        const container = document.getElementById(containerId);
        const left = document.getElementById(leftId);
        const right = document.getElementById(rightId);

        function updateArrows() {
            if (container.scrollLeft === 0) {
            // At start: only show right arrow if scrollable
            left.style.display = 'none';
            right.style.display = container.scrollWidth > container.clientWidth ? 'block' : 'none';
            } else if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 1) {
            // At end: only show left arrow
            left.style.display = 'block';
            right.style.display = 'none';
            } else {
            // In the middle: show both arrows
            left.style.display = 'block';
            right.style.display = 'block';
            }
        }

        left.onclick = () => container.scrollBy({ left: -340, behavior: 'smooth' });
        right.onclick = () => container.scrollBy({ left: 340, behavior: 'smooth' });

        container.addEventListener('scroll', updateArrows);
        window.addEventListener('resize', updateArrows);
        updateArrows();
        }

        setupScroll('in-progress-scroll', 'in-progress-left', 'in-progress-right');
        setupScroll('top-picks-scroll', 'top-picks-left', 'top-picks-right');
        setupScroll('trending-scroll', 'trending-left', 'trending-right');

      </script>

        
<script>
  @if(Auth::check())
  let articleId = {{ $article->id }};
  let progress = 0; // initial progress in seconds
  
  fetch("{{ route('progress.list') }}")
      .then(res => res.json())
      .then(data => {
          const progressObj = data.find(p => p.article.id === articleId);
          if (progressObj) progress = progressObj.progress_seconds;
      });
  
  // increment progress every 5 seconds
  let interval = setInterval(() => {
      progress += 5;
  
      fetch("{{ route('progress.update') }}", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
              article_id: articleId,
              progress_seconds: progress
          })
      })
      .then(res => res.json())
      .then(data => {
          if(data.status === 'success' && progress >= 60){
              clearInterval(interval); // stop interval if deleted
          }
      })
      .catch(err => console.error(err));
  }, 5000); // every 5 seconds
  @endif
  </script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      const container = document.getElementById("in-progress-scroll");
      const countSpan = document.getElementById("in-progress-count");
  
      function fetchProgress() {
          fetch("{{ route('progress.list') }}")
              .then(res => res.json())
              .then(data => {
                  countSpan.textContent = data.length;
                  if (data.length === 0) {
                      container.innerHTML = `<p class="text-gray-500">No articles in progress.</p>`;
                      return;
                  }
  
                  container.innerHTML = data.map(progress => {
                      let article = progress.article;
                      if (!article) return "";
  
                      return `
                      <a href="{{ url('user/articles') }}/${article.slug}?source=category&category=${article.category ? article.category.slug : 'uncategorized'}"
                        class="scroll-card bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden group"
                        data-article-id="${article.id}">
                          <img src="${article.image_path ? '/storage/' + article.image_path : '/images/laptop with icons.jpg'}"
                               alt="${article.image_alt ?? article.title}" class="w-full h-40 object-cover">
                          <div class="p-4">
                              <p class="text-sm text-gray-500 mb-1">${article.category ? article.category.name : 'Learning Path'}</p>
                              <h3 class="font-semibold group-hover:underline">${article.title}</h3>
                              <div class="mt-3 h-2 bg-gray-200 rounded-full">
                                  <div class="h-2 bg-[#0F2A35] rounded-full" style="width: ${Math.min(progress.progress_seconds, 100)}%"></div>
                              </div>
                          </div>
                      </a>`;
                  }).join("");
              });
      }
  
      fetchProgress();
      setInterval(fetchProgress, 5000); // auto-refresh every 5 seconds
  });
  </script>
    
  
        


@endsection
