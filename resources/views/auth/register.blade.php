@extends('layouts.main')

@section('title', 'Đăng ký tài khoản')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 shadow rounded">
            <h2 class="text-center mb-4 text-danger fw-semibold">ĐĂNG KÝ TÀI KHOẢN</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Họ và tên -->
                <div class="mb-3">
                    <x-input-label for="name" :value="'Họ và tên'" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <x-input-label for="phone" :value="'Số điện thoại'" />
                    <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 text-danger" />
                </div>

                <!-- Giới tính -->
                <div class="mb-3">
                    <label for="gender">Giới tính</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="">-- Chọn giới tính --</option>
                        <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-1 text-danger" />
                </div>

                <!-- Ngày sinh -->
                <div class="mb-3">
                    <x-input-label for="birthday" :value="'Ngày sinh'" />
                    <x-text-input id="birthday" class="form-control" type="date" name="birthday"
                        :value="old('birthday')" required />
                    <x-input-error :messages="$errors->get('birthday')" class="mt-1 text-danger" />
                </div>



                <!-- Tỉnh -->
                <div class="mb-3">
                    <label for="province">Tỉnh/Thành phố</label>
                    <select name="province_code" id="province" class="form-control" required>
                        <option value="">-- Chọn Tỉnh --</option>
                        @foreach(DB::table('provinces')->get() as $province)
                        <option value="{{ $province->code }}" {{ old('province_code') == $province->code ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('province_code')" class="mt-1 text-danger" />
                </div>

                <!-- Huyện -->
                <div class="mb-3">
                    <label for="district">Quận/Huyện</label>
                    <select name="district_code" id="district" class="form-control" required>
                        <option value="">-- Chọn Huyện --</option>
                    </select>
                    <x-input-error :messages="$errors->get('district_code')" class="mt-1 text-danger" />
                </div>

                <!-- Phường -->
                <div class="mb-3">
                    <label for="ward">Phường/Xã</label>
                    <select name="ward_code" id="ward" class="form-control" required>
                        <option value="">-- Chọn Phường --</option>
                    </select>
                    <x-input-error :messages="$errors->get('ward_code')" class="mt-1 text-danger" />
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <x-input-label for="address" :value="'Địa chỉ cụ thể (số nhà, đường...)'" />
                    <x-text-input id="address" class="form-control" type="text" name="address" :value="old('address')" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-1 text-danger" />
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <x-input-label for="password" :value="'Mật khẩu'" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                </div>

                <!-- Xác nhận mật khẩu -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="'Xác nhận mật khẩu'" />
                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger" />
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a class="text-sm text-primary" href="{{ route('login') }}">
                        Đã có tài khoản? Đăng nhập
                    </a>
                    <x-primary-button class="btn btn-danger">
                        {{ __('Đăng ký') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        // Khi chọn tỉnh
        provinceSelect.addEventListener('change', function() {
            const provinceCode = this.value;
            districtSelect.innerHTML = '<option value="">-- Chọn Huyện --</option>';
            wardSelect.innerHTML = '<option value="">-- Chọn Phường --</option>';

            if (provinceCode) {
                fetch(`/get-districts/${provinceCode}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(d => {
                            const option = document.createElement('option');
                            option.value = d.code;
                            option.textContent = d.name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Lỗi load huyện:', err));
            }
        });

        // Khi chọn huyện
        districtSelect.addEventListener('change', function() {
            const districtCode = this.value;
            wardSelect.innerHTML = '<option value="">-- Chọn Phường --</option>';

            if (districtCode) {
                fetch(`/get-wards/${districtCode}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(w => {
                            const option = document.createElement('option');
                            option.value = w.code;
                            option.textContent = w.name;
                            wardSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Lỗi load phường:', err));
            }
        });
    });
</script>
@endpush