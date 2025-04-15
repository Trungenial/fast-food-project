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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="order-items">
                    @foreach ($order as $item)
                        <tr data-id="{{ $item->product_id }}">
                            <td>{{ $item->product_name }}</td>
                            <td>
                                <input type="number" class="form-control item-quantity"
                                    name="order_items[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}"
                                    min="1">
                            </td>
                            <td>{{ $item->product_price }}</td>
                            <td class="item-total">{{ $item->quantity * $item->product_price }}</td>
                            <input type="hidden" name="order_items[{{ $loop->index }}][product_id]"
                                value="{{ $item->product_id }}">
                            <td>
                                <button type="button" class="btn btn-danger btn-sm delete-item"
                                    data-id="{{ $item->product_id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Chọn sản phẩm mới để thêm vào đơn hàng -->
            <div class="mb-3">
                <label for="new_product" class="form-label">Add New Product</label>
                <select class="form-select" id="new_product" name="new_product">
                    <option value="">Select a product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} VND</option>
                    @endforeach
                </select>
            </div>

            <!-- Số lượng sản phẩm mới -->
            <div class="mb-3">
                <label for="new_product_quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="new_product_quantity" name="new_product_quantity"
                    min="1" value="1">
            </div>

            <h3>Total: <span id="order-total">{{ $order->sum(fn($item) => $item->quantity * $item->product_price) }}</span>
            </h3>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <!-- JavaScript for live calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update the total price for each product row
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.item-quantity').forEach(function(input) {
                    const quantity = parseInt(input.value);
                    const price = parseFloat(input.closest('tr').querySelector('td:nth-child(3)')
                    .innerText);
                    const rowTotal = quantity * price;
                    input.closest('tr').querySelector('.item-total').innerText = rowTotal.toFixed(2);
                    total += rowTotal;
                });
                document.getElementById('order-total').innerText = total.toFixed(2);
            }

            // Event listener to update total when quantity changes
            document.querySelectorAll('.item-quantity').forEach(function(input) {
                input.addEventListener('input', updateTotal);
            });

            // Event listener for delete item button
            document.querySelectorAll('.delete-item').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productId = button.getAttribute('data-id');
                    const row = button.closest('tr');
                    row.remove(); // Xóa sản phẩm khỏi bảng

                    // Cập nhật lại tổng
                    updateTotal();
                });
            });

            // Initialize the total when the page is loaded
            updateTotal();
        });
    </script>
@endsection
