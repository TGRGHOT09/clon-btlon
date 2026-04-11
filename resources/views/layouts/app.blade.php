<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BTL-CD1 — Việc làm</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.1); min-height: 64px; }
        .navbar-brand.navbar-brand-logo { display: flex; align-items: center; padding-top: 0; padding-bottom: 0; height: 100%; }
        .nav-link { font-weight: 500; transition: 0.3s; }
        .card { border: none; border-radius: 12px; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
        .btn-primary { background-color: #0d6efd; border: none; padding: 10px 20px; border-radius: 8px; }
        .footer { background: #212529; color: white; padding: 40px 0; margin-top: 60px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand navbar-brand-logo py-0" href="{{ route('home') }}" title="Trang chủ">
            <span style="font-family: 'Inter', Arial, sans-serif; font-weight: 800; font-size: 2rem; color: #4caf50; letter-spacing: 1px; display: flex; align-items: center;">
                <i class="bi bi-house-door-fill" style="color: #2196f3; font-size: 2.1rem; margin-right: 6px;"></i>
                Online<span style="color: #2196f3;">JOB</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Trang chủ</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Tìm việc</a></li>
                    <li class="nav-item"><a class="nav-link px-3 text-warning" href="{{ route('show-login-emp') }}">Tuyển dụng</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-outline-light btn-sm px-4" href="{{ route('login') }}">Đăng nhập</a></li>
                @else
                    @if(Auth::user()->account_type == 1)
                        <li class="nav-item"><a class="nav-link text-info" href="{{ route('admin') }}">Admin</a></li>
                    @elseif(Auth::user()->account_type == 3)
                        <li class="nav-item"><a class="nav-link text-success" href="{{ route('empl') }}">Quản lý tin</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('recruitment-list') }}">Việc đã nộp</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('show-account') }}">Hồ sơ của tôi</a></li>
                    @endif
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-primary text-white btn-sm px-3" href="#" role="button" data-bs-toggle="dropdown">Chào, {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="dropdown-item text-danger">Đăng xuất</button></form></li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="py-4" style="min-height: 80vh;">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="footer">
    <div class="container text-center">
        <p class="small text-muted mb-0">BTL-CD1 — Dự án Online JOB</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>