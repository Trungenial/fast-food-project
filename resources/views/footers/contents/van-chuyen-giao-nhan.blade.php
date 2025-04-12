@extends('layouts.main')

@section('title', 'Thông tin vận chuyển và giao nhận')

@section('content')
<div class="container py-5">
    <h1 class="text-center text-danger fw-bold mb-4">THÔNG TIN VẬN CHUYỂN VÀ GIAO NHẬN</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded p-4">
                <h3 class="mb-3"><i class="fas fa-truck text-warning"></i> 1. Chính sách giao hàng – nhận hàng</h3>
                <p>
                    Sau khi tiếp nhận đơn hàng, nhân viên giao hàng Jollibee Việt Nam sẽ giao hàng đến địa chỉ do khách hàng cung cấp trong vòng 30 phút trở lên.
                    Tại thời điểm giao hàng, khách hàng kiểm tra phần ăn theo đơn hàng ghi trên hóa đơn và số tiền cần thanh toán. Khách hàng vui lòng thanh toán bằng tiền mặt.
                    Việc giao hàng kết thúc khi khách hàng xác nhận đủ phần ăn.
                </p>

                <div class="alert alert-info">
                    <h4 class="text-primary"><i class="fas fa-exclamation-circle"></i> Các lưu ý:</h4>
                    <ul class="mb-0">
                        <li>Thời gian giao hàng có thể nhanh hơn hoặc lâu hơn do thời tiết, đơn hàng quá tải hoặc sự cố trên đường.</li>
                        <li>Nếu phát sinh sự kiện gây chậm trễ, Jollibee sẽ thông báo đến khách hàng ngay.</li>
                        <li>Khách hàng có thể thay đổi địa chỉ hoặc điều chỉnh đơn hàng trong vòng <strong>1 phút</strong> từ khi xác nhận đơn hàng.</li>
                        <li>Việc thay đổi phần ăn sẽ không được chấp nhận nếu quá 1 phút sau khi đơn hàng được tiếp nhận.</li>
                    </ul>
                </div>

                <h3 class="mt-4"><i class="fas fa-exchange-alt text-success"></i> 2. Chính sách đổi, trả hàng</h3>

                <h4 class="text-primary"><i class="fas fa-sync"></i> Chính sách đổi hàng:</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item">Khách hàng có thể yêu cầu điều chỉnh đơn hàng trong vòng <strong>1 phút</strong> từ khi đơn hàng đã xác nhận.</li>
                    <li class="list-group-item">Đơn hàng có giá trị dưới 60.000 VNĐ sau khi điều chỉnh sẽ không được chấp nhận.</li>
                    <li class="list-group-item">Nếu phần ăn bị nhầm lẫn do lỗi của Jollibee, chúng tôi sẽ đổi hàng ngay.</li>
                    <li class="list-group-item">Nếu phát hiện phần ăn bị hư hỏng, khách hàng cần phản ánh trong vòng <strong>30 phút</strong> để được đổi hàng.</li>
                </ul>

                <h4 class="text-primary"><i class="fas fa-undo"></i> Chính sách trả hàng:</h4>
                <div class="alert alert-danger">
                    <p>
                        Nếu phần ăn bị hư hỏng, ôi thiu, khách hàng hãy gọi ngay <strong>1900-1533</strong>.
                        Jollibee sẽ kiểm tra và tiến hành đổi hàng. Nếu khách hàng không muốn đổi, Jollibee sẽ hoàn tiền tương ứng với giá trị phần ăn bị lỗi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
