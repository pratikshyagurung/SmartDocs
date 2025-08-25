@extends('user.inc.main')
@section('Usercontents')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>

<style>
/* =================== Global Styles =================== */
:root {
    --primary-blue: #1d4ed8;
    --primary-blue-light: #3b82f6;
    --primary-gradient: linear-gradient(135deg, #1d4ed8, #3b82f6);
    --secondary-gradient: linear-gradient(135deg, #3b82f6, #60a5fa);
    --light-bg: #f0f7ff;
    --card-bg: rgba(255, 255, 255, 0.15);
    --gold: #FFD700;
    --silver: #C0C0C0;
    --bronze: #CD7F32;
    --text-dark: #1e293b;
    --card-border: rgba(255, 255, 255, 0.2);
    --table-header: rgba(219, 234, 254, 0.5);
    --table-row-even: rgba(249, 250, 251, 0.8);
    --table-row-odd: rgba(255, 255, 255, 0.9);
}
.homehero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: auto;
      min-height: 400px;
      border-radius: 40px;
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .homehero {
      margin: 24px auto 0;
      width: calc(100% - 64px);
      max-width: 1200px;
      height: 750px;
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
    display: inline-block;
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
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 8px 16px;
      border-radius: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }
    
    .logout-btn:hover {
      background: rgba(255, 255, 255, 0.3);
    }
    
    .hero-performer-card {
        position: relative;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 3;
        width: 100%;
    }
    
    .performer-card {
        position: relative;
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--card-border);
        border-radius: 25px;
        padding: 30px;
        width: 100%;
        max-width: 600px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        color: white;
        animation: fadeInCard 1.2s ease forwards;
        z-index: 1;
        overflow: hidden;
    }
    
    .performer-card::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(29, 78, 216, 0.1));
        z-index: -1;
        filter: blur(15px);
        border-radius: 30px;
    }
    
    .crown-icon {
        font-size: 60px;
        margin: 0 auto 15px;
        color: var(--gold);
        filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
        animation: popIn 1.5s ease-out;
    }
    
    .performer-card h1 {
        font-size: 1.8rem;
        margin-bottom: 15px;
        background: linear-gradient(to right, #ffffff, #e0e7ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        letter-spacing: 1px;
    }
    
    .performer-card h2 {
        font-size: 1.5rem;
        color: white;
        margin-bottom: 20px;
        font-weight: 500;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    
    .performance-metric {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 15px;
        margin: 0 auto 20px;
        max-width: 200px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
    }
    
    .metric-value {
        font-size: 2.2rem;
        font-weight: 700;
        display: block;
        background: linear-gradient(to right, #ffffff, #e0e7ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }
    
    .metric-label {
        font-size: 0.9rem;
        color: #e0e7ff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 25px;
    }
    
    .stat-item {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 15px;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
    }
    
    .stat-value {
        font-size: 1.3rem;
        font-weight: 600;
        color: white;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #e0e7ff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .rank-badge {
        position: relative;
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2) 0%, rgba(255, 215, 0, 0.4) 100%);
        color: var(--gold);
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 1.1rem;
        border: 1px solid rgba(255, 215, 0, 0.3);
        animation: glow 2s infinite alternate;
        overflow: hidden;
        backdrop-filter: blur(5px);
    }
    
    .rank-badge::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to bottom right, transparent 45%, rgba(255, 215, 0, 0.3) 50%, transparent 55%);
        animation: shine 3s infinite;
    }
    
    .trophy-icon {
        width: 18px;
        height: 18px;
        margin-left: 8px;
        color: var(--gold);
    }
    
    .performance-dashboard {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
        margin-top: 60px;
    }
    
    /* Performance Listing Styles */
    .performance-listing {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        background-color: white;
    }
    
    .listing-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .listing-header h2 {
        font-size: 2rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-weight: 600;
        background: linear-gradient(to right, #1e40af, #1e3a8a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .listing-header p {
        color: #64748b;
        font-size: 1rem;
    }
    
    .table-container {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--card-border);
        overflow-x: auto;
    }
    
    .performance-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .performance-table thead {
        background: var(--table-header);
    }
    
    .performance-table th {
        padding: 15px;
        text-align: left;
        color: #1e293b;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .performance-table td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
    }
    
    .performance-table tbody tr:nth-child(even) {
        background: var(--table-row-even);
    }
    
    .performance-table tbody tr:nth-child(odd) {
        background: var(--table-row-odd);
    }
    
    .performance-table tbody tr:hover {
        background: rgba(219, 234, 254, 0.5);
    }
    
    .rank-cell {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
        font-weight: 600;
        color: white;
    }
    
    .rank-1 {
        background-color: var(--gold);
        box-shadow: 0 0 10px rgba(37, 99, 235, 0.3);
    }
    
    .rank-2 {
        background-color: var(--silver);
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
    }
    
    .rank-3 {
        background-color: var(--bronze);
        box-shadow: 0 0 10px rgba(96, 165, 250, 0.3);
    }
    
    .rank-other {
        background-color: #3b82f6;
        box-shadow: 0 0 10px rgba(96, 165, 250, 0.3);
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        color: white;
        background-color: #3b82f6;
    }
    
    .progress-bar {
        height: 25px;
        background: #e2e8f0;
        border-radius: 12px;
        position: relative;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 12px;
        background: var(--primary-gradient);
        position: relative;
    }
    
    .progress-bar span {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.7rem;
        font-weight: 600;
        color: white;
        text-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
    }
    
    /* Animations */
    @keyframes glow {
        from { box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); }
        to { box-shadow: 0 0 20px rgba(255, 215, 0, 0.5); }
    }
    
    @keyframes fadeInCard {
        0% { transform: translateY(40px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes popIn {
        0% { transform: scale(0); opacity: 0; }
        80% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }
    
    @keyframes shine {
        to {
            transform: translate(50%, 50%) rotate(360deg);
        }
    }
    
    @keyframes confetti {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(500px) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .homehero {
            width: calc(100% - 32px);
            min-height: 500px;
        }
        
        .homehero nav {
            padding: 15px;
        }
        
        nav .left ul {
            display: none;
        }
        
        .hero-performer-card {
            padding: 20px 10px;
        }
        
        .performer-card {
            padding: 20px;
        }
        
        .performer-card h1 {
            font-size: 1.5rem;
        }
        
        .performer-card h2 {
            font-size: 1.3rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }
        
        .performance-table th,
        .performance-table td {
            padding: 10px 8px;
            font-size: 0.8rem;
        }
        
        .avatar {
            width: 25px;
            height: 25px;
            font-size: 0.7rem;
        }
        
        .progress-bar {
            height: 20px;
        }
    }
</style>

<div class="homehero">
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="logout-btn">Log In</a>
            @endauth
        </div>
    </nav>
  
    <!-- Top Performer Card in Hero -->
    <div class="hero-performer-card">
        @if($topPerformer)
            <div class="performer-card">
                <div class="crown-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h1>Top Performer</h1>
                <h2>{{ $topPerformer->editor->first_name }} {{ $topPerformer->editor->last_name }}</h2>
                
                <div class="performance-metric">
                    <span class="metric-value">{{ number_format($topPerformer->likes_count) }}</span>
                    <span class="metric-label">Likes</span>
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value">{{ number_format($topPerformer->views_count) }}</div>
                        <div class="stat-label">Views</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $topPerformer->engagement_rate }}%</div>
                        <div class="stat-label">Engagement</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $topPerformer->performance_score }}</div>
                        <div class="stat-label">Score</div>
                    </div>
                </div>

                <div class="rank-badge">
                    <span>#1 Ranking</span>
                    <i class="fas fa-trophy trophy-icon"></i>
                </div>
            </div>
        @else
            <div class="performer-card" style="text-align:center;">
                <div class="crown-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h1>Top Performer of the Month</h1>
                <p style="margin-top:.5rem; color: #e0e7ff;">No top performer yet.</p>

                <div class="stats-grid" style="margin-top:20px;">
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Views</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Likes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">0%</div>
                        <div class="stat-label">Engagement</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="performance-dashboard">
    <!-- Performance Listing Section -->
    <div class="performance-listing">
        <div class="listing-header">
            <h2>Content Performance Rankings</h2>
            <p>Sorted by most viewed content this month</p>
        </div>
        
        <div class="table-container">
            <table class="performance-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Author</th>
                        <th>Content Title</th>
                        <th>Likes</th>
                        <th>Views</th>
                        <th>Engagement</th>
                        <th>Performance Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articlesByViews as $article)
                    <tr>
                        <td>
                            @if($loop->iteration <= 3)
                                <span class="rank-cell rank-{{ $loop->iteration }}">{{ $loop->iteration }}</span>
                            @else
                                <span class="rank-cell rank-other">{{ $loop->iteration }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="avatar" style="width:40px; height:40px; border-radius:50%; overflow:hidden; background:#f3f4f6;">
                                    @if(!empty($article->editor->profile_image) && file_exists(public_path('uploads/editors/' . $article->editor->profile_image)))
                                        <img src="{{ asset('uploads/editors/' . $article->editor->profile_image) }}" 
                                             alt="{{ $article->editor->first_name }} {{ $article->editor->last_name }}" 
                                             style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('images/profile.png') }}" 
                                             alt="Default Profile" 
                                             style="width:100%; height:100%; object-fit:cover;">
                                    @endif
                                </div>
                                
                                <span>{{ $article->editor->first_name }} {{ $article->editor->last_name }}</span>
                            </div>
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ number_format($article->likes_count) }}</td>
                        <td>{{ number_format($article->views_count) }}</td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ (float) $article->engagement_rate }}%;"></div>
                                <span>{{ (float) $article->engagement_rate }}%</span>
                            </div>
                        </td>
                        <td>{{ $article->performance_score }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center" style="color:#64748b; text-align: center; padding: 20px;">No rankings yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection