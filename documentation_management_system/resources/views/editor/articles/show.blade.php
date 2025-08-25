@extends('editor.inc.main')
@section('contents')

<style>
    .container {
        max-width: 1200px;
        margin: 100px auto;
        padding: 24px;
        font-family: Arial, sans-serif;
    }

    .breadcrumb {
      font-size: 14px;
      margin-bottom: 20px;
  }
  
  .breadcrumb a {
      color: #007BFF;
      text-decoration: none;
  }
  
  .breadcrumb a:hover {
      text-decoration: underline;
  }
  
  .breadcrumb span {
      color: #333;
  }

    h1 {
      font-size: 32px;
      font-weight: bold;
      line-height: 1.3;
      margin-bottom: 30px;
    }

    .report-container {
      position: relative;
      max-width: 800px;
    }

    .main-image {
      width: 100%;
      height: 460px;
      display: block;
      border-radius: 8px;
    }

    .cover-image {
      position: absolute;
      top: 20px;
      right: 40px;
      width: 200px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .meta {
      margin: 20px 0 10px;
      color: #555;
      font-size: 14px;
    }

    .title-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 30px;
}

.title-bar {
    font-size: 32px;
    font-weight: bold;
    margin: 0;
    max-width: 800px;
}

.download-icon-button {
    background-color: #0d47a1;
    width: 54px;
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
    background-color: #1565c0;
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


    .description {
      font-size: 16px;
      line-height: 1.6;
      max-width: 800px;
    }
    .edit-link {
        color: #0055aa;
        text-decoration: none;
    }

    .edit-link:hover {
        text-decoration: underline;
    }
    .description p {
    margin-bottom: 1em;
    line-height: 1.6;
}

.modern-toggle-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 9999px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 4px 10px rgba(30, 60, 114, 0.2);
}

.modern-toggle-btn:hover {
    background: linear-gradient(135deg, #2a5298, #1e3c72);
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(30, 60, 114, 0.25);
}

.modern-toggle-btn:active {
    transform: scale(0.97);
}

.arrow-icon {
    transition: transform 0.3s ease;
}

.modern-toggle-btn.expanded .arrow-icon {
    transform: rotate(180deg);
}


</style>

  
<div class="container">
  {{-- <nav class="breadcrumb">
    <a href="{{ route('editor.categories.detail', ['slug' => $category->slug]) }}">Categories</a> &gt;
    <span>{{ $category->name }}</span>
  </nav> --}}

  <nav class="breadcrumb">
    @if($source === 'my-posts')
        <a href="{{ route('editor.myPosts') }}">My Posts</a> &gt;
        <span>{{ $category->name }}</span>
    @elseif($source === 'category')
        <a href="{{ route('editor.categories.detail', ['slug' => $article->category->slug ?? 'uncategorized']) }}">Categories</a> &gt;
        <span>{{ $category->name }}</span>
    @else
        <!-- fallback or default breadcrumb -->
        <span>{{ $category->name }}</span>
    @endif
</nav>


  


  <div class="title-bar">
    <h1>{{ $article->title }}</h1>

    <a href="{{ route('editor.article.download', $article->id) }}" class="download-icon-button" title="Download">
        <svg class="download-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5-.5h4V1.5a.5.5 0 0 1 1 0v7.9h4a.5.5 0 0 1 .4.8l-4 5a.5.5 0 0 1-.8 0l-4-5a.5.5 0 0 1-.1-.4z"/>
        </svg>
    </a>
</div>

    <div class="report-container">
        <img 
        src="{{ $article->image_path ? asset('storage/' . $article->image_path) : asset('images/book.jpg') }}" 
        alt="{{ $article->image_alt ?? $article->title }}" 
        class="main-image"
    >    </div>

    <div class="meta">{{ $category->name }} | {{ \Carbon\Carbon::parse($article->created_at)->format('j F Y') }}</div>
  

    
    @php
    $chunkSize = 300;
    $paragraphs = str_split(trim($article->content), $chunkSize);
@endphp

<div class="description" id="article-description">
    {{-- Show first 3 paragraphs --}}
    @foreach (array_slice($paragraphs, 0, 3) as $i => $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

    {{-- Hidden extra paragraphs --}}
    <div id="extra-paragraphs" style="display: none;">
        @foreach (array_slice($paragraphs, 3) as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
    </div>

    {{-- Toggle button --}}
    @if (count($paragraphs) > 3)
    <button id="toggle-btn" class="modern-toggle-btn">
      <span class="label">Read more</span>
      <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.5 5.5a.5.5 0 0 1 .707 0L8 11.293 13.793 5.5a.5.5 0 0 1 .707.707l-6 6a.5.5 0 0 1-.707 0l-6-6A.5.5 0 0 1 1.5 5.5z"/>
      </svg>
  </button>
  
  
  
    @endif
</div>

<div style="display: flex; align-items: center; gap: 16px; margin-top: 24px;">
    <img 
    src="{{ $article->editor && $article->editor->profile_image && file_exists(public_path('uploads/editors/' . $article->editor->profile_image)) 
        ? asset('uploads/editors/' . $article->editor->profile_image) 
        : asset('images/profile.png') }}" 
    alt="Editor Profile"
    class="w-10 h-10 rounded-full border-2 border-white object-cover"
/>
  <div style="font-size: 16px; color: #333;">
      <strong>{{ $article->editor->first_name }} {{ $article->editor->last_name }}</strong><br>
      <span>Editor</span>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('toggle-btn');
      const extraContent = document.getElementById('extra-paragraphs');
      const label = toggleBtn.querySelector('.label');
      const icon = toggleBtn.querySelector('.arrow-icon');

      toggleBtn.addEventListener('click', function () {
          const isExpanded = extraContent.style.display === 'block';

          extraContent.style.display = isExpanded ? 'none' : 'block';
          toggleBtn.classList.toggle('expanded', !isExpanded);
          label.textContent = isExpanded ? 'Read more' : 'Read less';

          if (!isExpanded) {
              extraContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
      });
  });
</script>
</div>

@endsection
