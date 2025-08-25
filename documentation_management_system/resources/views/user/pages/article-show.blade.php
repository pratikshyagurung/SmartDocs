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
      border-radius: 40px;
      position: relative;
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

    .container {
    max-width: 1100px;
    margin: auto;
    padding: 32px;
    font-family: Arial, sans-serif;
    color: #333;
}
.breadcrumb {
    font-size: 14px;
    color: #777;
    margin-bottom: 16px;
}
.breadcrumb a {
    color: #000000;
    text-decoration: none;
}
.breadcrumb a:hover {
    text-decoration: underline;
}
.title-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.title-bar h1 {
    font-size: 28px;
    margin: 0;
}
.download-icon-button {
    background-color: #4b4b4b;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(13, 71, 161, 0.2);
    transition: background-color 0.3s ease;
    margin-bottom: 24px;
}

.download-icon-button:hover {
    background-color: #000000;
    animation: bounce-icon 0.6s infinite alternate;
}

.download-icon {
    width: 20px;
    height: 20px;
    fill: #fff;
}

@keyframes bounce-icon {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-5px);
    }
}
.report-container {
    margin-bottom: 12px;
}
.main-image {
    width: 100%;
    height: auto;
    border-radius: 6px;
    object-fit: cover;
}
.meta {
    font-size: 14px;
    color: #888;
    margin-bottom: 16px;
}
/* .description p {
    line-height: 1.6;
    margin-bottom: 16px;
} */
.modern-toggle-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    background-color: #000000;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 20px;
}
.modern-toggle-btn:hover {
    background-color: #000000;
}
.arrow-icon {
    transition: transform 0.3s ease;
}
.modern-toggle-btn.expanded .arrow-icon {
    transform: rotate(180deg);
}
.author-info {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 24px;
}
.author-photo {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc;
}

.description {
    font-family: "Georgia", "Times New Roman", serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.description p {
    margin-bottom: 1.2em;
}

.description h1,
.description h2,
.description h3 {
    margin: 1.5em 0 0.6em;
    font-weight: bold;
    line-height: 1.3;
}

.description h1 { font-size: 2rem; }
.description h2 { font-size: 1.6rem; }
.description h3 { font-size: 1.3rem; }

.description ul,
.description ol {
    margin: 1em 0 1em 1.5em;
    padding-left: 1em;
}

.description li {
    margin-bottom: 0.6em;
}

.description img {
    display: block;
    margin: 1.5em auto;
    max-width: 100%;
    border-radius: 8px;
}

.description blockquote {
    margin: 1.5em 0;
    padding: 1em 1.5em;
    background: #f9f9f9;
    border-left: 4px solid #ccc;
    font-style: italic;
    color: #555;
}

</style>

<div class="allArticlehero">
    <!-- Navbar -->
    <nav>
        <div class="left">
            <a href="{{ route('user.home') }}"><span>Smart Docs</span></a>
            <ul>
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.all-articles') }}">All Articles</a></li>
                <li><a href="{{ route('user.categories') }}">Categories</a></li>
                <li><a href="{{ route('user.about') }}">About</a></li>
                <li><a href="{{ route('user.feedback') }}">Feedbacks</a></li>
            </ul>
        </div>
        <div class="right">
            <div class="profile-icon">
                <a href="{{ route('user.Userprofile') }}">
                    <img src="{{ auth()->user()->profile_image ? asset('uploads/users/' . auth()->user()->profile_image) : '/images/profile.png' }}" 
                         alt="Profile">
                </a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>
    </nav>
</div>

<div class="container">
    <!-- Breadcrumb -->
{{-- Breadcrumb --}}
<nav class="breadcrumb text-sm text-gray-600 mb-6">
    @if($source === 'my-posts')
        @if(Route::has('user.my-posts'))
          <a href="{{ route('user.my-posts') }}" class="hover:underline">My Posts</a> &gt;
        @endif
        <span>{{ $category->name ?? 'Uncategorized' }}</span>

    @elseif($source === 'category')
        {{-- Link back to categories index --}}
        @if(Route::has('user.categories'))
          <a href="{{ route('user.categories') }}" class="hover:underline">Categories</a> &gt;
        @endif

        {{-- If you have a single-category page, show it as a link; else show plain text --}}
        @if(!empty($categorySlugParam) && Route::has('user.category.show'))
          <a href="{{ route('user.category.show', ['slug' => $categorySlugParam]) }}" class="hover:underline">
            {{ $category->name ?? 'Category' }}
          </a>
        @else
          <span>{{ $category->name ?? 'Category' }}</span>
        @endif

    @else
        {{-- Default/fallback: All Articles --}}
        @if(Route::has('user.all-articles'))
          <a href="{{ route('user.all-articles') }}" class="hover:underline">All Articles</a> &gt;
        @endif
        <span>{{ $category->name ?? 'Uncategorized' }}</span>
    @endif
  </nav>

    <!-- Title Bar -->
    <div class="title-bar">
        <h1>{{ $article->title }}</h1>
        <a href="{{ route('user.article.download', $article->id) }}" class="download-icon-button" title="Download">
            <svg class="download-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5-.5h4V1.5a.5.5 0 0 1 1 0v7.9h4a.5.5 0 0 1 .4.8l-4 5a.5.5 0 0 1-.8 0l-4-5a.5.5 0 0 1-.1-.4z"/>
            </svg>
        </a>
        </a>
    </div>

    <!-- Main Image -->
    <div class="report-container">
        @if($article->image_path)
            <img 
                src="{{ asset('storage/' . $article->image_path) }}" 
                alt="{{ $article->image_alt ?? $article->title }}" 
                class="main-image"
            >
        @else
            <img 
                src="{{ asset('images/book.jpg') }}" 
                alt="Default article image" 
                class="main-image"
            >
        @endif
    </div>
    

<!-- Meta Info -->
<div class="meta grid grid-cols-2 items-center">
    <div>
        {{ $category->name ?? 'Uncategorized' }} | {{ $article->created_at->format('d F Y') }}
    </div>
    
<!-- Meta row (right side like button) -->
<div class="text-right">
    <form action="{{ route('user.article.like', $article) }}" method="POST">
        @csrf
        <button type="submit" class="focus:outline-none" title="{{ $likedByMe ? 'Unlike' : 'Like' }}">
            @if($likedByMe)
                <i class="fas fa-heart text-red-600 text-lg"></i>
            @else
                <i class="far fa-heart text-gray-600 text-lg"></i>
            @endif
        </button>
    </form>
    <p>{{ $article->likes_count }} Likes</p>
</div>

</div>



    <!-- Article Description -->
    <div class="description" >
        {!! $article->content !!}
    </div>
    

    <!-- Author Info -->
    <div class="author-info">
        <img 
        src="{{ $article->editor && $article->editor->profile_image && file_exists(public_path('uploads/editors/' . $article->editor->profile_image)) 
            ? asset('uploads/editors/' . $article->editor->profile_image) 
            : asset('images/profile.png') }}" 
        alt="Editor Profile"
        class="w-10 h-10 rounded-full border-2 border-white object-cover"
    />

        <div>
            <strong>{{ $article->editor->first_name }} {{ $article->editor->last_name }}</strong><br>
            <span>Author</span>
        </div>
    </div>

<!-- Comments Section -->
<div class="mt-10">
    <h2 class="text-2xl font-semibold mb-6">Comments</h2>

    @auth
    <form action="{{ route('comments.store', $article->id) }}" method="POST" class="mb-6">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="content" rows="3" placeholder="Write your comment..."
                  class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"></textarea>
        <button type="submit" 
                class="mt-2 px-4 py-2 bg-gray-600 text-white rounded hover:bg-black">
            Post Comment
        </button>
    </form>
    @endauth

    @forelse($article->comments as $comment)
        <div class="mb-6 border-b pb-4">
            <div class="flex items-center mb-2">
                <img src="file://{{ public_path('storage/articles/' . $article->image) }}" 
                style="width:100%; max-width:600px; height:auto; margin-bottom:20px;" 
                alt="Article Image">
           
                <div>
                    <p class="font-semibold">
                        {{ ($comment->user->first_name ?? $comment->editor->first_name) . ' ' . ($comment->user->last_name ?? $comment->editor->last_name) }}
                    </p>
                    
                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <p class="ml-11">{{ $comment->comment }}</p>

            @auth
            <button onclick="toggleReplyForm({{ $comment->id }})"
                    class="ml-11 mt-2 text-sm text-blue-600 hover:underline">
                Reply
            </button>

            <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.reply', $comment->id) }}" method="POST" 
                  class="ml-11 mt-2 hidden">
                @csrf
                <textarea name="content" rows="2" placeholder="Write your reply..."
                          class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"></textarea>
                <button type="submit" 
                        class="mt-2 px-3 py-1 bg-gray-600 text-white rounded hover:bg-black">
                    Reply
                </button>
            </form>
            @endauth

            @foreach($comment->replies as $reply)
                <div class="ml-11 mt-4 border-l pl-4">
                    <div class="flex items-center mb-1">
                        <img src="{{ $reply->user->profile_image 
                                ? asset('uploads/users/' . $reply->user->profile_image) 
                                : asset('images/profile.png') }}" 
                             alt="User" 
                             class="w-7 h-7 rounded-full mr-2 object-cover">
                        <div>
                            <p class="font-semibold">{{ $reply->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p class="ml-9">{{ $reply->comment }}</p>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-gray-600">No comments yet. Be the first to comment!</p>
    @endforelse
</div>

<script>
    function toggleReplyForm(id) {
        const form = document.getElementById('reply-form-' + id);
        form.classList.toggle('hidden');
    }
</script>

</div>

@endsection
