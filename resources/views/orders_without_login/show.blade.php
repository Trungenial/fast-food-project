@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Order Details #{{ $order->id }}</h1>

        <div class="mb-3">
            <strong>Customer:</strong> {{ $order->first_name }} {{ $order->last_name }}
        </div>
        <div class="mb-3">
            <strong>Phone:</strong> {{ $order->phone }}
        </div>
        <div class="mb-3">
            <strong>Email:</strong> {{ $order->email }}
        </div>
        <div class="mb-3">
            <strong>Delivery Method:</strong> {{ ucfirst($order->delivery_method) }}
        </div>
        <div class="mb-3">
            <strong>Total Price:</strong> {{ number_format($order->total_price, 2) }} VND
        </div>
        <div class="mb-3">
            <strong>Status:</strong> {{ ucfirst($order->status) }}
        </div>

        <a href="{{ route('orders_without_login.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
        <a href="{{ route('orders_without_login.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
@endsection
