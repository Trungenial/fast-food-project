@extends('layouts.main')

@section('title', 'Thông tin tài khoản')

@section('css')
<style>
    body {
        background-color: #f9f5f2;
    }

    .form-container {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        margin: 40px auto;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .form-title {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        color: #d61c1c;
    }

    .btn-danger {
        background-color: #d61c1c;
        border: none;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h3 class="form-title">THÔNG TIN TÀI KHOẢN</h3>

    <form method="POST" action="{{ route('saveinfo') }}">
        @csrf

        <!-- Họ và tên -->
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <!-- Số điện thoại -->
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
        </div>

        <!-- Giới tính -->
        <div class="mb-3">
            <label for="gender" class="form-label">Giới tính</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ $user->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <!-- Ngày sinh -->
        <div class="mb-3">
            <label for="birthday" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" name="birthday" id="birthday"
                value="{{ old('birthday', $user->birthday) }}">
        </div>


        <!-- Tỉnh -->
        <div class="mb-3">
            <label for="province" class="form-label">Tỉnh/Thành phố</label>
            <select name="province" id="province" class="form-control" required>
                <option value="">-- Chọn Tỉnh --</option>
                @foreach($provinces as $province)
                <option value="{{ $province->code }}" {{ $user->province == $province->name ? 'selected' : '' }}>
                    {{ $province->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Huyện -->
        <div class="mb-3">
            <label for="district" class="form-label">Quận/Huyện</label>
            <select name="district" id="district" class="form-control" required>
                <option value="">-- Chọn Huyện --</option>
                @foreach($districts as $district)
                <option value="{{ $district->code }}" {{ $user->district == $district->name ? 'selected' : '' }}>
                    {{ $district->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Phường -->
        <div class="mb-3">
            <label for="ward" class="form-label">Phường/Xã</label>
            <select name="ward" id="ward" class="form-control" required>
                <option value="">-- Chọn Phường --</option>
                @foreach($wards as $ward)
                <option value="{{ $ward->code }}" {{ $user->ward == $ward->name ? 'selected' : '' }}>
                    {{ $ward->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Địa chỉ -->
        <div class="mb-4">
            <label for="address" class="form-label">Địa chỉ cụ thể (số nhà, đường...)</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $user->address) }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger px-4">Lưu</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const province = document.getElementById('province');
        const district = document.getElementById('district');
        const ward = document.getElementById('ward');

        province.addEventListener('change', function() {
            const code = this.value;
            district.innerHTML = '<option value="">-- Chọn Huyện --</option>';
            ward.innerHTML = '<option value="">-- Chọn Phường --</option>';

            if (code) {
                fetch(`/get-districts/${code}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(d => {
                            district.innerHTML += `<option value="${d.code}">${d.name}</option>`;
                        });
                    });
            }
        });

        district.addEventListener('change', function() {
            const code = this.value;
            ward.innerHTML = '<option value="">-- Chọn Phường --</option>';

            if (code) {
                fetch(`/get-wards/${code}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(w => {
                            ward.innerHTML += `<option value="${w.code}">${w.name}</option>`;
                        });
                    });
            }
        });
    });
</script>
@endpush