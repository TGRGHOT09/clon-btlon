@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-4">
        <div class="card shadow-lg border-0 bg-dark text-white">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-white rounded-3 p-2 d-inline-block mb-2">
                        <img src="{{ asset('images/onlinejob-logo.png?v=' . time()) }}" alt="" style="height: 48px; width: auto;">
                    </div>
                    <h4 class="fw-bold">HỆ THỐNG QUẢN TRỊ</h4>
                    <p class="small text-muted">Vui lòng xác thực quyền truy cập</p>
                </div>

                <form action="{{ route('login-admin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control bg-secondary text-white border-0 py-3" placeholder="Admin Email" required>
                    </div>

                    <div class="mb-4">
                        <input type="password" name="password" class="form-control bg-secondary text-white border-0 py-3" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 fw-bold">XÁC THỰC NGAY</button>
                </form>
            </div>
        </div>
        <p class="text-center mt-3 small"><a href="{{ route('home') }}" class="text-muted text-decoration-none">← Về trang dành cho khách</a></p>
    </div>
</div>
@endsection