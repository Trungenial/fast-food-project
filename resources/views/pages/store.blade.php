@extends('layouts.main')

@section('title', 'Hệ thống cửa hàng')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger title">HỆ THỐNG CỬA HÀNG JOLLIBEE</h2>

    <div class="main-layout">
        <!-- Danh sách cửa hàng -->
        <div class="store-list">
            @foreach($stores as $store)
            <div class="card store-card">
    <div class="card-body">
        <h5 class="card-title">{{ $store->name }}</h5>
        <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $store->address }}</p>
        <p class="card-text"><small class="text-muted"><i class="fas fa-phone"></i> SĐT: {{ $store->phone }}</small></p>
        <button class="btn btn-map" onclick="updateMap('{{ $store->latitude }}', '{{ $store->longitude }}')">
            <i class="fas fa-map"></i> Xem trên bản đồ
        </button>
        <img src="{{ asset('images/bee.jpg') }}" class="logo-img" alt="Logo">
    </div>
</div>

            @endforeach
        </div>

        <!-- Bản đồ -->
        <div class="map-container">
            <iframe id="mapFrame" class="map-frame"
                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=10.7769,106.7009&output=embed">
            </iframe>
        </div>
    </div>
</div>

<script>
    function updateMap(lat, lng) {
        document.getElementById('mapFrame').src = `https://www.google.com/maps?q=${lat},${lng}&output=embed`;
    }
</script>
@endsection