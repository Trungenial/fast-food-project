@extends('layouts.main')

@section('title', 'Đăng nhập tài khoản')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 shadow rounded">
            <h2 class="text-center mb-4 text-danger">Đăng nhập tài khoản</h2>

            <x-auth-session-status class="mb-3 text-success" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
                </div>

                <!-- Ghi nhớ -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                    <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                </div>

                <!-- Nút đăng nhập -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-primary text-decoration-underline">Quên mật khẩu?</a>
                    @endif

                    <button type="submit" class="btn btn-danger">Đăng nhập</button>
                </div>

                <div class="mt-4 text-center text-sm">
                    Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary text-decoration-underline">Đăng ký</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
