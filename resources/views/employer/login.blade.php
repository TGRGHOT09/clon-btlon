@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="col-md-5">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/onlinejob-logo.png') }}" alt="Logo" height="50" onerror="this.style.display='none'">
                        <h4 class="fw-bold mt-3 text-primary">Đăng Nhập Hệ Thống</h4>
                    </div>
                    
                    <form action="#" onsubmit="event.preventDefault(); alert('Giao diện form đăng nhập hoạt động tốt! Để di chuyển giữa các màn hình trong buổi Demo, hãy sử dụng thanh Menu phía trên nhé.');">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Địa chỉ Email</label>
                            <input type="email" class="form-control form-control-lg bg-light" placeholder="ví dụ: ungvien@gmail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary d-flex justify-content-between">
                                Mật khẩu
                                <a href="#" class="text-decoration-none small" onclick="alert('Chức năng quên mật khẩu chưa kích hoạt.')">Quên mật khẩu?</a>
                            </label>
                            <input type="password" class="form-control form-control-lg bg-light" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">Đăng nhập</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <span class="text-muted">Chưa có tài khoản?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection