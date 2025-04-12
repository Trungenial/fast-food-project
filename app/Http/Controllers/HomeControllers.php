<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function home()
    {
        // Data banner for the homepage
        $slides = [
            [
                'image' => 'https://ext.same-assets.com/2633368737/2770116787.jpeg',
                'alt' => 'Ưu đãi',
                'active' => true
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/3130229424.jpeg',
                'alt' => 'Món mới',
                'active' => false
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/193735459.jpeg',
                'alt' => 'Gà sốt cay',
                'active' => false
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/2145939902.png',
                'alt' => 'Mỳ ý sốt bò bằm',
                'active' => false
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/1444064827.jpeg',
                'alt' => 'Đặt hàng',
                'active' => false
            ]
        ];

        // Danh sách các danh mục sản phẩm 

        $categoryItems = [
            [
                'image' => 'https://ext.same-assets.com/2633368737/1638698690.png',
                'alt' => 'Gà Giòn Vui Vẻ',
                'link' => '#'
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/3212333748.png',
                'alt' => 'Gà Sốt Cay',
                'link' => '#'
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/723302826.png',
                'alt' => 'Mỳ Ý Sốt Bò Bằm',
                'link' => '#'
            ],
            [
                'image' => 'https://ext.same-assets.com/2633368737/2428134458.png',
                'alt' => 'Món Tráng Miệng',
                'link' => '#'
            ]
        ];

        // Danh sách các dịch vụ

        $serviceItems = [
            [
                'image' => 'laytaicuahang.png',
                'title' => 'LẤY TẠI CỬA HÀNG',
                'link' => '#'
            ],
            [
                'image' => 'dattiecsinhnhat.png',
                'title' => 'ĐẶT TIỆC SINH NHẬT',
                'link' => '#'
            ],
            [
                'image' => 'kidclub.png',
                'title' => 'JOLLIBEE KID CLUB',
                'link' => '#'
            ],
            [
                'image' => 'donhanglon.png',
                'title' => 'ĐƠN HÀNG LỚN',
                'link' => '#'
            ]
        ];

        // Danh sách các tin tức

        $newsItems = [
            [
                'image' => 'news-1.jpg',
                'title' => 'JOLLIBEE ĐẠT MỐC 200 CỬA HÀNG TẠI THỊ TRƯỜNG VIỆT NAM',
                'content' => 'Sự kiện khai trương cửa hàng thứ 200 là cột mốc quan trọng trong kế hoạch mở rộng kinh doanh và khẳng định vị thế của Jollibee trong thị trường thức ăn nhanh Việt Nam.',
                'link' => 'https://jollibee.com.vn/media/magefan_blog/VN1.jpg'
            ],
            [
                'image' => 'news-2.jpg',
                'title' => 'HỢP TÁC BỀN VỮNG GIÚP JOLLIBEE PHÁT TRIỂN TẠI VIỆT NAM SAU HAI THẬP KỶ',
                'content' => 'Việc có chung mục tiêu và mối quan hệ hợp tác chặt chẽ với các đối tác giúp Jollibee Việt Nam phát triển bền bỉ suốt gần 20 năm qua.',
                'link' => 'https://jollibee.com.vn/media/magefan_blog/VN1.jpg'
            ],
            [
                'image' => 'news-3.jpg',
                'title' => 'JOLLIBEE VIỆT NAM KHAI TRƯƠNG CỬA HÀNG THỨ 191',
                'content' => 'Vào ngày 17/05/2024, tại tuyến phố Mê Linh sầm uất của phường Liên Bảo, thành phố Vĩnh Yên, Jollibee Mê Linh chính thức khai trương, đánh dấu cột mốc sau 14 năm khai trương cửa hàng thứ 2 tại Vĩnh Phúc.',
                'link' => 'https://jollibee.com.vn/media/magefan_blog/TT1_1.jpg'
            ],
            [
                'image' => 'news-4.jpg',
                'title' => 'JOLLIBEE VIỆT NAM KHAI TRƯƠNG CỬA HÀNG THỨ 150',
                'content' => 'Jollibee Việt Nam đã đưa vào vận hành nhà máy mới với chứng nhận ISO 22000:2018 về quản lý an toàn vệ sinh thực phẩm quốc tế.',
                'link' => 'https://jollibee.com.vn/media/wysiwyg/thumbnail.jpg'
            ]
        ];

        // Danh sách các tỉnh thành phố
        $provinces = [
            'Hà Nội',
            'TP. Hồ Chí Minh',
            'Đà Nẵng',
            'Cần Thơ',
            'Hải Phòng'
        ];

        return view('pages.home', compact(
            'slides',
            'categoryItems',
            'serviceItems',
            'newsItems',
            'provinces'
        ));
    }
}
