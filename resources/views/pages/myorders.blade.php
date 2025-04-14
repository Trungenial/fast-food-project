@extends('layouts.main')
@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Lịch sử đơn hàng</h3>

    @if (count($orders) === 0)
        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    @else
        @foreach ($orders as $order)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Đơn hàng #{{ $order->id }}</h5>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</small>
                </div>

                <p class="mb-1"><strong>Trạng thái:</strong> {{ $order->status }}</p>
                <p class="mb-3"><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }}đ</span></p>

                <ul class="list-group">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $item->name }}
                                <small class="text-muted">(x{{ $item->quantity }})</small>
                            </div>
                            <strong>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
