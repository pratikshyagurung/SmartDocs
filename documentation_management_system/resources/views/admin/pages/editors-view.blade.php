@extends('admin.inc.main')

@section('Admin-contents')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
  .container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 20px;
    margin-top: 60px;
  }
  .header {
    text-align: center;
    margin-bottom: 40px;
  }
  .header h2 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
  }
  .header p {
    margin: 8px 0 16px;
    color: #777;
    font-size: 14px;
  }
  .header a {
    text-decoration: none;
    color: #333;
    border: 1px solid #0d47a1;
    padding: 10px 20px;
    border-radius: 999px;
    font-size: 14px;
    transition: 0.3s;
  }
  .header a:hover {
    background: #0d47a1;
    color: #fff;
  }

  .card {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  .profile-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: center;
  }

  .profile-details .info-box {
    background: #fafbfc;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }
  .profile-details h6 {
    margin: 0 0 4px;
    font-size: 14px;
    color: #666;
  }
  .profile-details p {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
  }

  .profile-image {
    text-align: center;
  }
  .profile-img-wrapper {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0d47a1, #9c95cd);
    padding: 5px;
    margin: 0 auto;
  }
  .profile-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
  }
  .profile-image h3 {
    margin: 15px 0 8px;
    font-size: 20px;
    font-weight: 600;
  }
  .profile-image .badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    padding: 6px 14px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 400;
  }

  .actions {
    margin-top: 40px;
    text-align: center;
  }
  .actions button, .actions a {
    display: inline-block;
    margin: 0 10px;
    padding: 10px 24px;
    border-radius: 999px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
  }
  .btn-gradient {
    background: linear-gradient(135deg, #0d47a1, #9c95cd);
    color: #fff;
    text-decoration: none;
  }
  .btn-gradient:hover {
    opacity: 0.9;
  }
  .btn-outline-danger {
    background: #dbddea;
    color: #e63946;
  }
  .btn-outline-danger:hover {
    background: #e63946;
    color: #fff;
  }
</style>

<div class="container">

  <!-- Header -->
  <div class="header">
    <h2>✍️ Editor Profile</h2>
    <p>Details and actions for this editor</p>
    <a href="{{ route('admin.editors') }}" class="btn btn-outline-secondary rounded-pill">
      <i class="fas fa-arrow-left me-2"></i> Back to Editors
  </a>
  
  </div>

  <!-- Profile Card -->
  <div class="card">
    <div class="profile-grid">

      <!-- Left -->
      <div class="profile-details">
        <div class="info-box">
          <h6><i class="fas fa-envelope me-2"></i>Email</h6> 
          <p>{{ $editor->email }}</p>
        </div>
        <div class="info-box">
          <h6><i class="fas fa-phone me-2"></i>Phone</h6> 
          <p>{{ $editor->phone ?? 'Not provided' }}</p>
        </div>
        <div class="info-box">
          <h6><i class="fas fa-calendar-alt me-2"></i>Joined On</h6> 
          <p>{{ $editor->created_at->format('F j, Y') }}</p>
        </div>
        <div class="info-box">
          <h6><i class="fas fa-clock me-2"></i>Last Updated</h6> 
          <p>{{ $editor->updated_at->diffForHumans() }}</p>
        </div>
      </div>

      <!-- Right -->
      <div class="profile-image">
        <div class="profile-img-wrapper">
          <img src="{{ asset('uploads/editors/' . $editor->profile_image) }}" alt="Editor" class="profile-img">
        </div>
        <h3>{{ $editor->first_name }} {{ $editor->last_name }}</h3> 
        <span class="badge"> Editor since {{ $editor->created_at->format('M Y') }} </span>
      </div>

    </div>
  </div>

  <!-- Actions -->
  <div class="actions">
    <a href="{{ route('admin.editor.edit', $editor->id) }}" class="btn-gradient">✏ Edit Profile</a>
    
    <form action="{{ route('admin.editor.delete', $editor->id) }}" method="POST" 
      style="display:inline;"
      onsubmit="return confirm('Are you sure you want to delete this editor?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-outline-danger">🗑 Delete</button>
</form>

  </div>

</div>
@endsection
