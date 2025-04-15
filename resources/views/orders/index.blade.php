@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Danh sách đơn đặt hàng</h2>

        <form method="GET" action="{{ route('orders.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                    placeholder="Tìm kiếm theo tên, trạng thái, số điện thoại, email...">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Người đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Số điện thoại</th> <!-- Thêm cột Số điện thoại -->
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
                        <td>{{ $order->phone ?? 'Không có số điện thoại' }}</td>
                        <!-- Sử dụng fallback nếu không có số điện thoại -->
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
                <nav aria-label="Order pagination">
                    <ul class="pagination">
                        {{-- Trang đầu --}}
                        <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->url(1) }}" aria-label="First">
                                ⏪ Trang đầu
                            </a>
                        </li>

                        {{-- Phân trang mặc định --}}
                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            <li class="page-item {{ $orders->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Trang cuối --}}
                        <li class="page-item {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}" aria-label="Last">
                                ⏩ Trang cuối
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
