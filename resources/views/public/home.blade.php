@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-md-12 text-center py-5 bg-white rounded-4 shadow-sm border-0">
        <img src="{{ asset('images/onlinejob-logo.png?v=' . time()) }}" alt="" class="mb-3" style="height: 64px; width: auto;">
        <h1 class="display-5 fw-bold text-dark mb-2">Tìm Kiếm Cơ Hội Nghề Nghiệp</h1>
        <p class="fw-semibold text-primary mb-2">BTL-CD1</p>
        <p class="lead text-muted mb-4">Kết nối ứng viên và nhà tuyển dụng</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-primary"></i></span>
                    <input type="text" class="form-control border-0" placeholder="Tên công việc, vị trí bạn mong muốn...">
                    <button class="btn btn-primary px-5 fw-bold" type="button">Tìm ngay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-briefcase-fill text-primary me-2"></i>Việc làm mới nhất
        </h4>
        <span class="text-muted">Tổng cộng: <strong>{{ count($job_posts) }}</strong> tin tuyển dụng</span>
    </div>
    
    @forelse($job_posts as $post)
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm border-0 p-3 job-item">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto d-none d-md-block">
                            <div class="bg-primary-subtle rounded-3 p-3 text-primary d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-building fs-1"></i>
                            </div>
                        </div>
                        
                        <div class="col ms-md-3">
                            <h5 class="fw-bold mb-1">
                                <a href="{{ route('show-post-info', $post->id) }}" class="text-decoration-none text-dark hover-primary">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="mb-2">
                                <span class="text-primary fw-semibold"><i class="bi bi-building-check me-1"></i>{{ $post->user->name }}</span>
                                <span class="text-muted ms-3"><i class="bi bi-geo-alt me-1"></i>Hà Nội</span>
                            </p>
                            
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2">
                                    <i class="bi bi-tag me-1"></i>{{ $post->category->name }}
                                </span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                    <i class="bi bi-cash-stack me-1"></i>{{ $post->salary }}
                                </span>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                    <i class="bi bi-clock me-1"></i>Hạn nộp: {{ date('d/m/2026', strtotime($post->expire_date)) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-auto text-end mt-3 mt-md-0">
                            <a href="{{ route('show-post-info', $post->id) }}" class="btn btn-primary px-4 rounded-pill fw-bold">
                                Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="bi bi-inbox text-muted display-1"></i>
            </div>
            <h5 class="text-muted">Hiện chưa có tin tuyển dụng nào phù hợp.</h5>
            <p class="text-muted">Hãy quay lại sau hoặc thử tìm kiếm với từ khóa khác.</p>
        </div>
    @endforelse
</div>

<style>
    .job-item {
        transition: all 0.3s ease;
    }
    .job-item:hover {
        transform: scale(1.01);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-left: 5px solid #0d6efd !important;
    }
    .hover-primary:hover {
        color: #0d6efd !important;
    }
</style>
@endsection