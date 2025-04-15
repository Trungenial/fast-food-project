@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Danh sách đơn đặt hàng</h2>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tạo đơn mới</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Người đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="text-center">
                {{-- Duyệt danh sách đơn --}}
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                        <td>
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Xem</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Xoá đơn này?')" class="btn btn-sm btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Phân trang --}}
        @if ($orders->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
