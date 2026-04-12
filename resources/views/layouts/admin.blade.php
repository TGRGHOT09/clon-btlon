@extends('layouts.app')

@section('content')
<style>
    .admin-shell { min-height: calc(80vh - 2rem); }
    .admin-sidebar {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        padding: 1.25rem 0;
    }
    .admin-sidebar .nav-link {
        color: #495057;
        border-radius: 8px;
        margin: 0 0.75rem 0.25rem;
        padding: 0.6rem 1rem;
        font-weight: 500;
    }
    .admin-sidebar .nav-link:hover { background: #f1f3f5; color: #0d6efd; }
    .admin-sidebar .nav-link.active { background: #e7f1ff; color: #0d6efd; }
    .admin-sidebar .section-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; color: #868e96; padding: 0.5rem 1.25rem 0.35rem; font-weight: 600; }
    .admin-main-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .admin-table thead th { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.04em; color: #6c757d; font-weight: 600; }
</style>
<div class="row admin-shell g-4">
    <aside class="col-lg-3 col-xl-2">
        <nav class="admin-sidebar sticky-top" style="top: 88px;">
            <div class="px-3 pb-2 mb-2 border-bottom">
                <div class="fw-bold text-dark">Bảng điều khiển Quản trị</div>
                <div class="mt-2"><img src="{{ asset('images/onlinejob-logo.png?v=' . time()) }}" alt="" style="height:28px;width:auto;"></div>
            </div>
            <div class="section-label">Quản lý tài khoản</div>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <button type="button" class="nav-link text-start w-100 border-0 bg-transparent active" id="nav-seekers" data-bs-toggle="tab" data-bs-target="#panel-seekers" role="tab">
                        Người tìm việc
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link text-start w-100 border-0 bg-transparent" id="nav-employers" data-bs-toggle="tab" data-bs-target="#panel-employers" role="tab">
                        Nhà tuyển dụng
                    </button>
                </li>
            </ul>
            <div class="section-label">Danh mục</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <button type="button" class="nav-link text-start w-100 border-0 bg-transparent" id="nav-categories" data-bs-toggle="tab" data-bs-target="#panel-categories" role="tab">
                        Ngành nghề
                    </button>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="col-lg-9 col-xl-10">
        @yield('admin_content')
    </div>
</div>
@endsection
