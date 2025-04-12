@extends('layouts.main')

@section('title', $title)

@section('content')
<div class="container py-5">
    <h1 class="text-center text-danger fw-bold mb-4">HƯỚNG DẪN ĐẶT PHẦN ĂN</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded p-4">
                <h3 class="mb-3">1. HƯỚNG DẪN ĐẶT PHẦN ĂN</h3>
                <p>Để đặt phần ăn trên website <a href="https://www.jollibee.com.vn" target="_blank">www.jollibee.com.vn</a>, khách hàng có thể thực hiện theo 02 cách thức sau:</p>

                <h4 class="text-primary">Cách 1: Đặt phần ăn trực tuyến</h4>
                <ol class="list-group list-group-numbered mb-3">
                    <li class="list-group-item">Chọn phần ăn mong muốn tại chuyên mục "Thực Đơn".</li>
                    <li class="list-group-item">Các phần ăn đã chọn sẽ hiển thị trong "Phần ăn đã chọn", khách hàng có thể thay đổi.</li>
                    <li class="list-group-item">Sau khi hoàn tất, chọn "Đặt hàng".</li>
                    <li class="list-group-item">Nhập thông tin giao hàng: họ tên, địa chỉ, số điện thoại, email.</li>
                    <li class="list-group-item">Xác nhận đơn hàng và chọn "Đồng ý đặt hàng".</li>
                    <li class="list-group-item">Hệ thống gửi tin nhắn xác nhận trong vòng 10 phút.</li>
                </ol>

                <h4 class="text-primary">Cách 2: Gọi tổng đài 1900-1533</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item">Gọi điện thoại để tổng đài viên hỗ trợ.</li>
                    <li class="list-group-item">Cung cấp thông tin giao hàng.</li>
                    <li class="list-group-item">Jollibee tiếp nhận đơn hàng và giao hàng theo thời gian sau:</li>
                </ul>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Phạm vi giao hàng</th>
                                <th>Thời gian giao hàng</th>
                                <th>Giá trị đơn hàng tối thiểu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dưới 3km</td>
                                <td>30 phút</td>
                                <td>60.000 VNĐ</td>
                            </tr>
                            <tr>
                                <td>3km - 5km</td>
                                <td>45 phút</td>
                                <td>100.000 VNĐ</td>
                            </tr>
                            <tr>
                                <td>5km - 8km</td>
                                <td>60 phút</td>
                                <td>200.000 VNĐ</td>
                            </tr>
                            <tr>
                                <td>Trên 8km</td>
                                <td>Không nhận giao hàng</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="mt-4">2. XÁC NHẬN ĐƠN HÀNG</h3>
                <p>Sau khi hoàn thành đơn hàng, hệ thống sẽ tự động gửi tin nhắn xác nhận.</p>
                <p>Trong vòng 5 phút, nhân viên tổng đài sẽ xử lý và xác nhận đơn hàng.</p>
                <p>Nếu không nhận được tin nhắn, vui lòng gọi <strong class="text-danger">1900-1533</strong>.</p>
            </div>
        </div>
    </div>
</div>
@endsection
