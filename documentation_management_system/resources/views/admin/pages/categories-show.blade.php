@extends('admin.inc.main')

@section('Admin-contents')

<style>
    .published-articles {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 40px;
        box-shadow: 0 6px 16px var(--card-shadow);
    }

    .category-details h2 {
        font-size: 1.8rem;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .category-details .meta {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 10px;
    }

    .category-details .meta i {
        margin-right: 8px;
    }

    .published-articles h3 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 25px;
    }

    .article-card {
        background: var(--card-light-bg);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: background 0.3s ease;
    }

    .article-card:hover {
        background: var(--primary-light);
    }

    .article-title {
        font-weight: 600;
        color: var(--primary-dark);
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .article-meta {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    .article-snippet {
        font-size: 0.95rem;
        color: var(--text-color);
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }
    .category-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 40px;
    background: var(--card-bg);
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 6px 16px var(--card-shadow), rgba(13, 71, 161, 0.1);
}

/* image wrapper styled like a card */
.category-image {
    display: flex;

    justify-content: end;

}

/* control the actual image size */
.category-image img.cat-img {
    width: 54%;
    max-height: 260px;           
    border-radius: 10px;
    object-fit: cover;           /* crops nicely */
}

/* make details also fill evenly */
.category-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* responsive: stack cards on small screens */
@media (max-width: 900px) {
    .category-section {
        grid-template-columns: 1fr;
    }
    .category-image img.cat-img {
        max-height: 200px;
    }
}

</style>

<main class="main-content">
    <div class="main-container">

        <div class="category-section">
            <div class="category-details">
                <h2><i class="fas {{ $category->icon }}"></i> {{ $category->name }}</h2>
                <div class="meta"><i class="fas fa-link"></i> Slug: {{ $category->slug }}</div>
                <div class="meta"><i class="fas fa-calendar-alt"></i> Created: {{ $category->created_at->format('F j, Y') }}</div>
                <div class="meta"><i class="fas fa-hashtag"></i> Articles: {{ $category->articles->count() }}</div>
            </div>
            <div class="category-image">
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="cat-img">
                {{-- <img src="/images/laptop with icons.jpg" alt="{{ $category->name }}"> --}}

            </div>
        </div>
        


        <!-- Section 2: Frontend-only - Articles published by editors -->
        <div class="published-articles">
            <h3>Published Articles by Editors</h3>
            @foreach($category->articles as $article)
            <a href="{{ route('admin.articles.show', $article->id) }}" style="text-decoration: none; color: inherit;">
                <div class="article-card" style="display: flex; align-items: flex-start; gap: 16px; padding: 12px; border-bottom: 1px solid #eee; cursor: pointer;">
                    
                    {{-- Left side image --}}
                    <div style="flex-shrink: 0; width: 120px; height: 80px; overflow: hidden; border-radius: 6px; background: #f5f5f5;">
                        @if($article->image_path)
                            <img src="{{ asset('storage/' . $article->image_path) }}" 
                                 alt="{{ $article->image_alt ?? $article->title }}" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/book.jpg') }}" 
                                 alt="Default article image" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
            
                    {{-- Right side content --}}
                    <div style="flex: 1;">
                        <div class="article-title" style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">
                            {{ $article->title }}
                        </div>
                        <div class="article-meta" style="font-size: 13px; color: #666; margin-bottom: 6px;">
                            By <strong>
                                {{ $article->editor ? $article->editor->first_name . ' ' . $article->editor->last_name : 'Unknown Editor' }}
                            </strong>
                            on {{ $article->created_at->format('F d, Y') }} ·
                            @if($article->status === 'published')
                                <span style="color: green;">Published</span>
                            @else
                                <span style="color: orange;">Draft</span>
                            @endif
                        </div>
                        <div class="article-snippet" style="font-size: 14px; color: #444;">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                        </div>
                    </div>
            
                </div>
            </a>
            
        @endforeach
        

        </div>



        <!-- Back -->
        <a href="{{ route('admin.categories') }}" class="back-link">← Back to Categories</a>
    </div>
</main>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection
