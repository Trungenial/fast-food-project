@extends('layouts.main')

@section('title', $title)

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger">Thông tin đăng ký giao dịch chung</h2>

    <!-- Chính sách giao nhận và hoàn trả đơn hàng -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">I. CÁC CHÍNH SÁCH GIAO NHẬN VÀ HOÀN TRẢ ĐƠN HÀNG</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">1. Chính sách giao hàng – nhận hàng:</h5>
            <p>Sau khi tiếp nhận đơn hàng, nhân viên giao hàng Jollibee Việt Nam sẽ giao hàng đến địa chỉ do khách hàng cung cấp trong vòng <strong>30 phút trở lên</strong>.</p>
            <ul>
                <li>Thời gian nhận đơn hàng trực tuyến: <strong>09:00 - 21:00</strong></li>
                <li>Tổng giá trị đơn hàng tối thiểu: <strong>60.000 VNĐ</strong></li>
                <li>Thời gian giao hàng có thể thay đổi tùy điều kiện thời tiết, giao thông...</li>
            </ul>

            <h5 class="text-primary">2. Chính sách đổi hàng – trả hàng:</h5>
            <ul>
                <li>Nếu phát hiện phần ăn sai hoặc hư hỏng, khách hàng có thể yêu cầu đổi hàng trong <strong>30 phút</strong>.</li>
                <li>Khách hàng có thể yêu cầu hoàn tiền nếu sản phẩm có vấn đề nghiêm trọng.</li>
                <li>Liên hệ tổng đài <strong>1900-1533</strong> để khiếu nại.</li>
            </ul>
        </div>
    </div>

    <!-- Quy định chung -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">II. CÁC QUY ĐỊNH CHUNG</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">1. Quy trình xử lý khiếu nại</h5>
            <ol>
                <li><strong>Bước 1:</strong> Tiếp nhận khiếu nại qua <strong>1900-1533</strong> hoặc email.</li>
                <li><strong>Bước 2:</strong> Xử lý khiếu nại trong vòng <strong>24 giờ</strong>.</li>
                <li><strong>Bước 3:</strong> Thông báo kết quả cho khách hàng qua điện thoại hoặc email.</li>
            </ol>

            <h5 class="text-primary">2. Điều khoản sử dụng Website</h5>
            <p>Khách hàng truy cập website đồng nghĩa với việc chấp nhận các chính sách và quy định của Jollibee Việt Nam.</p>
        </div>
    </div>

    <!-- Quyền và nghĩa vụ -->
    <div class="card my-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">III. QUYỀN VÀ NGHĨA VỤ CỦA NGƯỜI DÙNG</h4>
        </div>
        <div class="card-body">
            <h5 class="text-primary">1. Quyền của khách hàng</h5>
            <ul>
                <li>Được sử dụng dịch vụ đặt hàng trực tuyến miễn phí.</li>
                <li>Được phản hồi, khiếu nại nếu có vấn đề.</li>
            </ul>

            <h5 class="text-primary">2. Nghĩa vụ của khách hàng</h5>
            <ul>
                <li>Cung cấp thông tin chính xác khi đặt hàng.</li>
                <li>Không sử dụng phần mềm gian lận hoặc tấn công hệ thống.</li>
                <li>Tự chịu trách nhiệm với tài khoản của mình.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
