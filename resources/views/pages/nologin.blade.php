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
    color: red;
}
.order-summary h2 {
    font-size: 18px;
    margin-bottom: 12px;
    color: red;
}

.form-group h2{
    font-size: 18px;
    margin-bottom: 12px;
    color: red;
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
            <div class="form-section">
                <h2>Phương thức vận chuyển</h2>
                <label><input type="radio" name="delivery" value="store" checked> Hẹn lấy tại cửa hàng</label><hr>
                <label><input type="radio" name="delivery" value="home" > Giao hàng tận nơi</label>
                

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
                <select name="province" id="province" required> 
                    <option>Chọn tỉnh thành</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->code }}" {{ $provinceVal == $province->name ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>
                    @endforeach
                </select>
                <select name="district" id="district" required> 
                    <option>Chọn Quận/Huyện</option>
                    @foreach($districts as $district)
                    <option value="{{ $district->code }}" {{ $districtVal == $district->name ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                    @endforeach
                </select>
                <select name="ward" id="ward" required> 
                    <option>Chọn Phường/Xã</option>
                    @foreach($wards as $ward)
                    <option value="{{ $ward->code }}" {{ $wardVal == $ward->name ? 'selected' : '' }}>
                        {{ $ward->name }}
                    </option>
                    @endforeach
                </select>
                <input type="text" name="home_address" placeholder="Địa chỉ nhận hàng cụ thể*" required>
                <input type="hidden" name="full_address" id="full_address">
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
    function toggleDeliveryFields() {
        const isHome = $('input[name="delivery"]:checked').val() === 'home';

        $('#home_delivery').toggle(isHome);
        $('#store_pickup').toggle(!isHome);

        // Vô hiệu hóa/khôi phục các field tương ứng
        $('#home_delivery select, #home_delivery input').each(function() {
            $(this).prop('disabled', !isHome);
            $(this).prop('required', isHome);
        });

        $('#store_pickup select').each(function() {
            $(this).prop('disabled', isHome);
            $(this).prop('required', !isHome);
        });
    }

    toggleDeliveryFields(); // Gọi khi trang load
    $('input[name="delivery"]').on('change', toggleDeliveryFields);
});

</script>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const province = document.getElementById('province');
        const district = document.getElementById('district');
        const ward = document.getElementById('ward');
        const fullAddress = document.getElementById('full_address');

        function getSelectedText(select) {
            return select.options[select.selectedIndex]?.text || '';
        }

        function updateFullAddress() {
            const p = getSelectedText(province);
            const d = getSelectedText(district);
            const w = getSelectedText(ward);
            const homeAddress = document.querySelector('input[name="home_address"]')?.value || '';

            const parts = [homeAddress, w, d, p].filter(Boolean); // cụ thể + phường + huyện + tỉnh
            fullAddress.value = parts.join(', ');
        }



        province.addEventListener('change', function() {
            const code = this.value;
            district.innerHTML = '<option value="">-- Chọn Huyện --</option>';
            ward.innerHTML = '<option value="">-- Chọn Phường --</option>';
            updateFullAddress();

            if (code) {
                fetch(`/get-districts/${code}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(d => {
                            district.innerHTML += `<option value="${d.code}">${d.name}</option>`;
                        });
                    });
            }
        });

        district.addEventListener('change', function() {
            const code = this.value;
            ward.innerHTML = '<option value="">-- Chọn Phường --</option>';
            updateFullAddress();

            if (code) {
                fetch(`/get-wards/${code}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(w => {
                            ward.innerHTML += `<option value="${w.code}">${w.name}</option>`;
                        });
                    });
            }
        });

        ward.addEventListener('change', updateFullAddress);
        document.querySelector('input[name="home_address"]').addEventListener('input', updateFullAddress);

    });
</script>
@endpush

