@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Order Details - Order #{{ $order[0]->id }}</h1>

        <p><strong>Customer Name:</strong> {{ $order[0]->user_name }}</p>
        <p><strong>Order Date:</strong> {{ $order[0]->created_at }}</p>
        <p><strong>Shipping Address:</strong> {{ $order[0]->shipping_address }}</p>
        <p><strong>Receiver Phone:</strong> {{ $order[0]->receiver_phone }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order[0]->status) }}</p>

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
    </div>
@endsection
