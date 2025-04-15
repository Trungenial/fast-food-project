@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Orders Without Login</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        <td>{{ $order->created_at }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('orders_without_login.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('orders_without_login.edit', $order->id) }}"
                                class="btn btn-warning btn-sm">Xóa</a>
                            <form action="{{ route('orders_without_login.destroy', $order->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this order?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sửa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
