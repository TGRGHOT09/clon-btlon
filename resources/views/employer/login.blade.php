@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="card shadow border-0 border-top border-4 border-success">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="d-inline-block bg-white rounded-3 p-2 shadow-sm mb-3">
                        <img src="{{ asset('images/onlinejob-logo.png?v=' . time()) }}" alt="" style="height: 56px; width: auto;">
                    </div>
                    <h3 class="fw-bold text-success">KÊNH TUYỂN DỤNG</h3>
                    <p class="text-muted">Đăng nhập để quản lý tin đăng và tìm kiếm ứng viên</p>
                </div>

                <form action="{{ route('login-emp') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-success">Email Doanh nghiệp</label>
                        <input type="email" name="email" class="form-control bg-light p-3 border-0" placeholder="hr@ten-cong-ty.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-success">Mật khẩu</label>
                        <input type="password" name="password" class="form-control bg-light p-3 border-0" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-3 fw-bold shadow-sm rounded-3">TRUY CẬP QUẢN TRỊ</button>
                </form>

                <div class="text-center mt-4">
                    <hr class="text-muted opacity-25">
                    <p class="small text-muted">Đối tác mới? <a href="{{ route('show-register-emp') }}" class="text-success fw-bold text-decoration-none">Đăng ký gian hàng tuyển dụng</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection