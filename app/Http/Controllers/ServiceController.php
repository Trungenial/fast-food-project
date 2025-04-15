<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ServiceController extends Controller
{
    /**
     * Hiển thị trang dịch vụ
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dichvu()
    {
        // Dữ liệu cho các dịch vụ
        $services = [
            [
                'id' => 1,
                'title' => 'Giao hàng tận nơi',
                'image' => 'laytaicuahang.png',
                'description' => 'Giao hàng tận nơi',
                'route' => 'thuc-don',
                'slug' => 'giao-hang-tan-noi'
            ],
            [
                'id' => 2,
                'title' => 'Đặt tiệc sinh nhật',
                'image' => 'dattiecsinhnhat.png',
                'description' => 'Bạn đang tìm ý tưởng cho một buổi tiệc sinh nhật thật đặc biệt dành cho con của bạn? Hãy chọn những bữa tiệc của Jollibee. Sẽ có nhiều điều vui nhộn và rất đáng nhớ dành cho con của bạn.',
                'route' => 'dich-vu.birthday',
                'slug' => 'dat-tiec-sinh-nhat'
            ],
            [
                'id' => 3,
                'title' => 'Jollibee kid club',
                'image' => 'kidclub.png',
                'description' => 'Hãy để con bạn thỏa thích thể hiện và khám phá tài năng bản thân trong của mình cùng cơ hội gặp gỡ những bạn đồng lứa khác tại Jollibee Kids Club. Cùng tìm hiểu thêm thông tin về Jollibee Kids Club và tham gia ngay.',
                'route' => 'dich-vu.kidclub',
                'slug' => 'jollibee-kid-club'
            ],
            [
                'id' => 4,
                'title' => 'Đơn hàng lớn',
                'image' => 'donhanglon.png',
                'description' => 'Để phục vụ sở thích quây quần cùng gia đình và bạn bè, chương trình chiết khấu hấp dẫn dành cho những đơn hàng lớn đã ra đời để đem đến những lựa chọn tiện lợi hơn cho bạn. Liên hệ ngay với cửa hàng gần nhất để được phục vụ.',
                'route' => 'dich-vu.order',
                'slug' => 'don-hang-lon'
            ],
        ];

        // Banner chính
        $banner = [
            'image' => 'banner-service.jpg',
            'title' => 'DỊCH VỤ',
            'subtitle' => 'TẬN HƯỞNG NHỮNG KHOẢNH KHẮC TRỌN VẸN CÙNG JOLLIBEE',
            'alt' => 'Dịch vụ Jollibee'
        ];

        return view('pages.service', compact('services', 'banner'));
    }

    /**
     * Hiển thị trang đặt tiệc sinh nhật
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function birthday()
    {
        return view('pages.dich-vu-birthday');
    }

    /**
     * Hiển thị trang Jollibee Kid Club
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kidclub()
    {
        return view('pages.dich-vu-kidclub');
    }

    /**
     * Hiển thị trang đơn hàng lớn
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function order()
    {
        return view('pages.dich-vu-order');
    }
}


?>