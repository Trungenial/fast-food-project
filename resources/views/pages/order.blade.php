@extends('layouts.main')
@section('title', 'Giỏ hàng')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>

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
                    <td>{{ $item['quantity'] }}</td>
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
        <form action="{{ route('ordercreate') }}" method="POST" class="mt-4">
            @csrf
            

            
            <div class="row">
                <div class="col-md-6">
                    <label for="method" class="form-label">Phương thức thanh toán:</label>
                    <select name="method" class="form-select" required>
                        <option value="cash">Thanh toán khi nhận hàng (Tiền mặt)</option>
                        <option value="e_wallet">Momo</option>
                        <option value="credit_card">VNPay</option>
                    </select>
                </div>
                <div class="col-md-6 text-end align-self-end">
                    <h5 class="mt-2">Tổng tiền: <strong class="text-danger">{{ number_format($total, 0, ',', '.') }}đ</strong></h5>

                    @auth
                        <button type="submit" class="btn btn-success mt-3">🛍️ Đặt hàng</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning mt-3">Đăng nhập để đặt hàng</a><br><br>
                        <a href="{{ route('nologin') }}" class="btn btn-outline-warning">
                        Đặt hàng không cần đăng nhập
                    </a>
                    @endauth
                </div>
            </div>

        </form>
    @endif
</div>

@endsection
