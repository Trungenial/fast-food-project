@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Order #{{ $order[0]->id }}</h1>

        <form action="{{ route('orders.update', $order[0]->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Mã đơn hàng -->
            <div class="mb-3">
                <label for="order_id" class="form-label">Order ID</label>
                <input type="text" class="form-control" id="order_id" value="{{ $order[0]->id }}" disabled>
            </div>

            <!-- Tên người đặt -->
            <div class="mb-3">
                <label for="user_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="user_name" value="{{ $order[0]->user_name }}" disabled>
            </div>

            <!-- Địa chỉ giao hàng -->
            <div class="mb-3">
                <label for="shipping_address" class="form-label">Shipping Address</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                    value="{{ $order[0]->shipping_address }}">
            </div>

            <!-- Số điện thoại người nhận -->
            <div class="mb-3">
                <label for="receiver_phone" class="form-label">Receiver Phone</label>
                <input type="text" class="form-control" id="receiver_phone" name="receiver_phone"
                    value="{{ $order[0]->receiver_phone }}">
            </div>

            <!-- Trạng thái đơn hàng -->
            <div class="mb-3">
                <label for="status" class="form-label">Order Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pending" {{ $order[0]->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order[0]->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order[0]->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ $order[0]->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <h3>Order Items:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td>{{ $item->quantity * $item->product_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Total: {{ $order->sum(fn($item) => $item->quantity * $item->product_price) }} VND</h3>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
@endsection
