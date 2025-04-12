<style>

    #register-header{
        text-align: center;
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: xx-large;
        font-weight: bolder;
        text-transform: uppercase;
        color: #dc2626;
    }
</style>
@extends("layouts.main")
@section('title','Đăng ký tài khoản')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<x-guest-layout>
    <div id="register-container">
        <div id="register-header">
            <span>
                ĐĂNG KÝ TÀI KHOẢN
            <span>
        </div>
        <div class="register-body">
            <form class="register-form-wrapper" method="POST" action="{{ route('register') }}">
            @csrf
                <fieldset class="form-fields" >
                    <div name="lastname" class="form-group mt-4">
                        <x-text-input id="customer-lastname"  name="customer-lastname" 
                        class="block mt-1 w-full" type="text"
                        :value="old('name')" 
                        required autofocus autocomplete="name" 
                        placeholder="Họ *" />
                
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div name="firstname"class="form-group mt-4">
                        <x-text-input id="customer-firstname" name="customer-firstname"
                        class="block mt-1 w-full" type="text"
                        :value="old('name')" 
                        required autofocus autocomplete="firstname" 
                        placeholder="Tên *"/>
                
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div name="phone-number" class="form-group mt-4">
                        <x-text-input id="customer-phone-number" name="customer-phone-number" 
                        class="block mt-1 w-full" type="text"  
                        :value="old('name')" 
                        required autofocus autocomplete="phonenumber" placeholder="Số điện thoại *"/>
                
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div name="email" class="form-group mt-4">
                        <x-text-input id="customer-email" name="customer-email"
                        class="block mt-1 w-full" type="email"
                        :value="old('email')" 
                        required autocomplete="email" placeholder="Email *"/>
                
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div name="password" class="form-group mt-4">
                        <x-text-input id="customer-password" name="customer-password"
                        class="block mt-1 w-full" type="password"
                        required autocomplete="password" 
                        placeholder="Mật khẩu *"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div name="comfirmation-password" class="form-group mt-4">
                        <x-text-input id="customer-comfirmation-password"  name="customer-comfirmation-password"
                        class="block mt-1 w-full" type="password"
                        required autocomplete="new-password" 
                        placeholder="Nhập lại mật khẩu *"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div name="customer-birthdate" class="form-group mt-4">
                        <x-text-input id="birthdate" class="block mt-1 w-full"
                        type="text"
                        name="birthdate" 
                        required />
                        <script>
                            flatpickr("#birthdate", {
                            dateFormat: "d/m/Y",
                            maxDate: "today",
                            altInput: true,
                            altFormat: "d/m/Y",
                            onReady: function(selectedDates, dateStr, instance) {
                            instance.altInput.placeholder = "Chọn ngày sinh *";},
                            onOpen: function(selectedDates, dateStr, instance) {
                                if (!dateStr) {
                                instance.altInput.placeholder = "Chọn ngày sinh *"; }
                                }
                                });
                            </script>

                         <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />

                    </div>
                    <div name="customer-gender" class="form-group mt-4">
                        <div class="">
                            <select id="customer-gender" name="customer-gender" title="Giới tính"
                            class="validate select block mt-1 w-full
                                    w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center 
                                    justify-between hover:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <option value disabled selected  class="dark: text-gray-300">Chọn giới tính *</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                            </select>
                        </div>
                    </div>

                    <div name="customer-gender" class="form-group mt-4">
                        <div class="">
                            <select id="customer-gender" name="customer-gender" title="Giới tính"
                            class="validate select block mt-1 w-full
                                    w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center 
                                    justify-between hover:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                    data-validate="required:true"
                                aria-required="true">
                                    <option value disabled selected class="dark: text-gray-300">Chọn tỉnh thành *</option>
                                    <option value="1">TP Hồ Chí Minh</option>
                                    <option value="2">Hà Nội</option>
                                    <option value="3">Đà Nẵng</option>
                                    <option value="4">An Giang</option>
                                    <option value="5">Bà Rịa Vũng Tàu</option>
                                    <option value="6">Bạc Liêu</option>
                                    <option value="7">Bắc Giang</option>
                                    <option value="8">Bắc Kạn</option>
                                    <option value="9">Bắc Ninh</option>
                                    <option value="10">Bến Tre</option>
                                    <option value="11">Bình Dương</option>
                                    <option value="12">Bình Định</option>
                                    <option value="13">Bình Phước</option>
                                    <option value="14">Bình Thuận</option>
                                    <option value="15">Cà Mau</option>
                                    <option value="16">Cao Bằng</option>
                                    <option value="17">Cần Thơ</option>
                                    <option value="18">Đắk Lắk</option>
                                    <option value="19">Đắk Nông</option>
                                    <option value="20">Điện Biên</option>
                                    <option value="21">Đồng Nai</option>
                                    <option value="22">Đồng Tháp</option>
                                    <option value="23">Gia Lai</option>
                                    <option value="24">Hà Giang</option>
                                    <option value="25">Hà Nam</option>
                                    <option value="26">Hà Tĩnh</option>
                                    <option value="27">Hải Dương</option>
                                    <option value="28">Hải Phòng</option>
                                    <option value="29">Hậu Giang</option>
                                    <option value="30">Hòa Bình</option>
                                    <option value="31">Hưng Yên</option>
                                    <option value="32">Khánh Hòa</option>
                                    <option value="33">Kiên Giang</option>
                                    <option value="34">Kon Tum</option>
                                    <option value="35">Lai Châu</option>
                                    <option value="36">Lạng Sơn</option>
                                    <option value="37">Lào Cai</option>
                                    <option value="38">Lâm Đồng</option>
                                    <option value="39">Long An</option>
                                    <option value="40">Nam Định</option>
                                    <option value="41">Nghệ An</option>
                                    <option value="42">Ninh Bình</option>
                                    <option value="43">Ninh Thuận</option>
                                    <option value="44">Phú Thọ</option>
                                    <option value="45">Phú Yên</option>
                                    <option value="46">Quảng Bình</option>
                                    <option value="47">Quảng Nam</option>
                                    <option value="48">Quảng Ngãi</option>
                                    <option value="49">Quảng Ninh</option>
                                    <option value="50">Quảng Trị</option>
                                    <option value="51">Sóc Trăng</option>
                                    <option value="52">Sơn La</option>
                                    <option value="53">Tây Ninh</option>
                                    <option value="54">Thái Bình</option>
                                    <option value="55">Thái Nguyên</option>
                                    <option value="56">Thanh Hóa</option>
                                    <option value="57">Huế</option>
                                    <option value="58">Tiền Giang</option>
                                    <option value="59">Trà Vinh</option>
                                    <option value="60">Tuyên Quang</option>
                                    <option value="61">Vĩnh Long</option>
                                    <option value="62">Vĩnh Phúc</option>
                                    <option value="63">Yên Bái</option>
                            
                            </select>
                        </div>
                    </div>

                    <div name="policy-agreement" class="form-group mt-4">
                        <x-text-input id="agree-checkbox"
                            type="checkbox"
                            name="agree-checkbox"
                            required />
                
                            Đồng ý với
                            <a href="{{ url('/policy') }}" target="_blank" class="text-blue-600 underline">
                            Chính sách, quy định chung và Thông báo bảo mật cá nhân
                            </a>
                        <x-input-error  :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div name="discount-choice" class="mt-4">
                        <x-text-input id="discount-checkbox"
                            type="checkbox"
                            name="discount-checkbox"
                            required />
                        
                            <label>Nhận chương trình khuyến mãi qua email</label>
                        <x-input-error  :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </fieldset>
                <div name="form-actions" class="mt-4 text-red-600">
                    <div name="register-submit" class="flex justify-center">
                        <x-primary-button class="ms-4 bg-red-600  items-center">
                            {{ __('Đăng ký') }}
                        </x-primary-button>
                    </div>
                    <div name="form-login-link">
                    Bạn đã có tài khoản?<a class="underline text-sm text-blue-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Đăng nhập') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
@endsection






























<!-- <div class="province-selector rounded-md dark:focus:border-indigo-600">
                        <x-dropdown  class="block mt-1 w-full" value="Chọn tỉnh thành">
                            <x-slot name="trigger">
                                <button type="button" class="px-4 py-2 bg-gray-200 rounded w-full text-left justify-start">
                                    <span x-text="selectedProvince || 'Chọn tỉnh thành *'"></span>
                                </button>
                            </x-slot>
                            @php
                                $provinces=['TP Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng',
                                'An Giang', 'Bà Rịa Vũng Tàu', 'Bạc Liêu', 'Bắc Giang', 'Bắc Kạn',
                                'Bắc Ninh', 'Bến Tre', 'Bình Dương', 'Bình Định', 'Bình Phước', 'Bình Thuận', 
                                'Cà Mau', 'Cao Bằng', 'Cần Thơ', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên',
                                'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Tĩnh', 'Hải Dương',
                                'Hải Phòng', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang',
                                'Kon Tum', 'Lai Châu', 'Lạng Sơn','Lào Cai', 'Lâm Đồng', 'Long An', 'Nam Định',
                                'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Phú Yên', 'Quảng Bình',
                                'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 
                                'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thành phố Huế', 'Tiền Giang',
                                'Trà Vinh', 'Tuyên Quang', 'Vĩnh Long','Vĩnh Phúc', 'Yên Bái'];
                            @endphp
                                <div style="max-height: 800px; overflow-y: auto;">
                                @foreach ($provinces as $province)
                                        <div class="px-4 py-2"
                                            @click="selectedProvince='{{$province}}'; open=false">
                                            {{$province}}
                                        </div>
                                @endforeach
                                </div>
                        </x-dropdown>
                        <input name="province" x-model="selectedProvince" class="block mt-1 w-full" value="Chọn tỉnh thành *">
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div> -->
                    <!-- <div class="w-full mt-4" x-data="{ selectedProvince: '' }">
                        <x-dropdown align="left" width="full">
                            <x-slot name="trigger">
                                <button 
                                    type="button" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center 
                                    justify-between hover:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <span x-text="selectedProvince || 'Chọn tỉnh thành'"></span>
                                    <svg class="w-4 h-4 text-gray-500 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            @php
                                $provinces = ['TP Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'An Giang', 'Bà rịa Vũng Tàu', 'Bạc Liêu', 
                                'Bắc Giang', 'Bắc Kạn', 'Bắc Ninh', 'Bến Tre', 'Bình Dương', 'Bình Định', 'Bình Phước', 
                                'Bình Thuận', 'Cà Mau', 'Cao Bằng', 'Cần Thơ', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên', 'Đồng Nai', 
                                'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Tĩnh', 'Hải Dương', 'Hải Phòng', 'Hậu Giang', 
                                'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lạng Sơn','Lào Cai', 
                                'Lâm Đồng', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Phú Yên', 
                                'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 
                                'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thành phố Huế', 'Tiền Giang', 'Trà Vinh', 
                                'Tuyên Quang', 'Vĩnh Long','Vĩnh Phúc', 'Yên Bái'];
                            @endphp

                            <div class="max-h-64 overflow-y-auto">
                            @foreach ($provinces as $province)
                                <div class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                                    @click="selectedProvince = '{{ $province }}'">
                                    {{ $province }}
                                </div>
                            @endforeach
                            </div>
                        </x-dropdown>

                        <input type="hidden" name="province" 
                            x-model="selectedProvince" 
                            class="block mt-3 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" 
                            placeholder="Chọn tỉnh thành *"
                            readonly />
                    
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div> -->



        <!-- Name -->
        <!-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> -->

        <!-- Email Address -->
        <!-- <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

        <!-- Password -->
        <!-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> -->

        <!-- Confirm Password -->
        <!-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> -->