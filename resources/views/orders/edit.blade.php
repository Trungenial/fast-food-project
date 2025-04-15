@extends('layouts.admin')

@section('content')
    <h3>Chỉnh sửa đơn hàng #{{ $order->id }}</h3>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="order_id" class="form-label">Mã đơn hàng</label>
            <input type="text" class="form-control" id="order_id" value="{{ $order->id }}" disabled>
        </div>

        <div class="mb-3">
            <label for="user_name" class="form-label">Tên người đặt</label>
            <input type="text" class="form-control" id="user_name" value="{{ $order->user_name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Tổng giá</label>
            <input type="text" class="form-control" id="total_price" name="total_price"
                value="{{ old('total_price', $order->total_price) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách đơn hàng</a>
@endsection
