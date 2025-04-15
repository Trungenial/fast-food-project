@extends('layouts.main')

@section('title', 'Thực đơn')
@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('content')
@if(isset($status))
    <div class="alert alert-success">{{ $status }}</div>
@endif
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
                    <div class="d-flex flex-column align-items-center mb-3">
                        <div class="button" data-id="{{ $row->id }}">
                            <div class="button-wrapper">
                                <div class="text">Thêm vào giỏ hàng</div>
                                <span class="icon">
                                    <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16">
                                        <path d="M0 2.5A.5.5 0 0 1 ..."></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <!-- Ô nhập số lượng ẩn -->
                        <div class="quantity-box mt-2 d-none">
                            <input type="number" class="form-control form-control-sm text-center quantity-input"
                                value="1" min="1" style="width: 80px;">
                            <button type="button" class="btn btn-sm btn-danger mt-1 add-to-cart" data-id="{{ $row->id }}">
                                Xác nhận
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Hiện ô nhập số lượng
        document.querySelectorAll('.button').forEach(button => {
            button.addEventListener('click', function () {
                const box = button.closest('.d-flex.flex-column').querySelector('.quantity-box');
                box.classList.toggle('d-none');
            });
        });

        // Gửi AJAX thêm giỏ hàng
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const quantity = parseInt(
                    this.closest('.quantity-box').querySelector('.quantity-input').value
                );

                console.log('Sending quantity:', quantity); // ✅ debug xem có đúng không

                fetch("{{ route('cartadd') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId, num: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('cart-number-product').textContent = data.count;

                        const toast = document.createElement('div');
                        toast.innerText = 'Đã thêm vào giỏ hàng!';
                        toast.style = 'position: fixed; bottom: 20px; right: 20px; padding: 10px 15px; background: #28a745; color: #fff; border-radius: 5px; z-index: 1000;';
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 2000);
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi gửi request:', error);
                });
            });
        });
    });
</script>
@endpush


