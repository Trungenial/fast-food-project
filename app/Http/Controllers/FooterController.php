<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function show($slug)
{
    $pages = [
        'chinh-sach-quy-dinh-chung' => 'Chính sách & quy định chung',
        'chinh-sach-thanh-toan' => 'Chính sách thanh toán',
        'chinh-sach-hoat-dong' => 'Chính sách hoạt động',
        'chinh-sach-bao-mat' => 'Chính sách bảo mật',
        'van-chuyen-giao-nhan' => 'Vận chuyển & giao nhận',
        'thong-tin-dang-ky-giao-dich' => 'Thông tin đăng ký giao dịch',
        'huong-dan-dat-hang' => 'Hướng dẫn đặt hàng'
    ];
    if (!view()->exists("footers.contents.$slug")) {
        dd("View footers.contents.$slug không tồn tại!");
    }
    

    return view("footers.contents.$slug", ['title' => $pages[$slug]]);
}

}
