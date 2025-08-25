@extends('editor.inc.main')
@section('contents')

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
    color: #198754;   /* bootstrap success green */
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
        <p>Your article overview and recent activity</p>
    </header>
      
      @php $hasCategories = isset($categoriesWithCounts) && $categoriesWithCounts->count() > 0; @endphp
      @if(! $hasCategories)
        <div class="mb-3 text-sm text-gray-500">No categories yet.</div>
      @endif
      
      <section class="cards">
        @forelse($categoriesWithCounts as $category)
          <div class="card">
            <div class="icon-container"><i class="fa fa-file-alt"></i></div>
            <div class="number">{{ $category->articles_count }}</div>
            <div class="label">{{ $category->name }}</div>
          </div>
        @empty
          <div class="card" style="opacity:.6">
            <div class="icon-container"><i class="fa fa-folder-open"></i></div>
            <div class="number">0</div>
            <div class="label">No categories</div>
          </div>
        @endforelse
      
        {{-- Active users card always shows --}}
        <div class="card">
          <div class="icon-container"><i class="fa fa-users"></i></div>
          <div class="number">{{ $activeUsers }}</div>
          <div class="label">Active Users</div>
        </div>
      </section>
      

    @php
      $hasEngagement = !empty($articleLabels ?? []) && collect($articleComments ?? [])->sum() + collect($articleLikes ?? [])->sum() + collect($articleViews ?? [])->sum() > 0;
    @endphp
    
    <div class="card p-4 mb-4">
      <div class="flex items-center justify-between">
        <h5>📊 Your Article Engagement</h5>
      </div>
    
      @unless($hasEngagement)
        <div class="text-sm text-gray-500 mb-3">No engagement data yet.</div>
      @endunless
    
      <div class="chart-container">
        <div class="chart-box">
          <canvas id="articlePie"></canvas>
        </div>
        <div class="chart-box">
          <canvas id="articleBar"></canvas>
        </div>
      </div>
    </div>
    
    
    @php
        $hasGrowth = !empty($labels ?? []) && collect($data ?? [])->sum() > 0;
    @endphp
  
  <div class="card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
    <div style="display:grid; grid-template-columns:1fr auto; align-items:center; gap:1rem; margin-bottom:1.5rem;">
      <h5 style="margin:0;">📈 Article Growth</h5>
      <form id="chartFilterForm" action="{{ route('editor.dashboard') }}" method="GET" style="display:flex; gap:.5rem; align-items:center;">
        <select name="time_range" class="form-select" style="width:auto; height:36px;" onchange="this.form.submit()">
          <option value="3"  {{ request('time_range','6')=='3'  ? 'selected' : '' }}>Last 3 Months</option>
          <option value="6"  {{ request('time_range','6')=='6'  ? 'selected' : '' }}>Last 6 Months</option>
          <option value="12" {{ request('time_range','6')=='12' ? 'selected' : '' }}>Last 12 Months</option>
          <option value="ytd"{{ request('time_range','6')=='ytd'? 'selected' : '' }}>Year to Date</option>
        </select>
      </form>
    </div>
  
    @unless($hasGrowth)
      <div class="text-sm text-gray-500 mb-2">No growth data yet.</div>
    @endunless
  
    <canvas id="articleChart"></canvas>
  </div>
  
    

    <section>


        <div class="table-container">
            <table>
                <thead>
                  <tr>
                    <th>Article Title</th>
                    <th>Category</th>
                    <th>Published On</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentArticles as $article)
                    <tr>
                      <td>{{ $article->title }}</td>
                      <td>{{ $article->category->name ?? 'N/A' }}</td>
                      <td>{{ $article->created_at->format('Y-m-d') }}</td>
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
                  @empty
                    <tr>
                      <td colspan="4" class="text-center text-gray-500">No articles yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
              
              <div class="pagination">
                {{ $recentArticles->links() }}
              </div>
              
        </div>

    </section>

    <div class="table-container card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <h5 style="margin: 0;">💬 Your Comments & Replies</h5>
            <form action="{{ route('editor.dashboard') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control" style="height:36px; width: auto;">
                <button type="submit" class="btn btn-primary" style="height:36px; white-space: nowrap;">Filter</button>
            </form>
        </div>
        
    
        <table>
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Comment</th>
                    <th>Replies</th>
                    <th>Commented On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userComments as $comment)
                    <tr>
                        <td>{{ $comment->article->title ?? 'N/A' }}</td>
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
                        <td colspan="4" style="text-align:center;">No comments or replies yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        <div class="pagination mt-3">
            {{ $userComments->links() }}
        </div>
    </div>
    
        

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('articleChart').getContext('2d');
    const articleChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Articles Published',
                data: @json($data),
                fill: true,
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79,70,229,0.1)',
                tension: 0.3,
                borderWidth: 2,
                pointBackgroundColor: '#4F46E5'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<script>
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