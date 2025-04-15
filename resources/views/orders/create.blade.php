@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Tạo đơn đặt hàng mới</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">ID người dùng</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="store_id" class="form-label">ID chi nhánh</label>
                <input type="number" name="store_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Tổng tiền</label>
                <input type="number" step="0.01" name="total_price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Lưu đơn hàng</button>
        </form>
    </div>
@endsection
