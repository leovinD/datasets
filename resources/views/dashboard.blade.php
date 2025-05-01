@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bold">Sales Data Set Report</h1>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Total Sales Value</h5>
                    <p class="display-6 fw-bold text-success">
                        ₱{{ number_format($totalSalesValue, 2) }}
                    </p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Number of Sales Records</h5>
                    <p class="display-6 fw-bold text-info">
                        {{ $numberOfSales }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">
                        Total Products Sold: <span class="fw-bold text-primary">{{ $totalSalesUnits }}</span>
                    </h5>
                    <hr class="my-3" />
                    <h6 class="fw-bold">Products Sold Per Region</h6>
                    <ul class="list-unstyled mt-3">
                        @foreach($salesPerRegion as $region)
                            <li class="h6 fw-semibold text-warning">
                                {{ $region->region }}: {{ $region->total_units }} units
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent fw-bold">Sales Count Per Region</div>
                <div class="card-body">
                    <canvas id="salesPerRegionChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Products Sold Per Month</h5>
                    <canvas id="salesPerMonthChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart
    const salesPerMonthCtx = document.getElementById('salesPerMonthChart').getContext('2d');
    new Chart(salesPerMonthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesPerMonth->pluck('month')) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($salesPerMonth->pluck('units_sold')) !!},
                borderColor: '#16404D',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Bar Chart
    const salesPerRegionCtx = document.getElementById('salesPerRegionChart').getContext('2d');
    new Chart(salesPerRegionCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($salesPerRegion->pluck('region')) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($salesPerRegion->pluck('total_units')) !!},
                backgroundColor: '#3E5879',
                borderColor: '#213555',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
