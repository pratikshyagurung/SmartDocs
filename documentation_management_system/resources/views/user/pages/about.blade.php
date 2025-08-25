@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com">
    </script>

<style>
  .abouthero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: 530px;
      border-radius: 40px;
      position: relative;
      overflow: hidden;
    }

    .abouthero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 40px;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .abouthero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to left, rgba(0, 0, 0, 0.8) 40%, rgba(0, 0, 0, 0) 100%);
      border-radius: 40px;
      z-index: 2;
    }

    .abouthero nav {
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

    .white-gradient-text {
        background: linear-gradient(90deg, rgba(255,255,255,1), rgba(255,255,255,0.8), rgba(255,255,255,0.6));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
    }
    .h-60 {
    height: 22rem;
}
</style>

<div class="abouthero">
    <img src="/images/laptop with icons.jpg" alt="AboutHero Background"/>
    
    <!-- Navbar with consistent styling -->
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
    
      <div class="relative z-20 flex items-center justify-end h-full px-10 ">
        <div class="text-white text-right max-w-xl">
          <h1 class="text-4xl md:text-5xl font-extrabold mb-4 white-gradient-text">Organize| Publish| Simplify</h1>
          <p class="text-lg text-gray-300">
            A clean and intuitive way to manage articles, categories, and content workflows. Built for teams that value structure, clarity, and effortless documentation — all powered by smart roles and seamless publishing.
          </p>
        </div>
        
        
        </div>
    </div>


<!-- Start of About Highlight Section -->
<div class="max-w-7xl mx-auto px-10 py-20">
  <div class="grid md:grid-cols-2 gap-12 items-start">
    <!-- Left Side: Heading -->
    <div>
      <h2 class="text-6xl font-bold text-gray-900 leading-snug">
        We build bridges <br />
        <span class="text-gray-600">between companies and customers</span>
      </h2>
    </div>

    <div class="flex items-end h-full">
      <p class="text-gray-600 text-lg">
        We help your documents organize, manage, and share knowledge through structured documentation. Our platform empowers editors, and users for you to collaborate effectively—making information accessible, and easy to maintain.
      </p>
      
      
    </div>
  </div>

  <!-- Full-Width Image Below -->
  <div class="mt-12">
    <img src="/images/handshake.png" alt="Team working together" class="w-full h-[500px] object-cover rounded-3xl shadow-lg">
  </div>
</div>
<!-- End of About Highlight Section -->


<!-- Divider Line -->
<hr class="my-6 border-gray-300 max-w-7xl mx-auto px-10 py-6" />

<div class="max-w-7xl mx-auto px-10 ">
  <div class="grid md:grid-cols-2 gap-12 items-start">
    <!-- Left Heading -->
    <div>
      <h2 class="text-6xl font-bold text-gray-900 leading-snug">
        Together we <br /> 

        <span class="text-gray-600">are strong</span>
      </h2>
    </div>

    <!-- Right Text and Paragraphs -->
    <div class="mt-8">
      <p class="text-gray-800 font-bold mb-4">
        Our mission is to simplify how teams create, manage, and share knowledge—making information clear, organized, and accessible for everyone.
      </p>
      
      <p class="text-medium text-gray-500">
        Since 2022, we’ve focused on building a powerful, user-friendly system that supports admins, editors, and users. From structured documentation to real-time collaboration, we help teams avoid knowledge silos and keep critical content easy to find, update, and reuse.
      </p>
      
    </div>
  </div>
</div>

<!-- Testimonial + Quote Section -->
<div class="max-w-7xl mx-auto px-10 py-16">
  <div class="grid md:grid-cols-2 gap-12">
    <!-- Left: Author Info (Top-Aligned) -->
    <div class="flex flex-col items-start space-y-6">
      <div class="flex items-start space-x-4">
        <img src="/images/hero.jpg" alt="Brandon Shaw" class="w-12 h-12 rounded-full object-cover" />
        <div>
          <h4 class="font-semibold text-gray-800">Brandon Shaw</h4>
          <p class="text-sm text-gray-500">Founder & CEO</p>
        </div>
      </div>
    </div>

    <!-- Right: Quote -->
    <div>
      <p class="text-6xl md:text-6xl font-medium text-gray-900 leading-snug">
        “Our goal is to build a system that empowers teams to create, organize, and share knowledge effortlessly—making documentation accessible, and impactful for everyone.”
      </p>
      
    </div>
  </div>

  <!-- Divider Line -->
  <hr class="my-12 border-gray-300" />

</div>


<!-- Why Choose Us Section -->
<div class="bg-white px-10">
  <div class="max-w-6xl mx-auto text-center">
    <!-- Heading -->
    <h2 class="text-4xl font-bold text-[#0F2A35] mb-2">Why choose <em class="italic text-gray-500">us?</em></h2>
    <p class="text-gray-600 max-w-xl mx-auto mb-12">
      We simplify complex documentation—making it easier for teams to manage content, for editors to publish, and for users to find exactly what they need in seconds.
    </p>

<!-- Centered Image with Left/Right Content -->
  <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8 items-center">
    
    <!-- Left Content -->
    <div class="flex flex-col justify-between h-full space-y-16">
      <!-- Item 1 -->
<!-- Item 1 -->
<div class="text-center md:text-center">
  <div class="text-2xl text-[#0F2A35] mb-2">
    <i class="fas fa-book-open"></i>
  </div>
  <h4 class="font-bold text-[#0F2A35]">Organized Knowledge</h4>
  <p class="text-gray-600 text-sm">
    Every article is categorized and searchable, helping users find what they need—fast and frustration-free.
  </p>
</div>

<!-- Item 2 -->
<div class="text-center md:text-center">
  <div class="text-2xl text-[#0F2A35] mb-2">
    <i class="fas fa-edit"></i>
  </div>
  <h4 class="font-bold text-[#0F2A35]">Easy Editing</h4>
  <p class="text-gray-600 text-sm">
    Editors can create, update, and manage content with a simple, user-friendly interface tailored for speed.
  </p>
</div>

    </div>

    <!-- Center Image -->
<!-- Image with Colored Shadow Layer -->
<div class="relative flex justify-center">
  <!-- Background Shadow Layer -->
  <div class="absolute top-3 left-3 w-full max-w-sm h-80 bg-gray-200 "></div>

  <!-- Foreground Image -->
  <img src="/images/companies.png" 
       alt="Setup" 
       class="relative w-full max-w-sm h-80 object-cover " />
</div>


<!-- Right Content -->
<div class="flex flex-col justify-between h-full space-y-16">
  <!-- Item 3 -->
  <div class="text-center md:text-center">
    <div class="text-2xl text-[#0F2A35] mb-2">
      <i class="fas fa-wallet"></i>
    </div>
    <h4 class="font-bold text-[#0F2A35]">Free & Open Access</h4>
    <p class="text-gray-600 text-sm">
      Users can explore articles and docs without barriers. No logins or fees—just instant, public access to knowledge.
    </p>
  </div>

  <!-- Item 4 -->
  <div class="text-center md:text-center">
    <div class="text-2xl text-[#0F2A35] mb-2">
      <i class="fas fa-cogs"></i>
    </div>
    <h4 class="font-bold text-[#0F2A35]">Flexible Content Management</h4>
    <p class="text-gray-600 text-sm">
      From drafts to published docs, soft deletes to category filters—manage content with total control and ease.
    </p>
  </div>
</div>


  </div>


  </div>
</div>

<div class="stats-section">
  <div class="stat">
    <p>Boost In Productivity</p>
    <h3><span class="counter" data-target="75">0</span>%</h3>
    <p>Boost in productivity and<br> move closer to financial independence.</p>
  </div>
  <div class="stat">
      <p>Trusted by</p>
      <h3><span class="counter" data-target="110000">0</span>K+</h3>
      <p>Helping individuals achieve<br> financial freedom every day.</p>
    </div>
    <div class="stat">
      <p>Achieved</p>
      <h3>$<span class="counter" data-target="10000000">0</span>M+</h3>
      <p>Proven success in turning goals<br> into reality.</p>
    </div>
</div>

<!-- Team Section -->
<div class="max-w-7xl mx-auto px-10  bg-white mb-20">
  <!-- Heading -->
  <h2 class="text-5xl font-medium text-gray-900 mb-6">Meet our <br /> amazing team</h2>
  
  <!-- Divider -->
  <hr class="mb-10 border-gray-300" />

  <!-- Team Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
    
    <!-- Member 1 -->
    <div class="text-center md:text-left">
      <img src="/images/team/BS.png" alt="Brandon Shaw" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Brandon Shaw</h4>
      <p class="text-sm text-gray-500">Founder & CEO</p>
    </div>

    <!-- Member 2 -->
    <div class="text-center md:text-left">
      <img src="/images/team/FS.png" alt="Floyd Stephens" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Floyd Stephens</h4>
      <p class="text-sm text-gray-500">Chief Technology Officer</p>
    </div>

    <!-- Member 3 -->
    <div class="text-center md:text-left">
      <img src="/images/team/KC.png" alt="Kate Clark" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Kate Clark</h4>
      <p class="text-sm text-gray-500">Director of People</p>
    </div>

    <!-- Member 4 -->
    <div class="text-center md:text-left">
      <img src="/images/team/ED.png" alt="Eunice Doyle" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Eunice Doyle</h4>
      <p class="text-sm text-gray-500">Software Engineer</p>
    </div>

    <!-- Member 5 -->
    <div class="text-center md:text-left">
      <img src="/images/team/VA.png" alt="Virginia Aguilar" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Virginia Aguilar</h4>
      <p class="text-sm text-gray-500">Software Engineer</p>
    </div>

    <!-- Member 6 -->
    <div class="text-center md:text-left">
      <img src="/images/team/JG.png" alt="Jeffrey Goodwin" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Jeffrey Goodwin</h4>
      <p class="text-sm text-gray-500">Sr Manager, Content and Growth</p>
    </div>

    <!-- Member 7 -->
    <div class="text-center md:text-left">
      <img src="/images/team/BW.png" alt="Beatrice Williamson" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Beatrice Williamson</h4>
      <p class="text-sm text-gray-500">Product Designer</p>
    </div>

    <!-- Member 8 -->
    <div class="text-center md:text-left">
      <img src="/images/team/RD.png" alt="Roger Dawson" class="rounded-xl w-full object-cover h-60 mb-4" />
      <h4 class="font-semibold text-gray-900">Roger Dawson</h4>
      <p class="text-sm text-gray-500">Senior Account Executive</p>
    </div>

  </div>
</div>


@endsection
