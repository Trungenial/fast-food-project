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
                    <div class="order">
                        <input type="number" id='product-number' class="product-number" min="1" placeholder="Số lượng..." data-id="{{ $row->id }}">
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

<script>
    $(document).ready(function(){

        $('#add-to-cart').click(function(){
            var id = $(this).data('id');
        var num = $(this).siblings('.product-number').val();
            $.ajax({
                type:"POST",
                dataType: "json",
                url: "{{route('cartadd')}}",
                data:{"_token": "{{ csrf_token() }}", "id": id, "num":num},
                beforeSend:function(){

                },
                success: function(data){
                    $("$cart-number-product").html(data);
                },
                error: function(xhr, status, error){

                },
                complete: function(xhr, status){

                }
            });
        });
    });
</script>