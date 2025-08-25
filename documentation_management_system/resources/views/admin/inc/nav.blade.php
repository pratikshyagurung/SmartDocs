<div class="nav-container">
    
    <div class="logo">
      <a href="{{ route('admin.dashboard') }}">
        <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        SmartDocs
      </a>
    </div>

    <div class="nav-center">
        <div class="nav-links">
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              Dashboard
          </a>
          {{-- <a href="{{ route('admin.report') }}" class="{{ request()->routeIs('admin.report') ? 'active' : '' }}">
              Reports
          </a> --}}

          <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
              Categories
          </a>
          <a href="{{ route('admin.TopPerformers') }}" class="{{ request()->routeIs('admin.TopPerformers') ? 'active' : '' }}">
            Top Performer
          </a>
          <a href="{{ route('admin.feedbacks') }}" class="{{ request()->routeIs('admin.feedbacks') ? 'active' : '' }}">
            Feedbacks
        </a>
          <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            Users
          </a>
          <a href="{{ route('admin.editors') }}" class="{{ request()->routeIs('admin.editors') ? 'active' : '' }}">
            Editors
          </a>
          
        </div>
    </div>
    
    <div class="nav-right">

      <div class="profile">
        <a href="" class="profile-info">
          <span class="profile-name">Admin</span>
          <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile">
        </a>

        <div class="logout-menu">
          @auth
          <form method="POST" action="{{ route('admin.logout') }}">
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
