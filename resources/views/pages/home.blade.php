@extends('layouts.main')

@section('title', 'Trang Chủ')

@section('content')
    <div class="home-content">
        <!-- Hero Slider Banner -->
        <div class="hero-slider">
            @foreach($slides as $slide)
                <div class="slider-item {{ $slide['active'] ? 'active' : '' }}">
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['alt'] }}" class="slider-image">
                </div>
            @endforeach
            <div class="slider-controls">
                <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                <div class="slider-dots">
                    @foreach($slides as $index => $slide)
                        <span class="slider-dot {{ $slide['active'] ? 'active' : '' }}"></span>
                    @endforeach
                </div>
                <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <!-- Order Now Call-to-Action -->
        <div class="order-now-cta">
            <a href="#" class="order-button">ĐẶT HÀNG</a>
        </div>

        <!-- Menu Categories -->
        <div class="home-section">
            <div class="section-heading">
                <h2>ĂN GÀ HÔM NAY</h2>
                <p>Thực đơn Jollibee đa dạng và phong phú, có rất nhiều sự lựa chọn cho bạn, gia đình và bạn bè.</p>
            </div>
            <div class="menu-categories">
                @foreach($categoryItems as $item)
                    <a href="{{ $item['link'] }}" class="category-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['alt'] }}">
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Services Section -->
        <div class="home-section services-section">
            <div class="section-heading">
                <h2>DỊCH VỤ</h2>
                <p>TẬN HƯỞNG NHỮNG KHOẢNH KHẮC TRỌN VẸN CÙNG JOLLIBEE</p>
            </div>
            <div class="services-grid">
                @foreach($serviceItems as $service)
                    <div class="service-item">
                        <img src="{{ asset('images/home/dv/' . $service['image']) }}" alt="{{ $service['title'] }}">
                        <h3>{{ $service['title'] }}</h3>
                        <a href="{{ $service['link'] }}" class="service-button">XEM THÊM</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-content">
                <h2>JOLLIBEE, XIN CHÀO</h2>
                <p>Chúng tôi là Jollibee Việt Nam với hơn 100 cửa hàng trên khắp cả nước, chúng tôi mong muốn đem đến niềm
                    vui ẩm thực cho mọi gia đình Việt bằng những món ăn có chất lượng tốt, hương vị tuyệt hảo, dịch vụ chu
                    đáo với một mức giá hợp lý. Hãy đến và thưởng thức nhé!</p>
                <a href="#" class="welcome-button">ĐẶT HÀNG</a>
            </div>
            <div class="welcome-image">
                <img src="{{ asset('images/welcome-food.jpg') }}" alt="Jollibee Food">
            </div>
        </div>

        <!-- Store Finder -->
        <div class="store-finder">
            <h2>TÌM CỬA HÀNG</h2>
            <div class="store-finder-form">
                <select class="store-province">
                    <option>Chọn Tỉnh/Thành</option>
                    @foreach($provinces as $province)
                        <option>{{ $province }}</option>
                    @endforeach
                </select>
                <select class="store-district">
                    <option>Chọn Quận/Huyện</option>
                </select>
                <button class="search-button">TÌM KIẾM</button>
            </div>
        </div>

        <!-- News Section -->
        <div class="home-section news-section">
            <div class="section-heading">
                <h2>TIN TỨC</h2>
            </div>
            <div class="news-grid">
                @foreach($newsItems as $news)
                    <div class="news-item">
                        <div class="news-image">
                            <img src="{{ asset('images/home/tintuc/' . $news['image']) }}" alt="{{ $news['title'] }}">
                        </div>
                        <div class="news-content">
                            <h3>{{ $news['title'] }}</h3>
                            <p>{{ $news['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="view-more">
                <a href="#" class="view-more-button">XEM THÊM</a>
            </div>
        </div>

        <!-- Mobile App Promotion -->
        <div class="app-promotion">
            <h3>TẢI ỨNG DỤNG ĐẶT HÀNG VỚI NHIỀU ƯU ĐÃI HƠN</h3>
            <div class="app-store-buttons">
                <a href="https://play.google.com/store/apps/details?id=com.jollibee.loyalty">
                    <img src="https://ext.same-assets.com/2633368737/3212266464.png" alt="Google Play">
                </a>
                <a href="https://apps.apple.com/vn/app/jollibee-vietnam/id1554984107">
                    <img src="https://ext.same-assets.com/2633368737/1429762212.png" alt="App Store">
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // code chạy sau khi trang tải xong
            // Slider Functionality
            let currentSlide = 0;
            const slides = document.querySelectorAll('.slider-item');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-prev');
            const nextBtn = document.querySelector('.slider-next');

            function updateSlider() {
                slides.forEach((slide, index) => {
                    slide.classList.remove('active');
                    dots[index].classList.remove('active');
                });
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                updateSlider();
            }

            // Set up event listeners
            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', prevSlide);
                nextBtn.addEventListener('click', nextSlide);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });

            // Auto slide
            setInterval(nextSlide, 5000);
        });
    </script>
@endsection