@php
$provinceVal = auth()->check() ? auth()->user()->province : '';
$districtVal = auth()->check() ? auth()->user()->district : '';
$wardVal = auth()->check() ? auth()->user()->ward : '';
$addressVal = auth()->check() ? auth()->user()->address : '';
$phoneVal = auth()->check() ? auth()->user()->phone : '';
@endphp

@extends('layouts.main')
@section('title', 'Giỏ hàng')
@section('css')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
    }

    .checkout-box {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .checkout-box label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        color: #333;
    }

    .checkout-box .form-control,
    .checkout-box .form-select {
        border-radius: 10px;
        height: 44px;
        font-size: 14px;
    }

    .checkout-box h5 {
        font-weight: bold;
        margin-bottom: 1rem;
        color: #e31837;
    }

    .btn-jolli {
        background-color: #e31837;
        border: none;
        color: white;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 15px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-jolli:hover {
        background-color: #c5112e;
        transform: scale(1.03);
    }

    .jolli-total {
        font-size: 1.3rem;
        color: #e31837;
        font-weight: 700;
    }

    .jolli-cart-icon {
        font-size: 26px;
        color: #e31837;
        margin-right: 10px;
    }

    .table {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table thead {
        background-color: #fafafa;
        font-weight: 600;
    }

    .table img {
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .checkout-box {
            padding: 20px;
        }

        .btn-jolli {
            width: 100%;
            margin-top: 1rem;
        }

        .table {
            font-size: 14px;
        }

        .table td,
        .table th {
            padding: 10px;
        }
    }
</style>
@endsection
@section('content')

<div class="container mt-4">
    <h5 class="mb-3">GIỎ HÀNG CỦA BẠN</h5>
    @if (count($items) === 0)
    <div class="alert alert-warning">Giỏ hàng của bạn đang trống.</div>
    @else
    <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xoá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td><img src="{{ asset('storage/items/'.$item['image']) }}" width="60" class="img-thumbnail"></td>
                <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                <td>
                    <form action="{{ route('cartupdate') }}" method="POST" class="d-flex align-items-center justify-content-center">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                            class="form-control form-control-sm text-center" style="width: 60px;">
                        <button type="submit" class="btn btn-sm btn-light ms-2">Cập nhật</button>
                    </form>
                </td>
                <td>{{ number_format($item['subtotal'], 0, ',', '.') }}đ</td>
                <td>
                    <form action="{{ route('cartdelete') }}" method="POST" onsubmit="return confirm('Xoá sản phẩm này?');">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FORM ĐẶT HÀNG --}}
    <form action="{{ route('ordercreate') }}" method="POST" class="checkout-box">
        <h5 class="mb-3">THÔNG TIN GIAO HÀNG</h5>
        <p class="text-muted">Vui lòng điền đầy đủ thông tin để chúng tôi có thể giao hàng cho bạn.</p>
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="province">Tỉnh/Thành phố</label>
                <select name="province" id="province" class="form-select" required>
                    <option value="">-- Chọn Tỉnh --</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->code }}" {{ $provinceVal == $province->name ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>

                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="district">Quận/Huyện</label>
                <select name="district" id="district" class="form-select" required>
                    <option value="">-- Chọn Huyện --</option>
                    @foreach($districts as $district)
                    <option value="{{ $district->code }}" {{ $districtVal == $district->name ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>


                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="ward">Phường/Xã</label>
                <select name="ward" id="ward" class="form-select" required>
                    <option value="">-- Chọn Phường --</option>
                    @foreach($wards as $ward)
                    <option value="{{ $ward->code }}" {{ $wardVal == $ward->name ? 'selected' : '' }}>
                        {{ $ward->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-3">
            <label for="address">Địa chỉ cụ thể (Số nhà, tên đường...)</label>
            <input type="text" class="form-control" name="address" id="address"
                value="{{ old('address', $addressVal) }}" required>
        </div>

        <div class="mt-3">
            <label for="receiver_phone">Số điện thoại người nhận</label>
            <input type="text" class="form-control" name="receiver_phone"
                value="{{ old('receiver_phone', $phoneVal) }}" required>
        </div>

        <div class="row align-items-center mt-4">
            <div class="col-md-6">
                <label for="method">Phương thức thanh toán</label>
                <select name="method" class="form-select" required>
                    <option value="cash">Thanh toán khi nhận hàng</option>
                    <option value="e_wallet">Momo</option>
                    <option value="credit_card">VNPay</option>
                </select>
            </div>
            <div class="col-md-6 text-end">
                <p class="mb-1">Tổng tiền:</p>
                <div class="jolli-total mb-2">{{ number_format($total, 0, ',', '.') }}đ</div>
                <input type="hidden" name="shipping_address" id="shipping_address">
                @auth
                <button type="submit" class="btn btn-jolli">Đặt hàng</button>
                @else
                <a href="{{ route('login') }}" class="btn btn-warning">Đăng nhập để đặt hàng</a><br><br>
                <a href="{{ route('nologin') }}" class="btn btn-outline-warning">Đặt hàng không cần đăng nhập</a>
                @endauth
            </div>
        </div>
    </form>


    @endif
</div>

@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const province = document.getElementById('province');
        const district = document.getElementById('district');
        const ward = document.getElementById('ward');
        const addressInput = document.getElementById('address');
        const fullAddressInput = document.getElementById('shipping_address');

        // Lấy tên từ option (not value)
        function getSelectedText(select) {
            return select.options[select.selectedIndex]?.text || '';
        }

        document.querySelector('form').addEventListener('submit', function() {
            const fullAddress = [
                addressInput.value,
                getSelectedText(ward),
                getSelectedText(district),
                getSelectedText(province)
            ].filter(Boolean).join(', ');

            fullAddressInput.value = fullAddress;
        });

        province.addEventListener('change', function() {
            const code = this.value;
            district.innerHTML = '<option value="">-- Chọn Huyện --</option>';
            ward.innerHTML = '<option value="">-- Chọn Phường --</option>';

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
    });
</script>
@endpush