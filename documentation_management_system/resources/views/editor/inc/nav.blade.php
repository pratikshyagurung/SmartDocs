  <div class="nav-container">
    
      <div class="logo">
        <a href="{{ route('editor.dashboard') }}">
          <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          SmartDocs
        </a>
      </div>

      <div class="nav-center">
          <div class="nav-links">
            <a href="{{ route('editor.dashboard') }}" class="{{ request()->routeIs('editor.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            {{-- <a href="{{ route('editor.reports') }}" class="{{ request()->routeIs('editor.report') ? 'active' : '' }}">
                Reports
            </a> --}}
            <a href="{{ route('editor.categories') }}" class="{{ request()->routeIs('editor.categories') ? 'active' : '' }}">
              Categories
            </a>
            <a href="{{ route('editor.myPosts') }}" class="{{ request()->routeIs('editor.myPosts') ? 'active' : '' }}">
              My Posts
            </a>
            <a href="{{ route('editor.topPerformer') }}" class="{{ request()->routeIs('editor.topPerformer') ? 'active' : '' }}">
              Top Performer
            </a>
          </div>
      </div>
      
      <div class="nav-right">

        <div class="profile">
          <a href="{{ route('editor.profile') }}" class="profile-info">
            <span class="profile-name">{{ auth()->guard('editor')->user()->first_name }}</span>
            <img src="{{ auth()->guard('editor')->user()->profile_image 
            ? asset('uploads/editors/' . auth()->guard('editor')->user()->profile_image) 
            : asset('images/profile.png') }}" 
            alt="Profile">
                  </a>

          <div class="logout-menu">
            @auth
            <form method="POST" action="{{ route('editor.logout') }}">
              @csrf
              <button class="logout-btn">Logout</button>
            </form>  
            @endauth
          </div>
        </div>
        
          <div class="toggle-switch">
            <input type="checkbox" id="theme-toggle">
            <label for="theme-toggle" class="slider"></label>
        </div>
      </div>
  </div>
</nav>
