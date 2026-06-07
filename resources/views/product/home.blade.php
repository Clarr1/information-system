<x-layout>

<div class="dash-wrap container py-4">

    <!-- Header -->
    <div class="dash-header">
        <h2>Inventory Dashboard</h2>
        <p>Overview of your stock, purchases, and product activity</p>
    </div>

    <!-- CARDS -->
    <div class="row g-3 mb-4 dash-cards">

        <div class="col-md-3 stat-card accent-1">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Products</span>
            </div>
            <div class="stat-card-value">{{ $totalProducts }}</div>
            <div class="stat-card-sub">Products in catalog</div>
        </div>

        <div class="col-md-3 stat-card accent-2">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Stock</span>
            </div>
            <div class="stat-card-value">{{ $totalStock }}</div>
            <div class="stat-card-sub">Units available</div>
        </div>

        <div class="col-md-3 stat-card accent-3">
            <div class="stat-card-top">
                <span class="stat-card-label">Low Stock Items</span>
            </div>
            <div class="stat-card-value">{{ $lowStock }}</div>
            <div class="stat-card-sub">Needs restocking</div>
        </div>

        <div class="col-md-3 stat-card accent-4">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Purchases</span>
            </div>
            <div class="stat-card-value">{{ $totalPurchases }}</div>
            <div class="stat-card-sub">Transactions made</div>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="dash-charts">

        <!-- BAR CHART -->
        <div class="card p-3 mb-4 chart-panel">
            <div class="chart-panel-header">
                <h5>Stock per Product</h5>
                <span>Quantity</span>
            </div>
            <canvas id="stockChart"></canvas>
        </div>

        <!-- PIE CHART -->
        <div class="card p-3 chart-panel">
            <div class="chart-panel-header">
                <h5>Stock Status Overview</h5>
                <span>Status</span>
            </div>
            <canvas id="pieChart"></canvas>
        </div>

    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* BAR CHART */
new Chart(document.getElementById('stockChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($productNames) !!},
        datasets: [{
            label: 'Stock Quantity',
            data: {!! json_encode($productStocks) !!},
            backgroundColor: 'rgba(26, 29, 35, 0.8)',
            borderRadius: 6,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f0f0f0' },
                ticks: { color: '#9a9a9a', font: { size: 11 } }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#9a9a9a', font: { size: 11 } }
            }
        }
    }
});

/* PIE CHART */
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: {!! json_encode($stockLabels) !!},
        datasets: [{
            data: {!! json_encode($stockValues) !!},
            backgroundColor: [
                'rgba(26, 29, 35, 0.85)',
                'rgba(180, 180, 180, 0.7)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#6b6b6b',
                    font: { size: 12 },
                    padding: 16,
                    usePointStyle: true,
                    pointStyleWidth: 8
                }
            }
        }
    }
});
</script>

</x-layout>