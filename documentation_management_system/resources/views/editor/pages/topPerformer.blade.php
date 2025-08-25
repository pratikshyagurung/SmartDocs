@extends('editor.inc.main')

@section('contents')


<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        --secondary-gradient: linear-gradient(to right, #1e3a8a, #1e40af, #1d4ed8);
        --gold: #2563eb;
        --silver: #3b82f6;
        --bronze: #60a5fa;
        --text-light: #f8fafc;
        --text-dark: #1e293b;
        --card-bg: rgba(255, 255, 255, 0.9);
        --card-border: rgba(203, 213, 225, 0.5);
        --table-header: rgba(241, 245, 249, 0.8);
        --table-row-even: rgba(241, 245, 249, 0.5);
        --table-row-odd: rgba(255, 255, 255, 0.9);
    }
    
    .performance-dashboard {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
        margin-top: 60px;
    }
    
    /* Top Performer Styles */
    .top-performer-container {
        min-height: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: var(--secondary-gradient);
        padding: 50px 20px;
        position: relative;
        overflow: hidden;
    }
    
    .top-performer-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
        background-size: 50px 50px;
        opacity: 0.3;
    }
    
    .performer-card {
        position: relative;
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--card-border);
        border-radius: 25px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        color: var(--text-dark);
        animation: fadeInCard 1.2s ease forwards;
        z-index: 1;
        overflow: hidden;
    }
    
    .crown-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        color: var(--gold);
        filter: drop-shadow(0 0 10px rgba(37, 99, 235, 0.3));
        animation: popIn 1.5s ease-out;
    }
    
    .performer-card h1 {
        font-size: 2rem;
        margin-bottom: 15px;
        background: linear-gradient(to right, #2563eb, #1e40af);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        letter-spacing: 1px;
    }
    
    .performer-card h2 {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .performance-metric {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 20px;
        padding: 15px;
        margin: 0 auto 25px;
        max-width: 200px;
        border: 1px solid rgba(30, 58, 138, 0.1);
    }
    
    .metric-value {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        background: linear-gradient(to right, #2563eb, #1e40af);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }
    
    .metric-label {
        font-size: 0.9rem;
        color: #334155;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .stat-item {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 15px;
        border: 1px solid rgba(30, 58, 138, 0.1);
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .rank-badge {
        position: relative;
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(37, 99, 235, 0.4) 100%);
        color: var(--gold);
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 1.2rem;
        border: 1px solid rgba(37, 99, 235, 0.3);
        animation: glow 2s infinite alternate;
        overflow: hidden;
    }
    
    .rank-badge::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to bottom right, transparent 45%, rgba(37, 99, 235, 0.3) 50%, transparent 55%);
        animation: shine 3s infinite;
    }
    
    .trophy-icon {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        color: var(--gold);
    }
    
    .confetti {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        overflow: hidden;
    }
    
    .confetti::before,
    .confetti::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: var(--gold);
        opacity: 0;
        animation: confetti 5s infinite;
    }
    
    .confetti::before {
        top: 10%;
        left: 20%;
        animation-delay: 0.5s;
    }
    
    .confetti::after {
        top: 15%;
        right: 25%;
        animation-delay: 1.5s;
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
        /* color: #1e293b; */
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
        from { box-shadow: 0 0 10px rgba(37, 99, 235, 0.3); }
        to { box-shadow: 0 0 20px rgba(37, 99, 235, 0.5); }
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
        .performer-card {
            padding: 25px;
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
    
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
    }
    
    .pagination-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #334155;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .pagination-btn:hover:not(:disabled) {
        background: #f1f5f9;
        border-color: #94a3b8;
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    
    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8fafc;
    }
    
    .pagination-btn svg {
        width: 14px;
        height: 14px;
    }
    
    .page-numbers {
        display: flex;
        gap: 5px;
    }
    
    .page-number {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        color: #334155;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .page-number:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    
    .page-number.active {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }
    
    .ellipsis {
        display: flex;
        align-items: center;
        padding: 0 10px;
        color: #94a3b8;
    }
    
    @media (max-width: 768px) {
        .pagination {
            gap: 5px;
        }
        
        .pagination-btn {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
        
        .page-number {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
    }
</style>

<div class="performance-dashboard">

    <!-- Top Performer Section -->
    @if($topPerformer)
<!-- Top Performer Section -->
<div class="top-performer-container">
    @if($topPerformer)
        <div class="performer-card">
            <div class="crown-icon"><!-- SVG crown here --></div>
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

            <div class="rank-badge"><span>#1</span><!-- Trophy SVG --></div>
        </div>
    @else
        <div class="performer-card" style="text-align:center;">
            <div class="crown-icon"><!-- SVG crown here --></div>
            <h1>Top Performer of the Month</h1>
            <p class="text-muted" style="margin-top:.5rem;">No top performer yet.</p>

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

    @endif

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
                            <td><span class="rank-cell rank-{{ $loop->iteration }}">{{ $loop->iteration }}</span></td>
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
                            <td colspan="7" class="text-center" style="color:#64748b;">No rankings yet.</td>
                        </tr>
                        @endforelse
                        </tbody>
                
            </table>
        </div>
    </div>
</div>


@endsection