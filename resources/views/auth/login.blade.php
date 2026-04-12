@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="card shadow border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="d-inline-block bg-light rounded-3 p-2 shadow-sm mb-3">
                        <img src="{{ asset('images/onlinejob-logo.png?v=' . time()) }}" alt="" style="height: 56px; width: auto;">
                    </div>
                    <h3 class="fw-bold">Ứng Viên Đăng Nhập</h3>
                    <p class="text-muted">Chào mừng bạn quay trở lại</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email của bạn</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control border-start-0 ps-0 bg-light" placeholder="email@vi-du.com" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control border-start-0 ps-0 bg-light" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-4 small">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                        </div>
                        <a href="#" class="text-primary text-decoration-none">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm">ĐĂNG NHẬP NGAY</button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0">Chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Đăng ký thành viên</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection