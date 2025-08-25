@extends('admin.inc.main')

@section('Admin-contents')

<style>

.report-filters {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.report-box {
    background: #f9f9f9;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.report-filters {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

#reportChart {
    background: #fff;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

</style>

<main class="main-content">
    <div class="main-container">
        <header class="page-header">
            <p>View insights on your activity, growth, and document engagement.</p>
        </header>

        <div class="report-filters">
            <label for="filter">Filter by:</label>
            <select id="filter" onchange="updateChart()">
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>

        <canvas id="reportChart" width="400" height="200"></canvas>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function filterReports() {
        const filter = document.getElementById('filter').value;
        const content = document.getElementById('report-content');

        let html = '';

        if (filter === 'weekly') {
            html = `
                <div class="report-box">
                    <h3>Weekly Report</h3>
                    <p>14 new documents uploaded</p>
                    <p>5 team collaborations</p>
                    <p>12 user interactions</p>
                </div>`;
        } else if (filter === 'monthly') {
            html = `
                <div class="report-box">
                    <h3>Monthly Report</h3>
                    <p>60 documents uploaded</p>
                    <p>25 team collaborations</p>
                    <p>95 user interactions</p>
                </div>`;
        } else if (filter === 'yearly') {
            html = `
                <div class="report-box">
                    <h3>Yearly Report</h3>
                    <p>650 documents uploaded</p>
                    <p>200 team collaborations</p>
                    <p>1120 user interactions</p>
                </div>`;
        }

        content.innerHTML = html;
    }


    const ctx = document.getElementById('reportChart').getContext('2d');
    let reportChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Documents', 'Collaborations', 'Interactions'],
            datasets: [{
                label: 'Weekly Report',
                data: [14, 5, 12],
                backgroundColor: ['#4F46E5', '#10B981', '#F59E0B'],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateChart() {
        const filter = document.getElementById('filter').value;

        let data = [];
        let label = '';

        switch (filter) {
            case 'weekly':
                label = 'Weekly Report';
                data = [14, 5, 12];
                break;
            case 'monthly':
                label = 'Monthly Report';
                data = [60, 25, 95];
                break;
            case 'yearly':
                label = 'Yearly Report';
                data = [650, 200, 1120];
                break;
        }

        reportChart.data.datasets[0].data = data;
        reportChart.data.datasets[0].label = label;
        reportChart.update();
    }
</script>

@endsection
