@extends('admin.inc.main')

@section('Admin-contents')

<style>
    /* Form Styles */
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

    .btn-submit {
        background-color: var(--primary);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-submit:hover {
        background-color: var(--primary-dark);
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        box-shadow: 0 8px 16px var(--card-shadow);
        border-radius: 12px;
        background: var(--card-bg);
        margin-bottom: 50px;
    }

    /* base table layout */
.categories-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0;
  background:#fff;
  border-radius:14px;
  overflow:hidden;
}
.categories-table thead th{
  background:#0b4db7;            /* your blue */
  color:#fff;
  text-align:left;
  font-weight:600;
  padding:14px 16px;
  white-space:nowrap;
}
.categories-table tbody td{
  padding:14px 16px;
  border-top:1px solid #eef2f7;
  vertical-align:middle;          /* center things vertically */
  color:#111827;
  font-size:14px;
}

/* column sizing (adjust as needed) */
.categories-table .col-id{width:64px;}
.categories-table .col-name{width:20%;}
.categories-table .col-slug{width:18%;}
.categories-table .col-image{width:220px;}
.categories-table .col-created{width:140px;}
.categories-table .col-actions{width:220px;}
.categories-table .actions-cell{white-space:nowrap;}

/* consistent image thumbnails */
.image-cell{padding-top:10px; padding-bottom:10px;}
.table-image,
.placeholder-box{
  width: 180px;          /* thumbnail width */
  height: 120px;         /* thumbnail height */
  border-radius: 10px;
  display:block;
  box-shadow: 0 4px 12px rgba(17,24,39,.06);
  border: 1px solid #edf2f7;
}
.table-image{
  object-fit: cover;     /* crop to fill box (keeps layout consistent) */
}

/* placeholder when no image */
.placeholder-box{
  background: #f3f4f6;
  color:#6b7280;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:13px;
  font-weight:600;
  text-transform:uppercase;
  letter-spacing:.04em;
}

/* responsive: collapse some columns on narrow screens */
@media (max-width: 900px){
  .categories-table .col-slug,
  .categories-table .col-created{display:none;}
  .categories-table tbody td:nth-child(3),
  .categories-table tbody td:nth-child(5){display:none;}
  .table-image, .placeholder-box{width:140px; height:94px;}
  .categories-table .col-image{width:160px;}
}


    /* Buttons */
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;

    }

    .btn-view {
        background-color: rgba(13, 71, 161, 0.1);
        color: var(--primary);
    }

    .btn-view:hover {
        background-color: rgba(13, 71, 161, 0.2);
    }

    .btn-edit {
        background-color: rgba(46, 125, 50, 0.1);
        color: var(--success);
    }

    .btn-edit:hover {
        background-color: rgba(46, 125, 50, 0.2);
    }

    .btn-delete {
        background-color: rgba(198, 40, 40, 0.1);
        color: var(--error);
    }

    .btn-delete:hover {
        background-color: rgba(198, 40, 40, 0.2);
    }

    .btn-icon {
        width: 16px;
        height: 16px;
    }

    /* Category Icon Preview */
    .icon-preview {
        font-size: 1.5rem;
        margin-left: 10px;
        vertical-align: middle;
        color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }
        
        #categoriesTable th, #categoriesTable td {
            padding: 12px 15px;
        }
    }
</style>

<main class="main-content">
    <div class="main-container">
        <header class="page-header">
            <h2>Categories Management</h2>
            <p>Create and manage content categories for your articles.</p>
        </header>

        <!-- Display Success Message -->
        @if(session('success'))
        <div style="background-color: var(--success-light); color: var(--success); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display Error Message -->
        @if($errors->any())
        <div style="background-color: var(--error-light); color: var(--error); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Category Creation Form -->
        <div class="form-container">
            <div class="form-header">
                <h3>Create New Category</h3>
            </div>
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" required 
                           value="{{ old('name') }}" placeholder="Enter category name">
                </div>

                <div class="form-group">
                    <label for="slug">Category Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" required 
                           value="{{ old('slug') }}" placeholder="Enter URL-friendly slug">
                </div>

                <div class="form-group">
                    <label for="image">Category Image </label>
                    <input id="image" name="image" type="file" accept="image/*" class="form-control">
                    <small style="color:#6b7280;">Recommended: 600×400px, up to 2MB (jpg/png/webp)</small>
                </div>

                <button type="submit" class="btn-submit">Create Category</button>
            </form>
        </div>

<!-- Categories Table -->
<div class="table-container">
    <table id="categoriesTable" class="categories-table">
      <thead>
        <tr>
          <th class="col-id">ID</th>
          <th class="col-name">Name</th>
          <th class="col-slug">Slug</th>
          <th class="col-image">Image</th>
          <th class="col-created">Created At</th>
          <th class="col-actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ $category->slug }}</td>
          <td class="image-cell">
            @if($category->image)
              <img
                src="{{ asset('storage/'.$category->image) }}"
                class="table-image"
                alt="{{ $category->name }}"
                loading="lazy">
            @else
              <div class="placeholder-box">No Img</div>
            @endif
          </td>
          <td>{{ $category->created_at->format('Y-m-d') }}</td>
          <td class="actions-cell">
            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-view">View</a>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit">Edit</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center;padding:30px;">No categories found. Create your first category above.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  
    </div>
</main>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection