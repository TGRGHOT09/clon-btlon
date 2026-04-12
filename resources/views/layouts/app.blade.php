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
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            min-height: 64px;
        }
        /* Logo PNG vuông 320x320: zoom phần giữa để không bị bé trong thanh đen */
        .navbar-brand.navbar-brand-logo {
            display: flex;
            align-items: center;
            padding-top: 0;
            padding-bottom: 0;
            height: 100%;
        }
        .navbar-logo-frame {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 92px;
            height: 64px;
            overflow: hidden;
            padding: 0;
        }
        .navbar-logo-img {
            display: block;
            height: 64px;
            width: 64px;
            object-fit: contain;
            object-position: center;
            transform: scale(5);
            transform-origin: center center;
        }
        .nav-link { font-weight: 500; transition: 0.3s; }
        .card { border: none; border-radius: 12px; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
        .btn-primary { background-color: #0d6efd; border: none; padding: 10px 20px; border-radius: 8px; }
        .footer { background: #212529; color: white; padding: 40px 0; margin-top: 60px; }
        .footer-social a { display: inline-flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 50%; background: rgba(255,255,255,0.1); color: #fff; font-size: 1.15rem; transition: background .2s, transform .2s; }
        .footer-social a:hover { background: rgba(255,255,255,0.22); color: #fff; transform: translateY(-2px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        {{-- Ảnh logo: nên dùng PNG/SVG ~280–320px ngang, nền trong suốt hoặc trắng; hiển thị tối đa cao ~52px trong khung --}}
        <a class="navbar-brand navbar-brand-logo py-0" href="{{ route('home') }}" title="Trang chủ">
            <span style="font-family: 'Inter', Arial, sans-serif; font-weight: 800; font-size: 2rem; color: #4caf50; letter-spacing: 1px; text-shadow: 1px 1px 6px rgba(0,0,0,0.08); display: flex; align-items: center;">
                <i class="bi bi-house-door-fill" style="color: #2196f3; font-size: 2.1rem; vertical-align: middle; margin-right: 6px;"></i>
                Online<span style="color: #2196f3;">JOB</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Trang chủ</a></li>
                
                @guest
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Tìm việc</a></li>
                    <li class="nav-item"><a class="nav-link px-3 text-warning" href="{{ route('show-login-emp') }}">Tuyển dụng</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-4" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
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
                        <a class="nav-link dropdown-toggle btn btn-primary text-white btn-sm px-3" href="#" role="button" data-bs-toggle="dropdown">
                            Chào, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="py-4" style="min-height: 80vh;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<footer class="footer">
    <div class="container text-center">
        <div class="footer-social d-flex justify-content-center gap-3 mb-3">
            <a href="https://www.facebook.com/th.tung0812/" target="_blank" rel="noopener noreferrer" title="Facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://github.com/ttung20044-ctrl/BTL_Online_JOB" target="_blank" rel="noopener noreferrer" title="GitHub" aria-label="GitHub"><i class="bi bi-github"></i></a>
            <a href="https://mail.google.com/mail/u/0/?hl=en#inbox" target="_blank" rel="noopener noreferrer" title="Gmail" aria-label="Gmail"><i class="bi bi-envelope-fill"></i></a>
        </div>
        <p class="small text-muted mb-0">BTL-CD1</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>