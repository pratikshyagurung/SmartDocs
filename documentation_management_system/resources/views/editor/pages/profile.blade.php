@extends('editor.inc.main')

@section('contents')

<style>
  .profile-input {
      width: 100%;
      padding: 10px 12px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 6px;
  }
  
  label {
      font-weight: 500;
      font-size: 14px;
  }
  
  .submit-btn {
      background-color: #0d47a1;
      color: white;
      padding: 12px 28px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
      width: 100%;
  }
  
  .submit-btn:hover {
      background-color: #1565c0;
  }
  
  .full-width {
      grid-column: span 2;
  }
</style>

<div class="profile-edit-container" style="max-width: 76%; margin: auto; padding: 160px;">
    <h2 style="font-size: 28px; font-weight: 600; color: #0d47a1; margin-bottom: 30px;">Edit Profile</h2>
  
    {{-- Display success/error messages --}}
    @if(session('success'))
        <div style="margin-bottom:20px; color:green;">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="margin-bottom:20px; color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Image Upload --}}
    <form method="POST" action="{{ route('editor.profile.update.image') }}" enctype="multipart/form-data" style="margin-bottom: 40px;">
        @csrf
        @method('PATCH')
        <div style="display: flex; align-items: center; gap: 20px;">
            <img src="{{ $user->profile_image 
            ? asset('uploads/editors/' . $user->profile_image) 
            : asset('images/profile.png') }}"
            alt="Editor Image"
            style="width: 120px; height: 120px; object-fit: cover; border-radius: 100px;" />
        
            <div>
                <label for="uploadImage" style="display: block; margin-bottom: 8px; font-weight: 500;">Change Profile Image</label>
                <input type="file" id="uploadImage" name="profile_image" accept="image/*" onchange="this.form.submit()" style="padding: 8px;">
            </div>
        </div>
    </form>
  
    {{-- Update Info --}}
    <form method="POST" action="{{ route('editor.profile.update') }}" style="margin-bottom: 40px;">
        @csrf
        @method('PATCH')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="profile-input" required>
            </div>
            <div>
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="profile-input" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="profile-input" required>
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="profile-input">
            </div>
            <div class="form-group full-width">
                <label>Address</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}" class="profile-input">
            </div>
        </div>
  
        <button class="submit-btn" style="margin-top: 30px;">Update Profile</button>
    </form>
  
    {{-- Change Password --}}
    <h3 style="font-size: 28px; font-weight: 600; color: #0d47a1; margin-bottom: 20px;">Change Password</h3>
    <form method="POST" action="{{ route('editor.profile.update.password') }}">
        @csrf
        @method('PATCH')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label>Old Password</label>
                <input type="password" name="old_password" class="profile-input" required>
            </div>
            <div>
                <label>New Password</label>
                <input type="password" name="new_password" class="profile-input" required>
            </div>
            <div class="form-group full-width">
                <label>Confirm Password</label>
                <input type="password" name="new_password_confirmation" class="profile-input" required>
            </div>
        </div>
  
        <button class="submit-btn" style="margin-top: 30px;">Change Password</button>
    </form>
</div>
  
@endsection
