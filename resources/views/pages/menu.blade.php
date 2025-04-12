@extends('layouts.main')

@section('title', 'Thực đơn')
@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('content')
<div class="content-background">
<div class="category-menu">
    <a href="{{ url('/menu') }}"
        class="category-item {{ request()->is('menu') ? 'active' : '' }}">
        Tất cả món ăn
    </a>
    @foreach($categories as $category)
    <a href="{{ url('/menu/category/' . $category->id) }}"
        class="category-item {{ request()->segment(3) == $category->id ? 'active' : '' }}">
        {{ $category->name }}
    </a>
    @endforeach
</div>

<div class="container mt-4">
    <div class="row">
        @foreach($data as $row)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card h-100 shadow-sm border-0 d-flex flex-column justify-content-between">
                <img src="{{ asset('storage/items/'.$row->image) }}" class="card-img-top p-2" 
                     style="max-width: 100%; height: auto; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $row->name }}</h6>
                    <p class="card-text text-danger fw-bold">{{ number_format($row->price, 0, ",", ".") }}đ</p>
                </div>
                <div class="d-flex justify-content-center mb-3"> 
                    <div class="button">
                        <div class="button-wrapper">
                            <div class="text">Thêm vào giỏ hàng</div>
                            <span class="icon">
                                <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection