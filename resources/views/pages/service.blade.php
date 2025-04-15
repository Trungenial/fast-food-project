@extends('layouts.main')

@section('title', 'Dịch Vụ')

@section('content')
    <div class="service-page">
        <!-- Banner chính -->
        <div class="service-banner">
            <img src="{{ asset('images/home/dv/' . $banner['image']) }}" alt="{{ $banner['alt'] }}" class="banner-image">
            <div class="banner-content">
                <h1>{{ $banner['title'] }}</h1>
                <p>{{ $banner['subtitle'] }}</p>
            </div>
        </div>

        <!-- Danh sách dịch vụ -->
        <div class="service-list">
            @foreach($services as $service)
                <div class="service-item" id="service-{{ $service['id'] }}">
                    <div class="service-image">
                        <img src="{{ asset('images/home/dv/' . $service['image']) }}" alt="{{ $service['title'] }}">
                    </div>
                    <div class="service-content">
                        <h2>{{ $service['title'] }}</h2>
                        <p>{{ $service['description'] }}</p>
                        @if($service['id'] == 1)
                            <a href="{{ route($service['route']) }}" class="service-btn">Xem thêm</a>
                        @else
                            <a href="{{ route($service['route']) }}" class="service-btn">Xem thêm</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- CSS cho trang dịch vụ -->
    <style>
        .service-page {
            padding: 0;
            background-color: #f6f2ee;
        }

        .service-banner {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 2;
            width: 100%;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .banner-content h1 {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .banner-content p {
            font-size: 1.2em;
        }

        .service-list {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .service-item {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 40px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .service-item:nth-child(odd) {
            flex-direction: row;
        }

        .service-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .service-image {
            flex: 1;
            max-width: 350px;
            padding: 20px;
        }

        .service-image img {
            width: 100%;
            border-radius: 10px;
            height: 100%;
            /* Đảm bảo ảnh phủ hết chiều cao */
            object-fit: cover;
            /* Giữ tỉ lệ ảnh, bao phủ container mà không bị méo */
            transition: transform 0.3s;
        }

        .service-item:hover .service-image img {
            transform: scale(1.05);
        }

        .service-content {
            flex: 2;
            padding: 30px;
        }

        .service-content h2 {
            font-size: 1.8em;
            color: #db1a34;
            margin-bottom: 15px;
        }

        .service-content p {
            color: #383f3a;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .service-btn {
            display: inline-block;
            background-color: #db1a34;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .service-btn:hover {
            background-color: #b01529;
            color: white;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .service-banner {
                height: 250px;
            }

            .banner-content h1 {
                font-size: 2.2em;
            }

            .banner-content p {
                font-size: 1em;
            }

            .service-item,
            .service-item:nth-child(odd),
            .service-item:nth-child(even) {
                flex-direction: column;
            }

            .service-image {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
@endsection