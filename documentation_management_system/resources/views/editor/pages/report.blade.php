{{-- @extends('editor.inc.main')
@section('contents')

<main class="main-content">
  <div class="main-container">

    <header class="page-header">
        <p>📊 Website Reports & Insights</p>
    </header>

    <!-- Summary Cards -->
    <section class="cards">
        <div class="card"><div class="number">{{ $totalArticles }}</div><div class="label">Articles</div></div>
        <div class="card"><div class="number">{{ $totalDocuments }}</div><div class="label">Documents</div></div>
        <div class="card"><div class="number">{{ $totalReports }}</div><div class="label">Reports</div></div>
        <div class="card"><div class="number">{{ $activeUsers }}</div><div class="label">Active Users</div></div>
    </section>

    <!-- Growth Chart -->
    <div class="card mb-4" style="padding:1.5rem; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h5 style="margin: 0;">📈 Report Growth</h5>
            <form method="GET" action="{{ route('editor.reports') }}">
                <select name="time_range" class="form-select" onchange="this.form.submit()">
                    <option value="3" {{ request('time_range', '6') == '3' ? 'selected' : '' }}>Last 3 Months</option>
                    <option value="6" {{ request('time_range', '6') == '6' ? 'selected' : '' }}>Last 6 Months</option>
                    <option value="12" {{ request('time_range', '6') == '12' ? 'selected' : '' }}>Last 12 Months</option>
                    <option value="ytd" {{ request('time_range', '6') == 'ytd' ? 'selected' : '' }}>Year to Date</option>
                </select>
            </form>
        </div>
        <canvas id="reportChart"></canvas>
    </div>

    <!-- Recent Activity -->
    <section class="table-container card mb-4" style="padding:1.5rem;">
        <h5>📝 Recent Activity</h5>
        <table>
            <thead><tr><th>Type</th><th>Title</th><th>Date</th></tr></thead>
            <tbody>
                @foreach($recentArticles as $item)
                    <tr><td>Article</td><td>{{ $item->title }}</td><td>{{ $item->created_at->format('Y-m-d') }}</td></tr>
                @endforeach
                @foreach($recentDocuments as $item)
                    <tr><td>Document</td><td>{{ $item->title }}</td><td>{{ $item->created_at->format('Y-m-d') }}</td></tr>
                @endforeach
                @foreach($recentReports as $item)
                    <tr><td>Report</td><td>{{ $item->title }}</td><td>{{ $item->created_at->format('Y-m-d') }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </section>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('reportChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Reports Created',
            data: @json($data),
            fill: true,
            borderColor: '#4F46E5',
            backgroundColor: 'rgba(79,70,229,0.1)',
            tension: 0.3
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});
</script>
@endsection --}}
