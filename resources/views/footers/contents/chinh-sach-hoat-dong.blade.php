@extends('layouts.main')

@section('title', 'Chính sách hoạt động')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger">Chính Sách Hoạt Động</h2>

    <!-- Hướng dẫn đặt phần ăn -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">1. Hướng Dẫn Đặt Phần Ăn</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">Cách 1: Đặt phần ăn trực tuyến</h5>
            <ol>
                <li>Chọn phần ăn tại chuyên mục "Thực Đơn".</li>
                <li>Kiểm tra "Phần ăn đã chọn" và điều chỉnh nếu cần.</li>
                <li>Chọn "Đặt hàng" và điền thông tin giao hàng.</li>
                <li>Xác nhận đơn hàng và nhận tin nhắn trong 10 phút.</li>
            </ol>

            <h5 class="text-primary">Cách 2: Gọi tổng đài 1900-1533</h5>
            <ol>
                <li>Liên hệ tổng đài, cung cấp thông tin phần ăn.</li>
                <li>Nhân viên yêu cầu thông tin giao hàng.</li>
                <li>Xác nhận và giao hàng trong thời gian quy định.</li>
            </ol>
        </div>
    </div>

    <!-- Xác nhận đơn hàng -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">2. Xác Nhận Đơn Hàng</h4>
        </div>
        <div class="card-body">
            <p>Sau khi đặt hàng, hệ thống sẽ gửi tin nhắn xác nhận.</p>
            <p>Nhân viên tổng đài xử lý trong vòng 5 phút.</p>
            <p>Nếu không nhận được tin nhắn, vui lòng gọi <strong>1900-1533</strong>.</p>
        </div>
    </div>

    <!-- Chính sách chung -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">3. Các Chính Sách Chung</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">Chính sách thanh toán</h5>
            <p>Khách hàng thanh toán bằng tiền mặt tại nơi giao hàng.</p>

            <h5 class="text-primary">Chính sách giao hàng</h5>
            <ul>
                <li>Thời gian giao hàng từ 30 phút trở lên.</li>
                <li>Phạm vi giao hàng tối đa 8km.</li>
                <li>Jollibee Việt Nam sẽ thông báo nếu có chậm trễ.</li>
            </ul>
        </div>
    </div>

    <!-- Chính sách đổi, trả hàng -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">4. Chính Sách Đổi, Trả Hàng</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">Chính sách đổi hàng</h5>
            <ul>
                <li>Khách hàng có thể điều chỉnh đơn hàng trong vòng 1 phút.</li>
                <li>Đơn hàng dưới 50.000 VNĐ không được điều chỉnh.</li>
                <li>Jollibee sẽ đổi hàng nếu có lỗi hoặc sản phẩm không đạt chất lượng.</li>
            </ul>

            <h5 class="text-primary">Chính sách trả hàng</h5>
            <p>Nếu phần ăn bị hư, hỏng, khách hàng có thể liên hệ <strong>1900-1533</strong> để yêu cầu đổi hoặc hoàn tiền.</p>
        </div>
    </div>
</div>
@endsection
