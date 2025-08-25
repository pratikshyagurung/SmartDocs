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

  /* Header */
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
    color: #0d47a1;
    border: 1px solid #333;
    padding: 10px 20px;
    border-radius: 999px;
    font-size: 14px;
    transition: 0.3s;
  }
  .header a:hover {
    background: #0d47a1;
    color: #fff;
  }

  /* Card */
  .card {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  /* GRID */
  .profile-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: start;
  }

  /* Left form fields */
  .form-group {
    margin-bottom: 16px;
  }
  label {
    font-size: 14px;
    color: #555;
    font-weight: 500;
    display: block;
    margin-bottom: 6px;
  }
  input, select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: 0.2s;
  }
  input:focus, select:focus {
    border-color: #0d47a1;
    outline: none;
  }

  /* Right profile image */
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
    position: relative;
  }
  .profile-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
  }
  .upload-btn {
    margin-top: 12px;
    font-size: 13px;
    color: #0d47a1;
    cursor: pointer;
  }

  /* Bottom buttons */
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
    <h2>✏ Edit User</h2>
    <p>Update user details and profile image</p>
    <a href="{{ route('admin.users') }}"> <i class="fas fa-arrow-left me-2"></i> Back to List </a>
  </div>

  <!-- Edit Card -->
  <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="profile-grid">

        <!-- Left Form Fields -->
        <div>
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}">
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">
          </div>

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
          </div>


        </div>

        <!-- Right Profile Image -->
        <div class="profile-image">
          <div class="profile-img-wrapper">
            <img src="{{ asset('uploads/users/' . $user->profile_image) }}" alt="User" class="profile-img">
          </div>

        </div>

      </div>
    </div>

    <!-- Actions -->
    <div class="actions">
      <button type="submit" class="btn-gradient">💾 Save Changes</button>
      <a href="{{ route('admin.users') }}" class="btn-outline-danger">✖ Cancel</a>
    </div>
  </form>

</div>
@endsection
