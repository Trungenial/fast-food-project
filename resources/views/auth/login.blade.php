@extends("layouts.main")
<style>
    #login-popup {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #login-container {
        background-color: #dc2626;
        padding: 20px;
        width: 600px;
        height: 700px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.4s ease-out;
    }

    .close {
        position: absolute;
        top: 2px;
        right: 15px;
        font-size: 30px;
        cursor: pointer;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }


    #login-header {
        justify-content: center;
        justify-items: center;
    }

    #logo-header {
        width: 150px;
        height: auto;
        margin-bottom: 10px;
    }

    #title-header span {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: xx-large;
        font-weight: bolder;
        text-transform: uppercase;
        color: white;
    }

    .form-fields {
        justify-items: center;
        justify-self: center;
        width: 500;
        height: auto;
    }

    .form-group input {
        width: 450px;
        height: 60px;
        border-radius: 10px;
    }

    .form-actions {
        background-color: #facc15;
    }

    #login-submit button {
        width: 180px;
        height: 60px;
        background-color: #facc15;
        color: #dc2626;
        font-size: larger;
    }

    #forgot-password-link {
        margin-left: 300px;
        color: whitesmoke;
        text-decoration: underline;
    }

    #register-link {
        text-align: left;
        margin-left: 60px;
        margin-top: 30px;
        color: white;
    }

    #register-link a {
        text-decoration: underline;
        font-weight: bolder;
        font-size: large;
    }
</style>
@section('title','Đăng nhập')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<x-guest-layout>
    <button id="open-login-popup">ĐĂNG NHẬP</button>
    <div id='login-popup'>
        <div id='login-container'>
            <div id="login-header">
                <div id="logo-header">
                    <img src='{{asset("images/logo-nobg.png")}}'>
                </div>
                <div id="title-header">
                    <span>VUI LÒNG ĐĂNG NHẬP</span>
                </div>

            </div>
            <span class="close  mt-4" id="login-closepopup">&times;</span>
            <div class="login-body">
                <form class='login-form-wrapper' method="POST" action='{{ route("login") }}'>
                    @csrf
                    <fieldset class='form-fields'>
                        <div id="email" class="form-group mt-4">
                            <x-text-input id='customer-email' name='email'
                                class='block mt-1 w-full' type='email' :value="old('email')"
                                required autocomplete='email' placeholder='Email' />
                            <x-input-error :messages="$errors->get('email')" class='mt-2' />
                        </div>

                        <div id="password" class="form-group mt-4">
                            <x-text-input id='customer-password' name='password'
                                class='block mt-1 w-full' type='password'
                                required autocomplete='current-password' placeholder='Mật khẩu' />
                            <x-input-error :messages="$errors->get('password')" class='mt-2' />
                        </div>

                        <div id="forgot-password-link" class="form-group mt-4">
                            <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Quên mật khẩu?') }}
                            </a>
                        </div>
                    </fieldset>

                    <div id="form-actions" class="mt-4 text-red-600">
                        <div id="login-submit" class="flex justify-center">
                            <x-primary-button class="ms-4">
                                {{ __('Đăng nhập') }}
                            </x-primary-button>
                        </div>
                        <div id="register-link" class="mt-2 text-center">
                            Bạn chưa có tài khoản?
                            <a class="underline text-sm text-blue-600 hover:text-gray-900" href="{{ route('register') }}">
                                {{ __('Đăng ký ngay!') }}
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("open-login-popup").onclick = function() {
            document.getElementById("login-popup").style.display = "block";
        };
        document.getElementById("login-closepopup").onclick = function() {
            document.getElementById("login-popup").style.display = "none";
        };
        // Đóng pop-up nếu click ra ngoài nội dung chính
        window.onclick = function(event) {
            if (event.target == document.getElementById("login-popup")) {
                document.getElementById("login-popup").style.display = "none";
            }
        };
    </script>
</x-guest-layout>
@endsection