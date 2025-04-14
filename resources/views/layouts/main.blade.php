<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Jollibee</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">


    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('css/main_style.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/home_style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <style>
        .cart-icon {
            position: relative;
            display: inline-block;
            color: white;
            text-decoration: none;
            transition: transform 0.2s ease-in-out;
        }

        .cart-icon:hover {
            transform: scale(1.1);
            color: #ffc107;
        }

        .cart-badge {
            position: absolute;
            top: -6px;
            right: -10px;
            background-color: #23b85c;
            color: white;
            font-size: 12px;
            font-weight: bold;
            width: 20px;
            height: 20px;
            line-height: 20px;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0 0 0 2px white;
        }
    </style>


</head>


<body>
    <div class="dashboard-sidebar">

        <a href="{{ url('/home') }}" class="active"><img src="{{ asset('images/Jollibee_logo2.png') }}"
                alt="Brand Logo" class="brand-logo"></a>
        <div class='dashboard-nav-dropdown'>
            <a href="#" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-utensils"></i>
                DANH
                MỤC MÓN ĂN </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="#" class="dashboard-nav-dropdown-item">Ưu Đãi</a>
                <a href="#" class="dashboard-nav-dropdown-item">Món Mới</a>
                <a href="#" class="dashboard-nav-dropdown-item">Món ngon phải thử</a>
                <a href="#" class="dashboard-nav-dropdown-item">Gà giòn vui vẻ</a>
                <a href="#" class="dashboard-nav-dropdown-item">Mỳ ý Jolly</a>
                <a href="#" class="dashboard-nav-dropdown-item">Gà sốt cay</a>
                <a href="#" class="dashboard-nav-dropdown-item">Burger/Cơm</a>
                <a href="#" class="dashboard-nav-dropdown-item">Phần ăn phụ</a>
                <a href="#" class="dashboard-nav-dropdown-item">Tráng miệng</a>
                <a href="#" class="dashboard-nav-dropdown-item">Nước uống</a>
            </div>
        </div>
        <div class='dashboard-nav-dropdown'>
            <a href="#" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-info-circle"></i> VỀ
                JOLLIBEE </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="#" class="dashboard-nav-dropdown-item">Câu Chuyện Của Chúng Tôi</a>
                <a href="#" class="dashboard-nav-dropdown-item">Tin Khuyến Mãi</a>
                <a href="#" class="dashboard-nav-dropdown-item">Tin tức JOLLIBEE</a>
                <a href="#" class="dashboard-nav-dropdown-item">Tuyển dụng</a>
                <a href="#" class="dashboard-nav-dropdown-item">Đặt tiệc Sinh nhật</a>
                <a href="#" class="dashboard-nav-dropdown-item">Đơn Lớn Giá Hời</a>
            </div>
        </div>
        <div class='dashboard-nav-dropdown'>
            <a href="#" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-phone-alt"></i>
                LIÊN
                HỆ JOLLIBEE </a>
            <div class='dashboard-nav-dropdown-menu'>
                <a href="#" class="dashboard-nav-dropdown-item">Theo dõi đơn hàng</a>
            </div>
        </div>
        <a href="#" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> ĐĂNG XUẤT </a>
    </div>
    <div class="dashboard-content">
        <div class="toolbar-top">
            <div class="decor-left">
                <i class="fas fa-drumstick-bite" style="color: #e31837;"></i>
            </div>
            <div class="logo-container">
                <a href="{{ url('/home') }}" class="active"> <img src="{{ asset('images/Header.png') }}"
                        alt="Jollibee Logo" class="logo"> </a>
            </div>
            <div class="decor-right">
                <i class="fas fa-drumstick-bite" style="color: #e31837;"></i>
            </div>
        </div>
        <div class="dashboard-toolbar">
            <span class="menu-toggle"><i class="fas fa-bars"></i></span>
            <div class="toolbar-left">
                <div class="toolbar-menu">
                    <a href="{{ url('/home') }}" class="{{ request()->is('home') ? 'active' : '' }}">
                        <span>TRANG CHỦ</span></a>
                    <a href="{{ url('/menu') }}"
                        class="nav-link {{ request()->is('menu') || request()->is('menu/category/*') ? 'active' : '' }}">
                        THỰC ĐƠN
                    </a>
                    <a href="{{ url('/khuyen-mai') }}"
                        class="{{ request()->is('khuyen-mai') ? 'active' : '' }}"><span>KHUYẾN MÃI</span></a>
                    <a href="{{ url('/dich-vu-tiec') }}"
                        class="{{ request()->is('dich-vu-tiec') ? 'active' : '' }}"><span>DỊCH VỤ TIỆC</span></a>
                    <a href="{{ url('/store') }}" class="{{ request()->is('store') ? 'active' : '' }}"><span>HỆ
                            THỐNG NHÀ HÀNG</span></a>
                    <a href="{{ url('/contact') }}"
                        class="{{ request()->is('contact') ? 'active' : '' }}"><span>LIÊN
                            HỆ</span></a>
                    <a href="{{ url('/tuyen-dung') }}"
                        class="{{ request()->is('tuyen-dung') ? 'active' : '' }}"><span>TUYỂN DỤNG</span></a>
                </div>
            </div>

            <div class="cart-wrapper position-relative me-3">
                <a href="{{ route('order') }}" class="cart-icon">
                    <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    <span class="cart-badge" id="cart-number-product">
                        {{ session('cart') ? array_sum(session('cart')) : 0 }}
                    </span>
                </a>
            </div>
            <div class="toolbar-right">
                @auth
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-danger dropdown-toggle fw-bold text-white px-3 py-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item text-dark" href="{{ route('account') }}">
                                <i class="fas fa-user-cog me-2 text-primary"></i> Quản lý tài khoản
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-dark" href="{{ route('myorders') }}">
                                <i class="fas fa-receipt me-2 text-success"></i> Đơn hàng của tôi
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                </a>
                            </form>
                        </li>

                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}">
                    <button class="btn btn-outline-light text-dark fw-bold me-2">
                        <i class="fas fa-sign-in-alt me-1"></i> Đăng nhập
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn btn-warning fw-bold text-red-700">
                        <i class="fas fa-user-plus me-1"></i> Đăng ký
                    </button>
                </a>
                @endauth
            </div>

        </div>
        <div class="dashboard-main">
            @yield('content')
            @yield('css')
        </div>
        <footer class="dashboard-footer">
            <div class="footer-container">
                <div class="footer-left">
                    <img src="{{ asset('images/Jollibee_logo2.png') }}" alt="Jollibee Logo" class="footer-logo">
                    <p><strong>CÔNG TY TNHH JOLLIBEE VIỆT NAM</strong></p>
                    <p>Địa chỉ: Tầng 26, Tòa nhà CII Tower, số 152 Điện Biên Phủ, Phường 25, Quận Bình Thạnh, TP. Hồ Chí
                        Minh, Việt Nam</p>
                    <p>Điện thoại: (028) 39309168</p>
                    <p>Tổng đài: 1900-1533</p>
                    <p>Mã số thuế: 0303883266</p>
                    <p>Ngày cấp: 15/07/2008 - Nơi cấp: Cục Thuế Hồ Chí Minh</p>
                    <p>Hộp thư góp ý: <a href="mailto:jbvnfeedback@jollibee.com.vn">jbvnfeedback@jollibee.com.vn</a>
                    </p>
                </div>
                <div class="footer-middle">
                    <p><strong>GIAO HÀNG TẬN NƠI</strong></p>
                    <p class="hotline"><i class="fas fa-phone"></i> 1900-1533</p>
                    <ul>
                        <li><a href="{{ url('/contact') }}"
                                class="{{ request()->is('contact') ? 'active' : '' }}">Liên hệ</a></li>
                        <li><a href="{{ route('footer.show', 'chinh-sach-quy-dinh-chung') }}">Chính sách & quy
                                định chung</a></li>
                        <li><a href="{{ route('footer.show', 'chinh-sach-thanh-toan') }}">Chính sách thanh
                                toán</a></li>
                        <li><a href="{{ route('footer.show', 'chinh-sach-hoat-dong') }}">Chính sách hoạt động</a>
                        </li>
                        <li><a href="{{ route('footer.show', 'chinh-sach-bao-mat') }}">Chính sách bảo mật</a></li>
                        <li><a href="{{ route('footer.show', 'van-chuyen-giao-nhan') }}">Vận chuyển & giao
                                nhận</a></li>
                        <li><a href="{{ route('footer.show', 'thong-tin-dang-ky-giao-dich') }}">Thông tin đăng ký
                                giao dịch</a></li>
                        <li><a href="{{ route('footer.show', 'huong-dan-dat-hang') }}">Hướng dẫn đặt hàng</a></li>
                    </ul>
                </div>
                <div class="footer-right">
                    <p><strong>HÃY KẾT NỐI VỚI CHÚNG TÔI</strong></p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/JollibeeVietnam" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>

                        <a href="mailto:jbvnfeedback@jollibee.com.vn"><i class="fas fa-envelope"></i> E-Mail</a>
                    </div>
                    <img src="{{ asset('images/bo_cong_thuong.png') }}" alt="Bộ Công Thương" class="gov-logo">
                    <p><strong>TẢI ỨNG DỤNG ĐẶT HÀNG</strong></p>
                    <div class="store-buttons">
                        <img src="{{ asset('images/google_play.png') }}" alt="Google Play">
                        <img src="{{ asset('images/app_store.png') }}" alt="App Store">
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2020 Jollibee Viet Nam</p>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>