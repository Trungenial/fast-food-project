@extends('layouts.main')

@section('title', 'Thực đơn')
@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <label>Số lượng</label>
                <div class="d-flex justify-content-center mb-3"> 

                    <div class="order">
                        <input type="number" class="product-number" min="1" value=1>
                        <button id="add-to-cart" class='btn-add-to-cart' data-id="{{ $row->id }}">ĐẶT HÀNG</button>
                    </div>
                </div> 
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
    // Gắn sự kiện click cho tất cả các nút có class .btn-add-to-cart
    $('.btn-add-to-cart').click(function () {
        let id = $(this).data('id');
        let num = $(this).closest('.card').find('.product-number').val();



        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('cartadd') }}",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                num: num
            },
            success: function (data) {
                $('#cart-number-product').html(data);
                alert("Đã thêm vào giỏ hàng!");
            },
            error: function (xhr) {
            }
        });
    });
});

</script>
@endsection