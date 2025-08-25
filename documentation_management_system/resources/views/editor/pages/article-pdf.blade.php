<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $article->title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { font-size: 22px; margin-bottom: 10px; }
        .meta { font-size: 12px; color: #555; margin-bottom: 20px; }
        .content p { margin-bottom: 10px; line-height: 1.5; }
        .editor { margin-top: 30px; font-size: 14px; }
        .article-image, .main-image { width: 100%; max-width: 600px; height: auto; margin-bottom: 20px; }
        .editor-image { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 10px; vertical-align: middle; }
        .editor-info { display: inline-block; vertical-align: middle; }
    </style>
</head>
<body>
    <h1>{{ $article->title }}</h1>

    {{-- Main report container image --}}
    @if(file_exists(public_path('images/book.jpg')))
        <div class="report-container">
            <img src="{{ public_path('images/book.jpg') }}" alt="Main Image" class="main-image">
        </div>
    @endif

    {{-- Article image --}}
    @if($article->image && file_exists(public_path('uploads/articles/' . $article->image)))
        <img src="{{ public_path('uploads/articles/' . $article->image) }}" class="article-image" alt="Article Image">
    @endif

    <div class="meta">
        Category: {{ $article->category->name ?? '' }} | 
        Published: {{ \Carbon\Carbon::parse($article->created_at)->format('j F Y') }}
    </div>

    <div class="content">
        {!! nl2br(e($article->content)) !!}
    </div>

    <div class="editor">
        @if($article->editor && $article->editor->profile_image && file_exists(public_path('uploads/editors/' . $article->editor->profile_image)))
            <img src="{{ public_path('uploads/editors/' . $article->editor->profile_image) }}" class="editor-image" alt="Editor">
        @endif
        <div class="editor-info">
            Editor: {{ $article->editor->first_name ?? 'Unknown' }} {{ $article->editor->last_name ?? '' }}
        </div>
    </div>
</body>
</html>
