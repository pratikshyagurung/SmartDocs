@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
      @keyframes ping-slow {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.3); opacity: 0.3; }
      }
      .animate-ping-slow {
      animation: ping-slow 2.5s ease-in-out infinite;
      }

      .feedbackshero {
          margin: 24px auto 0;
          width: calc(100% - 64px);
          max-width: 1200px;
          height: 530px;
          border-radius: 40px;
          position: relative;
          overflow: hidden;
        }

        .feedbackshero img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          border-radius: 40px;
          position: absolute;
          top: 0;
          left: 0;
          z-index: 1;
        }

        .feedbackshero::before {
          content: "";
          position: absolute;
          inset: 0;
          background: rgba(0, 0, 0, 0.5);
          border-radius: 40px;
          z-index: 2;
        }

        .feedbackshero nav {
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
    </style>

  <div class="feedbackshero">
        <img src="/images/laptop with docs.png" alt="FeedbacksHero Background">

        <!-- Navbar inside feedbackshero -->
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
            <!-- Profile Icon -->
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

<div x-data="{ open: false }" class="relative z-10">

  <div class="flex flex-col md:flex-row items-start md:items-center justify-between w-full h-full max-w-6xl mx-auto px-6 md:px-20 py-32 space-y-8 md:space-y-0">
    <!-- Left Content -->
    <div class="flex flex-col gap-6 max-w-xl">
      <h1 class="text-4xl md:text-6xl font-extrabold flex items-center gap-3">
        <span class="text-gray-400 animate-ping-slow text-6xl">|</span>
        <span class="bg-gradient-to-r from-white via-gray-300 to-gray-100 bg-clip-text text-transparent">
           Feedbacks
        </span>
      </h1>
      <p class="text-gray-300 text-base md:text-lg leading-relaxed">
        Explore what our users are saying — honest reviews, helpful suggestions, and shared experiences that help us improve and grow.
      </p>
    </div>

    <!-- Right Content + Button -->
    <div class="flex flex-col items-start gap-6 max-w-sm text-left">
      <p class="text-gray-400 text-sm md:text-base leading-relaxed">
        We’re listening. Your thoughts matter. Share your feedback or read what others have shared about their experience.
      </p>
      <button
        @click="open = true"
        class="bg-white text-black font-bold px-6 py-3 rounded-full shadow-md hover:bg-gray-200 transition duration-300 flex items-center gap-2"
      >
      Share Your Thoughts
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M7 7h10v10" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Popup Modal -->
  <div
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
    style="display: none;"
  >
  <div
  @click.away="open = false"
  class="relative w-full max-w-xl mx-4 md:mx-0 bg-black bg-opacity-80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 md:p-10 border border-white/30 transition-all text-white"
>
  <!-- Close Button -->
  <button
    @click="open = false"
    class="absolute top-4 right-4 text-gray-300 hover:text-white text-xl font-bold transition"
  >
    &times;
  </button>

  <!-- Modal Header -->
  <div class="mb-6 text-center">
    <h2 class="text-3xl font-extrabold mb-2">We’d Love Your Feedback</h2>
    <p class="text-sm text-gray-200">Help us improve by sharing your thoughts!</p>
  </div>


    <!-- Feedback Form -->
    <form method="POST" action="{{ route('user.feedback.store') }}" class="space-y-5">
        @csrf
    
        <!-- Name Field -->
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <div class="flex items-center border border-gray-300 rounded-lg bg-white px-4 py-2 focus-within:ring-2 focus-within:ring-blue-400">
                <i class="fas fa-user text-gray-400 mr-3"></i>
                <input 
                type="text" 
                name="name" 
                required 
                placeholder="{{ auth()->user()->first_name ?? 'Your Name' }}" 
                value="{{ old('name', auth()->user()->first_name . ' ' . auth()->user()->last_name) }}" 
                class="w-full outline-none bg-transparent text-gray-800" 
            />
            </div>
        </div>
    
        <!-- Email Field -->
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="flex items-center border border-gray-300 rounded-lg bg-white px-4 py-2 focus-within:ring-2 focus-within:ring-blue-400">
                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    placeholder="{{ auth()->user()->email ?? 'you@example.com' }}" 
                    value="{{ old('email', auth()->user()->email ?? '') }}" 
                    class="w-full outline-none bg-transparent text-gray-800" 
                />
            </div>
        </div>

        <!-- Role Field -->
        <div class="relative">
          <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
          <div class="flex items-center border border-gray-300 rounded-lg bg-white px-4 py-2 focus-within:ring-2 focus-within:ring-blue-400">
              <i class="fas fa-user-tag text-gray-400 mr-3"></i>
              <input 
                  type="text" 
                  name="role" 
                  required 
                  placeholder="Your Role" 
                  value="{{ old('role', 'Enthusiast') }}" 
                  class="w-full outline-none bg-transparent text-gray-800" 
              />
          </div>
      </div>
    
        <!-- Message Field -->
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <div class="flex items-start border border-gray-300 rounded-lg bg-white px-4 py-2 focus-within:ring-2 focus-within:ring-blue-400">
                <i class="fas fa-comment-alt text-gray-400 mt-1 mr-3"></i>
                <textarea 
                    name="message" 
                    rows="4" 
                    required 
                    placeholder="Write your thoughts here..." 
                    class="w-full outline-none bg-transparent text-gray-800 resize-none"
                >{{ old('message') }}</textarea>
            </div>
        </div>

    
        <!-- Submit Button -->
        <div class="pt-3 text-center">
            <button
                type="submit"
                class="w-full md:w-auto bg-white text-black font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition duration-300 shadow-md"
            >
                Submit Feedback
            </button>
        </div>
    </form>
    @if(session('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              alert("{{ session('success') }}");
          });
      </script>
    @endif



    </div>
  </div>
</div>


  </div>

  <div class="max-w-7xl mx-auto px-6 md:px-20 py-20">
      <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 text-center">What Our Users Say</h2>
      <p class="text-center text-gray-600 text-base md:text-lg mb-10">
        Honest experiences from real users who trust and use our platform every day.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-10">
        @foreach($feedbacks as $feedback)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
          <img src="{{ $feedback->user && $feedback->user->profile_image 
          ? asset('uploads/users/' . $feedback->user->profile_image) 
          : '/images/profile.png' }}" 
       alt="{{ $feedback->name }}" class="w-full h-48 object-cover">
  
            {{-- <img src="/images/laptop with icons.jpg" alt="user" class="w-full h-48 object-cover"> --}}
            <div class="p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900">{{ $feedback->name }}</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $feedback->role }}</p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $feedback->message }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

  </div>




@endsection
