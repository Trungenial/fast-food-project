@extends('layouts.main')

@section('title', 'Contact us')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<div class="container py-5">
    <h1>LIÊN HỆ JOLLIBEE</h1>
    <div class="content">
        <div class="contact-form">
            <h2>THÔNG TIN LIÊN HỆ</h2>
            <ul>
                <li><span class="dot"></span> Jollibee Việt Nam</li>
                <li><span class="dot"></span> 1900-1533</li>
                <li><span class="dot"></span> Tầng 26, Tòa nhà CII Tower, số 152 Điện Biên Phủ, Phường 25, Quận Bình Thạnh, Thành phố Hồ Chí Minh, Việt Nam</li>
            </ul>
            <h2>Gửi tin nhắn cho chúng tôi</h2>
            <form>
                <label for="name">Tên *</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Thông điệp *</label>
                <textarea id="message" name="message" required></textarea>
                <button>
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                            </svg>
                        </div>
                    </div>
                    <span>Gửi</span>
                </button>

            </form>
        </div>
        <div class="map-section">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2137974496637!2d106.71632941428735!3d10.800411092298176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529a448b474b7%3A0x446d613101e7bf3a!2sCII%20TOWER!5e0!3m2!1svi!2s!4v1614310952123!5m2!1svi!2s"
                width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection