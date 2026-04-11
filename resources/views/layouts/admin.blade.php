<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - OnlineJOB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #212529; color: white; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 15px; display: block; border-radius: 5px; }
        .sidebar a:hover, .sidebar a.active { background-color: #343a40; color: #fff; }
        .card { border: none; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar py-3">
                <h4 class="text-center text-primary fw-bold mb-4">ADMIN PANEL</h4>
                <ul class="nav flex-column gap-2 px-2">
                    <li class="nav-item">
                        <a href="{{ route('admin') }}" class="active"><i class="bi bi-speedometer2 me-2"></i> Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a href="#"><i class="bi bi-people me-2"></i> Quản lý Tài khoản</a>
                    </li>
                    <li class="nav-item">
                        <a href="#"><i class="bi bi-tags me-2"></i> Quản lý Danh mục</a>
                    </li>
                    <li class="nav-item mt-4">
                        <a href="{{ route('home') }}" class="text-info"><i class="bi bi-box-arrow-left me-2"></i> Về trang chủ</a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3">Hệ thống Quản trị</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-person"></i> Xin chào, Admin
                        </button>
                    </div>
                </div>
                
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>