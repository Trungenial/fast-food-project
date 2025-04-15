<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        /* ... CSS bạn đã cung cấp ... */
    </style>
</head>
<body>
    <div class="email-wrapper">
        <h2>Xác nhận đơn hàng #{{ $order->id }}</h2>

        <p>Xin chào <strong>{{ $order->first_name }} {{ $order->last_name }}</strong>,</p>
        <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Đơn hàng của bạn với mã số <strong>#{{ $order->id }}</strong> đã được ghi nhận.</p>

        <h3>Thông tin đơn hàng:</h3>
        <table>
            <tr><td>Họ và tên:</td><td>{{ $order->first_name }} {{ $order->last_name }}</td></tr>
            <tr><td>Số điện thoại:</td><td>{{ $order->phone }}</td></tr>
            <tr><td>Email:</td><td>{{ $order->email }}</td></tr>
            <tr><td>Địa chỉ giao hàng:</td><td>{{ $order->full_address }}</td></tr>
            <tr><td>Ngày đặt hàng:</td><td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td></tr>
            <tr><td>Phương thức thanh toán:</td><td>{{ ucfirst(str_replace('_', ' ', $order->payment->method ?? 'Thanh toán khi nhận hàng')) }}</td></tr>
            @if ($order->note)
            <tr><td>Ghi chú:</td><td>{{ $order->note }}</td></tr>
            @endif
        </table>

        <h3>Chi tiết đơn hàng:</h3>
        <table>
            <thead>
                <tr><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Tổng</th></tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total-price">Tổng cộng: {{ number_format($order->total_price, 0, ',', '.') }}đ</p>

        <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng và tiến hành giao hàng.</p>

        <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email này hoặc số điện thoại <strong>1900 1533</strong>.</p>

        <p>Trân trọng,</p>
        <p>Đội ngũ của bạn</p>
    </div>
</body>
</html>