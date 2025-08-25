@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

<style>
  .profilehero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: 530px;
      border-radius: 40px;
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #0f2a35 0%, #19323ce8 100%);

    }

    .profilehero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 40px;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }



    .profilehero nav {
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

    .profile-icon a {
    display: inline-block; /* Make the link match the image size */
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

    
/* User Profile Content */
.profile-content {
  display: flex;
  height: calc(100% - 80px);
  padding: 0 90px;
  align-items: center;
  color: white;
  justify-content: space-between; 
}




    .user-details {
      flex: 1;
      padding-right: 40px;
      margin: 20px;

    }

    .user-details h1 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .detail-item {
      margin-bottom: 15px;
    }

    .detail-label {
      font-size: 14px;
      color: #aaa;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 5px;
    }

    .detail-value {
      font-size: 18px;
      font-weight: 500;
    }

    .user-image {
  flex: 1;
  display: flex;
  justify-content: flex-end; 
  align-items: center;
  margin-top: 160px;

}

    .user-image img {
      width: 300px;
      height: 300px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      margin-left: 800px;
      margin-top: 160px;
    }

    .profiletab-content {
        text-align: center;
        margin: 0px 246px;
        margin-bottom: 40px;
    }

    .profileform-row {
        display: flex;
        justify-content: space-between;
        gap: 40px;
    }

    .profileform-group {
        flex: 1;
        margin-bottom: 20px;
        text-align: left;
    }

    .profileform-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    .profileform-group input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .submit-btn {
        background-color: #213943;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background-color: #1e3e4b;
    }

    .profileform-group.full-width {
        width: 100%;
    }
    
</style>


<div class="profilehero">
    
    <!-- Navbar inside hero -->
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
  
    <!-- Profile Content -->
<div class="profile-content">
    <div class="user-details">
        <h1>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
        
        <div class="detail-item">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ auth()->user()->email }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Phone</div>
            <div class="detail-value">{{ auth()->user()->phone ?? 'N/A' }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Joined</div>
            <div class="detail-value">{{ auth()->user()->created_at->format('d M Y') }}</div>
        </div>
        
        <div class="detail-item">
            <div class="detail-label">Address</div>
            <div class="detail-value">{{ auth()->user()->address ?? 'N/A' }}</div>
        </div>
    </div>
    
    <div class="user-image">
        <img src="{{ auth()->user()->profile_image ? asset('uploads/users/' . auth()->user()->profile_image) : '/images/profile.png' }}" 
             alt="User Image" style="width: 200px; height: 200px; object-fit: cover; border-radius: 100px;">

        {{-- Change Profile Image --}}
        <form method="POST" action="{{ route('user.profile.update.image') }}" enctype="multipart/form-data" style="margin-top: 15px;">
          @csrf
          @method('PATCH')
          <label for="uploadImage" style="display: block; margin-bottom: 8px; font-weight: 500; cursor: pointer;">Change Profile Image</label>
          <input type="file" id="uploadImage" name="profile_image" accept="image/*" onchange="this.form.submit()" style="padding: 8px;">
        </form>
          
        @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
        @endif
        
    </div>
</div>

  


</div>

<div class="profiletab-content active" id="edit" style="margin-top: 60px;">
    <h2 style="margin-top: 40px;">Edit Profile</h2>
    <p style="margin-bottom: 20px; color: #666;">Please fill in this form to edit an account</p>

    <form method="POST" action="{{ route('user.profile.update') }}">
      @csrf
      @method('PATCH')
  
      <div class="profileform-row">
          <div class="profileform-group">
              <label for="email">Email</label>
              <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required />
          </div>
          <div class="profileform-group">
              <label for="full_name">Full Name</label>
              <input type="text" name="full_name" id="full_name" class="profileform-control"
                     value="{{ old('full_name', auth()->user()->first_name . ' ' . auth()->user()->last_name) }}" required />
          </div>
      </div>
  
      <div class="profileform-row">
          <div class="profileform-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required />
          </div>
          <div class="profileform-group">
              <label for="address">Address</label>
              <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}" required />
          </div>
      </div>
  
      <button class="submit-btn" type="submit">Update</button>
  </form>
  

    <h3 style="margin-top: 40px;">Change Password</h3>
    <p style="margin-bottom: 20px; color: #666;">Update your password for better security</p>

    <form method="POST" action="{{ route('user.profile.password') }}">
      @csrf
      @method('PATCH')
  
      <div class="profileform-group full-width">
          <label>Old Password</label>
          <input type="password" name="old_password" required />
      </div>
  
      <div class="profileform-row">
          <div class="profileform-group">
              <label>New Password</label>
              <input type="password" name="new_password" required />
          </div>
          <div class="profileform-group">
              <label>Confirm Password</label>
              <input type="password" name="new_password_confirmation" required />
          </div>
      </div>
  
      <button class="submit-btn" type="submit">Change Password</button>
  </form>
  
</div>

@endsection