@extends('admin.inc.main')
@section('Admin-contents')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<style>
    .status {
        padding: 4px 10px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
    }

    .status-approved {
        color: #0d6efd;   /* blue */
    }

    .status-pending {
        color: #ffc107;   /* yellow */
    }

    .status-rejected {
        color: #dc3545;   /* red */
    }

    .status-published {
        color: #198754;   /* green */
    }
    
    .chart-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 20px;
    }
    .chart-box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .chart-box canvas {
        width: 100% !important;
        height: 300px !important;
    }
</style>

<main class="main-content">
  <div class="main-container">

    
    <header class="page-header">
        <p>Admin dashboard overview and global activity</p>
    </header>

    <section class="cards">
        <div class="card">
            <div class="icon-container">
                <i class="fa fa-file-alt"></i>
            </div>
            <div class="number">{{ $totalArticles }}</div>
            <div class="label">Articles</div>
        </div>
    
        <div class="card">
            <div class="icon-container">
                <i class="fa fa-users"></i>
            </div>
            <div class="number">{{ $totalCombined }}</div>
            <div class="label">Users</div>
        </div>
    
        <div class="card">
            <div class="icon-container">
                <i class="fa fa-user-edit"></i>
            </div>
            <div class="number">{{ $activeEditors }}</div>
            <div class="label">Active Editors</div>
        </div>
    
        <div class="card">
            <div class="icon-container">
                <i class="fa fa-user-check"></i>
            </div>
            <div class="number">{{ $activeUsers }}</div>
            <div class="label">Active Users</div>
        </div>
    </section>
    
    <div class="card p-4 mb-4">
        <h5>📊 Article Engagement</h5>
        <div class="chart-container">
            <div class="chart-box">
                <canvas id="articlePie"></canvas>
            </div>
            <div class="chart-box">
                <canvas id="articleBar"></canvas>
            </div>
        </div>
    </div>

    <!-- Article Growth Chart -->
    <div class="card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
            <h5 style="margin: 0;">📈 Article Growth</h5>
            <form id="chartFilterForm" action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <select name="time_range" class="form-select" style="width: auto; height: 36px;" onchange="this.form.submit()">
                    <option value="3" {{ request('time_range', '6') == '3' ? 'selected' : '' }}>Last 3 Months</option>
                    <option value="6" {{ request('time_range', '6') == '6' ? 'selected' : '' }}>Last 6 Months</option>
                    <option value="12" {{ request('time_range', '6') == '12' ? 'selected' : '' }}>Last 12 Months</option>
                    <option value="ytd" {{ request('time_range', '6') == 'ytd' ? 'selected' : '' }}>Year to Date</option>
                </select>
            </form>
        </div>
        <canvas id="articleChart"></canvas>
    </div>

    <!-- Recent Articles -->
    <section>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>Editor</th>
                        <th>Published On</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentArticles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category->name ?? 'N/A' }}</td>
                        <td>
                            {{ $article->editor ? $article->editor->first_name . ' ' . $article->editor->last_name : 'N/A' }}
                        </td>                        <td>{{ $article->created_at->format('Y-m-d') }}</td>
                        <td>
                            <span class="status 
                                {{ $article->status == 'approved' ? 'status-approved' : 
                                ($article->status == 'pending' ? 'status-pending' : 
                                ($article->status == 'rejected' ? 'status-rejected' : 
                                ($article->status == 'published' ? 'status-published' : ''))) }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $recentArticles->links() }}
            </div>
            
        </div>
    </section>

    <!-- Comments Section -->
    <div class="table-container card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <h5 style="margin: 0;">💬 All User Comments & Replies</h5>
            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control" style="height:36px; width: auto;">
                <button type="submit" class="btn btn-primary" style="height:36px; white-space: nowrap;">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Replies</th>
                    <th>Commented On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userComments as $comment)
                    <tr>
                        <td>{{ $comment->article->title ?? 'N/A' }}</td>
                        <td>
                            @if($comment->user)
                                {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                            @else
                                N/A
                            @endif
                        </td>
                                                <td>{{ $comment->comment }}</td>
                        <td>
                            @if($comment->replies->count())
                                <ul style="padding-left: 1rem; margin: 0;">
                                    @foreach($comment->replies as $reply)
                                        <li>{{ $reply->comment }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span style="color: #888;">—</span>
                            @endif
                        </td>
                        <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;">No comments or replies yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination mt-3">
            {{ $userComments->links() }}
        </div>
    </div>

    <!-- Feedbacks Section -->
    <div class="table-container card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <h5 style="margin: 0;">📝 Feedbacks</h5>
            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="feedback_date" value="{{ request('feedback_date') }}" class="form-control" style="height:36px; width: auto;">
                <button type="submit" class="btn btn-primary" style="height:36px; white-space: nowrap;">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Feedback</th>
                    <th>Submitted On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                    <tr>
                        <td>
                            @if($feedback->user)
                                {{ $feedback->user->first_name . ' ' . $feedback->user->last_name }}
                            @else
                                {{ $feedback->name ?? 'N/A' }}
                            @endif
                        </td>
                        
                                                <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;">No feedbacks yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination mt-3">
            {{ $feedbacks->links() }}
        </div>
    </div>
    
    <!-- Users Section -->
    <div class="table-container card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <h5 style="margin: 0;">👥 All Users</h5>
            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="user_date" value="{{ request('user_date') }}" class="form-control" style="height:36px; width:auto;">
                <button type="submit" class="btn btn-primary" style="height:36px; white-space: nowrap;">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination mt-3">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Editors Section -->
    <div class="table-container card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <h5 style="margin: 0;">✍️ All Editors</h5>
            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="editor_date" value="{{ request('editor_date') }}" class="form-control" style="height:36px; width:auto;">
                <button type="submit" class="btn btn-primary" style="height:36px; white-space: nowrap;">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Articles Assigned</th>
                    <th>Joined On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($editors as $editor)
                    <tr>
                        <td>{{ $editor->first_name . ' ' . $editor->last_name }}</td>
                        <td>{{ $editor->email }}</td>
                        <td>{{ $editor->articles->count() }}</td>
                        <td>{{ $editor->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No editors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination mt-3">
            {{ $editors->links() }}
        </div>
    </div>


  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('articleChart').getContext('2d'); const articleChart = new Chart(ctx, { type: 'line', data: { labels: @json($labels), datasets: [{ label: 'Articles Published', data: @json($data), fill: true, borderColor: '#4F46E5', backgroundColor: 'rgba(79,70,229,0.1)', tension: 0.3, borderWidth: 2, pointBackgroundColor: '#4F46E5' }] }, options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } } });
    document.addEventListener("DOMContentLoaded", function() {
        const labels = @json($articleLabels);
        const comments = @json($articleComments);
        const likes = @json($articleLikes);
        const views = @json($articleViews);
    
        // Pie Chart: total engagement per article
        new Chart(document.getElementById("articlePie"), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Engagement',
                    data: comments.map((c,i) => c + likes[i] + views[i]),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 15, padding: 15 } } },
                animation: { duration: 1200, easing: 'easeOutQuart' }
            }
        });
    
        // Bar Chart: show comments, likes, views separately
        new Chart(document.getElementById("articleBar"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { label: 'Comments', data: comments, backgroundColor: '#4e73df' },
                    { label: 'Likes', data: likes, backgroundColor: '#1cc88a' },
                    { label: 'Views', data: views, backgroundColor: '#36b9cc' }
                ]
            },
            options: {
                responsive: true,
                animation: { duration: 1500, easing: 'easeOutBounce' },
                scales: { y: { beginAtZero: true } }
            }
        });
    });
</script>



@endsection
