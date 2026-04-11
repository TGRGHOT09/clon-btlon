@extends('layouts.app')

@section('content')
<div class="bg-primary text-white py-5 mb-5 rounded-3 shadow-sm mx-3 mt-3">
    <div class="container text-center py-4">
        <h1 class="display-5 fw-bold mb-3">Tìm Kiếm Công Việc Ước Mơ Của Bạn</h1>
        <p class="lead mb-4">Hàng ngàn cơ hội việc làm IT đang chờ đón bạn tại hệ thống OnlineJOB.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="#" onsubmit="event.preventDefault(); alert('Chức năng Lọc và Tìm kiếm sẽ được demo vào tiến độ tiếp theo!');" class="d-flex bg-white p-2 rounded-pill shadow">
                    <input type="text" class="form-control border-0 rounded-pill ps-4" placeholder="Nhập tên công việc, kỹ năng..." style="box-shadow: none;">
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">Tìm Việc Ngay</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark"><i class="bi bi-briefcase text-primary me-2"></i>Việc Làm Tuyển Dụng Gấp</h3>
        <a href="#" class="text-decoration-none">Xem tất cả <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row">
        @if(isset($job_posts) && $job_posts->count() > 0)
            @foreach($job_posts as $job)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 job-card transition">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="fw-bold text-primary mb-0">{{ $job->title ?? 'Chưa có tiêu đề' }}</h5>
                            <span class="badge bg-danger rounded-pill px-3 py-2">HOT</span>
                        </div>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-building me-1"></i> {{ $job->user->name ?? 'Công ty Ẩn danh' }} | 
                            <i class="bi bi-geo-alt me-1"></i> Hà Nội
                        </p>
                        
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-light text-dark border"><i class="bi bi-cash-coin text-success"></i> Thỏa thuận</span>
                            <span class="badge bg-light text-dark border"><i class="bi bi-tag text-info"></i> {{ $job->category->name ?? 'Lập trình' }}</span>
                        </div>
                        
                        <a href="{{ route('show-post-info', ['id' => $job->id ?? 1]) }}" class="btn btn-outline-primary w-100 fw-bold">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary mb-2">Lập Trình Viên Web (Laravel/VueJS)</h5>
                        <p class="text-muted small mb-3"><i class="bi bi-building me-1"></i> Công ty TNHH J-One | <i class="bi bi-geo-alt me-1"></i> Hà Nội</p>
                        <a href="#" class="btn btn-outline-primary w-100 fw-bold">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary mb-2">Kỹ Sư Cầu Nối (BrSE) - Tiếng Nhật N2</h5>
                        <p class="text-muted small mb-3"><i class="bi bi-building me-1"></i> Tập Đoàn ABC | <i class="bi bi-geo-alt me-1"></i> Đà Nẵng</p>
                        <a href="#" class="btn btn-outline-primary w-100 fw-bold">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection