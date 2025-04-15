<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt hàng thành công</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 20px;
        }
        h2 {
            color: #e31837;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            font-size: 14px;
            margin-top: 10px;
        }
        td {
            padding: 5px 0;
            vertical-align: top;
        }
        td:first-child {
            font-weight: bold;
            width: 160px;
            color: #555;
        }
        .total-price {
            font-weight: bold;
            color: #e31837;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <h2>Đặt hàng thành công!</h2>

        <p>Xin chào <strong>{{ Auth::user()->name }}</strong>,</p>
        <p>Chúng tôi đã nhận được đơn hàng <strong>#{{ $order->id }}</strong> của bạn.</p>

        <table>
            <tr>
                <td>Địa chỉ giao hàng:</td>
                <td>{{ $order->shipping_address }}</td>
            </tr>
            <tr>
                <td>SĐT người nhận:</td>
                <td>{{ $order->receiver_phone }}</td>
            </tr>
            <tr>
                <td>Ngày đặt:</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Phương thức thanh toán:</td>
                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'Thanh toán khi nhận hàng')) }}</td>
            </tr>
        </table>

        <p><strong>Chi tiết sản phẩm:</strong></p>
        <ul>
            @foreach ($items as $item)
                <li>{{ $item->name }} x{{ $item->quantity }} – {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</li>
            @endforeach
        </ul>

        <p class="total-price">Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }}đ</p>

        <p>Cảm ơn bạn đã đặt hàng tại Jollibee. Đơn hàng của bạn sẽ được xử lý và giao trong thời gian sớm nhất. Vui lòng chú ý điện thoại.</p>
        <p>Mọi thắc mắc vui lòng gọi <strong>1900 1533</strong>.</p>

        <div class="footer">
            © {{ date('Y') }} Jollibee Vietnam. Gửi từ hệ thống đặt hàng trực tuyến.
        </div>
    </div>
</body>
</html>
