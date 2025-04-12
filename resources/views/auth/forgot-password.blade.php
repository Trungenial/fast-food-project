<style> 
    *{
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    #forgot-password-title span{
        font-size: xx-large;
        font-weight: bolder;
        text-transform: uppercase;
        color: #dc2626;
    }

    #forgot-password-title h3{
        color: #dc2626;
    }
</style>
@extends("layouts.main")
@section('title','Lấy lại mật khẩu')
@section('content')
<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div id="forgot-password-container" >
        <div id='forgot-password-title'>
            <span>LẤY LẠI MẬT KHẨU</span>
            <h3>Bạn vui lòng nhập địa chỉ email đã đăng ký để nhận lại mật khẩu qua email</h3>
        </div>
        <div id='forgot-password-form'>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div name="email" class="form-group mt-4"> 
                    <x-text-input id='customer-email' name='customer-email'
                    class='block mt-1 w-full' type='email' :value="old('email')"
                    required autocomplete='email' placeholder='Email'></x-text-input>

                    <x-input-error :messages="$errors->get('email')" class='mt-2'></x-input-error>
                </div>

                <div class="flex items-center justify-center mt-4 mb-4">
                    <x-primary-button class='bg-red-600'>
                        {{ __('Nhận lại mật khẩu') }}
                    </x-primary-button>
                </div>
                <div name="form-login-link">
                    Bạn đã có tài khoản?<a class="underline text-sm text-blue-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Đăng nhập') }}
                    </a>
                </div>
            </form>
        </div>  
    </div>
</x-guest-layout>
@endsection

