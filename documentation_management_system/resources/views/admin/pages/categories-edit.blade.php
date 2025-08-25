@extends('admin.inc.main')

@section('Admin-contents')

<style>
    .form-container {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 16px var(--card-shadow);
    }

    .form-header {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .form-header h3 {
        color: var(--primary);
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-color);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        font-size: 0.95rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(13, 71, 161, 0.2);
    }

    .editbtn-submit {
        background-color: #33507c ;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .editbtn-submit:hover {
        background-color: var(--primary);
    }

    .icon-preview {
        font-size: 1.5rem;
        margin-left: 10px;
        vertical-align: middle;
        color: var(--primary);
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }
    }
</style>

<main class="main-content">
    <div class="main-container">
        <header class="page-header">
            <h2>Edit Category</h2>
            <p>Update the category information below.</p>
        </header>

        <!-- Display Success Message -->
        @if(session('success'))
        <div style="background-color: var(--success-light); color: var(--success); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display Validation Errors -->
        @if($errors->any())
        <div style="background-color: var(--error-light); color: var(--error); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Edit Category Form -->
        <div class="form-container">
            <div class="form-header">
                <h3>Edit Category: {{ $category->name }}</h3>
            </div>
            <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" required
                           value="{{ old('name', $category->name) }}" placeholder="Enter category name">
                </div>

                <div class="form-group">
                    <label for="slug">Category Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" required
                           value="{{ old('slug', $category->slug) }}" placeholder="Enter URL-friendly slug">
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" style="width:160px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                    @else
                        <div class="placeholder-box" style="width:160px;height:120px;display:flex;align-items:center;justify-content:center;border:1px dashed #e5e7eb;border-radius:8px;background:#f9fafb;">No Image</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Replace Image (optional)</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <button type="submit" class="editbtn-submit">Update Category</button>
            </form>
        </div>
    </div>
</main>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection
