@extends('layouts.admin')

@section('content')
    <h3>Chi tiết đơn hàng #{{ $order->id }}</h3>
    <table class="table">
        <tr>
            <th>Tên người đặt</th>
            <td>{{ $order->user_name }}</td>
        </tr>
        <tr>
            <th>Địa chỉ giao hàng</th>
            <td>{{ $order->shipping_address }}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{ $order->receiver_phone }}</td>
        </tr>
        <tr>
            <th>Tổng giá</th>
            <td>{{ number_format($order->total_price, 2) }} VND</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $order->created_at }}</td>
        </tr>
    </table>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Quay lại danh sách đơn hàng</a>
@endsection
