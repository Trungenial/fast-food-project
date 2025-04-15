@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thống kê hệ thống</h2>

        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Tổng doanh thu</h5>
                    <p><strong>{{ number_format($totalRevenue) }} đ</strong></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Tổng đơn hàng</h5>
                    <p><strong>{{ $totalOrders }}</strong></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Tổng người dùng</h5>
                    <p><strong>{{ $totalUsers }}</strong></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Doanh thu theo tháng
        const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        new Chart(monthlyRevenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_map(fn($m) => "Tháng $m", array_keys($monthlyRevenue->toArray()))) !!},
                datasets: [{
                    label: 'Doanh thu theo tháng',
                    data: {!! json_encode(array_values($monthlyRevenue->toArray())) !!},
                    borderColor: 'blue',
                    fill: false,
                    tension: 0.3
                }]
            }
        });

        // Top sản phẩm bán chạy
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($topProducts->toArray())) !!},
                datasets: [{
                    label: 'Số lượng bán',
                    data: {!! json_encode(array_values($topProducts->toArray())) !!},
                    backgroundColor: 'orange'
                }]
            }
        });
    </script>
@endsection
