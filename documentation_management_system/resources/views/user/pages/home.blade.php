@extends('user.inc.main')
@section('Usercontents')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

<style>
  .homehero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: 530px;
      border-radius: 40px;
      position: relative;
      overflow: hidden;
    }

    .homehero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 40px;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .homehero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 40px;
      z-index: 2;
    }

    .homehero nav {
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

    

    
</style>

<div class="homehero">
  <img src="/images/hero.jpg" alt="Hero Background">
  
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
        <a href="{{ Auth::check() ? route('user.Userprofile') : route('login') }}">
          <img src="{{ $profileImage }}" alt="Profile">
        </a>
    </div>
      
    @auth
    <!-- Only show Logout when logged in -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Log Out</button>
    </form>
  @else
    <!-- Show Login button for guests -->
    <a href="{{ route('login') }}" class="logout-btn">Log In</a>
  @endauth
    </div>
  </nav>


    <!-- Hero text -->
    <div class="hero-content">
        <h1>Empowering Knowledge Through Organized <br> Documentation</h1>
        <p>
            Manage, create, and explore comprehensive articles and tutorials with ease — all in one centralized system designed to streamline your documentation process. Whether you’re an admin, editor, or user, access the knowledge you need anytime, anywhere.
          </p>
        <a href="{{ route('user.categories') }}">Explore Documentation</a>
        
    </div>
  </div>

  <div class="streamlineSection">
    <div class="text">
      <h2>Streamline Your Documentation<br>With Our Powerful Platform</h2>
      <p>Securely organize, manage, and access documents across the<br>departments. Enhance productivity, reduce clutter, and ensure your organization’s knowledge is always within reach—structured.</p>
      <a href="#">Access as Editor</a>
    </div>
    <div class="cards">
      <div class="card">
        <img src="/images/laptop with icons.jpg" alt="Efficient Management" />
        <a href="{{ route('user.all-articles') }}"><span class="label">Efficient Management</span></a>
      </div>
      <div class="card small">
        <img src="/images/laptop with docs.png" alt="Manage your documents" />
        <span class="title">Manage your documents</span>
        <div class="icon"><i class="fas fa-arrow-right"></i></div>
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


    <div class="insight-section">
        <h2>
          More Than Just <span>Documentation</span>— It’s<br> About <span>Knowledge Empowerment</span>
        </h2>
        <p>
          Smart Docs helps you structure, manage, and explore content effortlessly.
          Turn information<br> into actionable knowledge with clarity, access control, and collaboration.
        </p>
        <div class="insight-gif">
            <img src="/gif/typing.gif" alt="Knowledge Empowerment in Action">
          </div>
    </div>


    <div class="most-viewed-section">
        <div class="most-viewed-article">
          <div class="left-article-label">
            <p>/article nostalgia</p>
          </div>
          <div class="right-article-content">
            <h2>The Timeless Pull of Nostalgia: When Memories Shape the Present</h2>
 <br>
            <a href="{{ route('user.all-articles') }}" class="learn-more">
              Learn More <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
          </div>
          
        </div>
      
        <div class="article-info-image">
          <div class="left-typing-text">

                <p>
                    Ever stumbled upon an old song, a familiar scent, or a childhood photo—and felt like time stood still? That’s nostalgia. It’s not just a memory; it’s a feeling that wraps you in warmth and reminds you .... 
                </p>

          </div>
          <div class="right-article-image">
            <img src="/images/book.jpg" alt="Article related image" />
          </div>
        </div>
      
        <hr class="divider-line" />
    </div>
    
    
    <div class="why-choose-section">
        <div class="why-choose-content">
          <div class="why-left">
            <p>/why choose us</p>
            <h2>Why Teams Love Smart Docs</h2>
            <p class="description">
              We don't just store information — we shape how knowledge is accessed, shared, and transformed into growth. From startups to enterprises, our platform is trusted to streamline workflows and spark smarter collaboration.
            </p>
            <a href="{{ route('user.about') }}" class="discover-more">
              Discover Us <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
          </div>
          <div class="why-right">
            <div class="feature">
              <i class="fas fa-brain"></i>
              <div>
                <h4>AI-Powered Intelligence</h4>
                <p>Smart suggestions, automated tagging, and personalized recommendations tailored to how your team works.</p>
              </div>
            </div>
            <div class="feature">
              <i class="fas fa-users-cog"></i>
              <div>
                <h4>Collaboration Without Limits</h4>
                <p>Real-time edits, comments, and version control that makes teamwork effortless.</p>
              </div>
            </div>
            <div class="feature">
              <i class="fas fa-shield-alt"></i>
              <div>
                <h4>Enterprise-Grade Security</h4>
                <p>Granular permissions, audit logs, and role-based access keep your data safe and visible only to the right eyes.</p>
              </div>
            </div>
          </div>
        </div>
    </div>


    <div class="scroll-banner">
        <div class="scroll-fade-left"></div>
        <div class="scroll-fade-right"></div>
        <div class="scroll-text">
          <i class="fas fa-rocket"></i> Empowering Teams &nbsp;&nbsp;
          <i class="fas fa-lock"></i> Secure Documentation &nbsp;&nbsp;
          <i class="fas fa-sync-alt"></i> Real-Time Collaboration &nbsp;&nbsp;
          <i class="fas fa-chart-line"></i> Insightful Analytics &nbsp;&nbsp;
          <i class="fas fa-brain"></i> Powered by AI &nbsp;&nbsp;
          <i class="fas fa-rocket"></i> Empowering Teams &nbsp;&nbsp;
          <i class="fas fa-lock"></i> Secure Documentation &nbsp;&nbsp;
          <i class="fas fa-sync-alt"></i> Real-Time Collaboration &nbsp;&nbsp;
          <i class="fas fa-chart-line"></i> Insightful Analytics &nbsp;&nbsp;
          <i class="fas fa-brain"></i> Powered by AI
          
        </div>
    </div>
  

  <div class="pricing-plans">
    <h2>Choose the Plan That Fits Your Team</h2>
    <p>Flexible pricing tailored for teams of all sizes. Scale as you grow.</p>
    <div class="plans">
      <div class="plan">
        <h3>Basic</h3>
        <p class="price">$0 <span>/ month</span></p>
        <ul>
          <li>Up to 5 users</li>
          <li>Basic document management</li>
          <li>Category organization</li>
          <li>Email support</li>
          <li>Up to 5 users</li>
          <li>Basic document management</li>
          <li>Category organization</li>
          <li>Email support</li>
          <li>Up to 5 users</li>

        </ul>
        <a href="#" class="btn">Get Started</a>
      </div>
      <div class="plan popular">
        <h3>Pro</h3>
        <p class="price">$29 <span>/ month</span></p>
        <ul>
          <li>Up to 50 users</li>
          <li>Advanced editing tools</li>
          <li>Version control & soft deletes</li>
          <li>Priority support</li>
          <li>Up to 50 users</li>
          <li>Advanced editing tools</li>
          <li>Version control & soft deletes</li>
          <li>Priority support</li>
          <li>Version control & soft deletes</li>
        </ul>
        <a href="#" class="btn">Choose Pro</a>
      </div>
      <div class="plan">
        <h3>Enterprise</h3>
        <p class="price">Custom</p>
        <ul>
          <li>Unlimited users</li>
          <li>Custom integrations</li>
          <li>Dedicated account manager</li>
          <li>24/7 support</li>
          <li>Unlimited users</li>
          <li>Custom integrations</li>
          <li>Dedicated account manager</li>
          <li>24/7 support</li>          
          <li>Unlimited users</li>
        </ul>
        <a href="#" class="btn">Contact Sales</a>
      </div>
    </div>
  </div>


  <div class="testimonial-glass">
    <div class="testimonial-inner">
      <div class="testimonial-left">
        <h2>Hear from Our Power Users</h2>
        <p>Real stories from teams who transformed their workflow using Smart Docs. Discover how we’ve empowered productivity, clarity, and collaboration.</p>
        <div class="testimonial-dots"></div>
      </div>
      <div class="testimonial-right">
        <div class="testimonial-carousel">
          <div class="testimonial-card active">
            <p>“From chaos to clarity — Smart Docs completely changed how we handle our internal knowledge base.”</p>
            <div class="user">
              <img src="https://i.pravatar.cc/100?img=11" alt="User 1" />
              <div>
                <h4>Nabina Shrestha</h4>
                <span>Tech Lead, LogiSoft</span>
              </div>
            </div>
          </div>
          <div class="testimonial-card">
            <p>“I no longer waste time hunting for documents. Everything is beautifully organized and AI helps us find it instantly!”</p>
            <div class="user">
              <img src="https://i.pravatar.cc/100?img=22" alt="User 2" />
              <div>
                <h4>Saugat Bista</h4>
                <span>Product Designer, Nova</span>
              </div>
            </div>
          </div>
          <div class="testimonial-card">
            <p>“Collaboration across teams has never been smoother. Version control and access roles are game changers.”</p>
            <div class="user">
              <img src="https://i.pravatar.cc/100?img=36" alt="User 3" />
              <div>
                <h4>Sarita Rana</h4>
                <span>HR Manager, BluePixel</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection