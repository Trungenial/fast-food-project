@php
$provinceVal = auth()->check() ? auth()->user()->province : '';
$districtVal = auth()->check() ? auth()->user()->district : '';
$wardVal = auth()->check() ? auth()->user()->ward : '';
$addressVal = auth()->check() ? auth()->user()->address : '';
$phoneVal = auth()->check() ? auth()->user()->phone : '';
@endphp

<style>
    .checkout-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.checkout-title {
    text-align: center;
    font-size: 28px;
    color: #dc2626;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 30px;
}

.checkout-form {
    display: flex;
    gap: 40px;
}

.checkout-left, .checkout-right {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.checkout-left {
    flex: 2;
}

.checkout-right {
    flex: 1;
}

.form-section {
    margin-bottom: 24px;
}

.form-section h2 {
    font-size: 18px;
    margin-bottom: 12px;
    color: #333;
}

.form-group {
    display: flex;
    gap: 10px;
    margin-bottom: 12px;
}

.form-group.full {
    flex-direction: column;
}

input, select, textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    flex: 1;
    font-size: 14px;
}

textarea {
    resize: vertical;
}

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn {
    padding: 10px 24px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

.btn.back {
    background-color: #ddd;
}

.btn.submit {
    background-color: #dc2626;
    color: #fff;
}

.order-summary h2 {
    font-size: 18px;
    margin-bottom: 16px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 8px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.order-item img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.item-info {
    flex: 1;
}

.name {
    font-weight: bold;
    margin-bottom: 4px;
}

.qty {
    font-size: 14px;
    color: #666;
}

.price {
    font-weight: bold;
}

.total {
    border-top: 1px solid #ccc;
    padding-top: 12px;
    text-align: right;
}

.total-price {
    font-size: 16px;
    color: #dc2626;
}

.h2{
    color: #dc2626;
}
</style>
@extends('layouts.main')

@section('title', 'Thanh toán')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>


@section('content')
<div class="checkout-container">
    <h1 class="checkout-title">THÔNG TIN ĐƠN HÀNG</h1>

    <form action="{{ route('create-order') }}" method="POST" class="checkout-form">
        @csrf
        <div class="checkout-left">
            <!-- Giao hàng đến -->
            <div class="form-section">
                <h2>Giao hàng đến</h2>
                <div class="form-group">
                    <input type="text" name="last_name" placeholder="Họ *" required>
                    <input type="text" name="first_name" placeholder="Tên *" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="Số điện thoại *" required>
                    <input type="email" name="email" placeholder="Email *" required>
                </div>
                <div class="form-group full">
                    <textarea name="note" placeholder="Ghi chú"></textarea>
                </div>
            </div>

            <!-- Phương thức vận chuyển -->
            <div class="form-section">
                <h2>Phương thức vận chuyển</h2>
                <label><input type="radio" name="delivery" value="home" checked> Giao hàng tận nơi</label><br>
                <label><input type="radio" name="delivery" value="store"> Hẹn lấy tại cửa hàng</label>
        
                <div class="form-group">
                    <select name="city">
                        
                    <option>Hồ Chí Minh</option>
                        @foreach(DB::table('provinces')->get() as $province)
                        <option value="{{ $province->code }}" {{ old('province_code') == $province->code ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option> 
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group full" id="store_pickup">
                <select name="store">
                    <option>Chọn cửa hàng *</option>
                    @foreach(DB::table('stores')->get() as $store)
                    <option value="{{ $store->name}}" {{ old('store_name') == $store->name ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group full"  id="home_delivery">
                <input type="text" name="home_address" placeholder="Địa chỉ nhận hàng *" required>
                <div style="margin-top: 10px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18..."
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="form-group full">
                    <label>Chọn khung giờ lấy hàng</label>
                    <input type="datetime-local" name="time_pickup" required>
            </div>
            <!-- Ghi chú đơn hàng -->
            <div class="form-group full">
                <h2>Ghi chú đơn hàng</h2>
                <textarea name="order_note" placeholder="Ghi chú thêm..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="form-group full">
                <h2>Phương thức thanh toán</h2>
                <select name="method" class="form-select" required>
                        <option value="cash">Thanh toán khi nhận hàng (Tiền mặt)</option>
                        <option value="e_wallet">Momo</option>
                        <option value="credit_card">VNPay</option>
                </select>
            </div>
            <div class="button-group">
                <button type="button" class="btn back">Trở lại</button>
                <button type="submit" class="btn submit">Thanh toán</button>
            </div>
        </div>

        <!-- Chi tiết đơn hàng -->
        <div class="checkout-right">
            <div class="order-summary">
                <h2>Chi tiết đơn hàng</h2>
                @foreach($items as $item)
                <div class="order-item">
                    <img src="{{ asset('storage/items/'.$item['image']) }}" alt="Product">
                    <div class="item-info">
                        <p class="name">{{ $item['name'] }}</p>
                        <p class="qty">x{{ $item['quantity'] }}</p>
                    </div>
                    <p class="price">{{ number_format($item['price'], 0, ',', '.') }}đ</p>
                    <form action="{{ route('cartdelete') }}" method="POST" onsubmit="return confirm('Xoá sản phẩm này?');">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger">X</button>
                    </form>
                </div>
                <div class="total">
                    <p>Đã bao gồm VAT 8%</p>
                    <p class="total-price">Tổng cộng: <strong>{{ number_format($item['subtotal'], 0, ',', '.') }}đ</strong></p>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function(){
    $('input[name="delivery"]').on('change', function(){
        if ($(this).val() === 'home') {
            $('#home_delivery').show();
            $('#store_pickup').hide();
        }
        else{
            $('#store_pickup').show();
            $('#home_delivery').hide();
        }
    });    
});
</script>

<script>
    function initAutocomplete() {
        const input = document.getElementById('autocomplete');
        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['geocode'],
            componentRestrictions: { country: "vn" }
        });
    }

    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>

@endsection
