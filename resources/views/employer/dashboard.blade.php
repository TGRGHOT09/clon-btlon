@extends('layouts.app')

@section('content')
<style>
    .employer-shell .card:hover { transform: none; }
    .employer-menu .employer-menu-btn {
        border: none;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        margin-bottom: 0.5rem;
        text-align: left;
        font-weight: 600;
        color: #495057;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        width: 100%;
        transition: background .2s, color .2s, box-shadow .2s;
    }
    .employer-menu .employer-menu-btn:hover { background: #f1f3f5; color: #0d6efd; }
    .employer-menu .employer-menu-btn.active {
        background: #e7f1ff;
        color: #0d6efd;
        box-shadow: 0 2px 8px rgba(13,110,253,0.15);
    }
    .employer-center {
        min-height: 420px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .employer-panel { display: none; }
    .employer-panel.is-visible { display: block; }
</style>

<div class="employer-shell">
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-dark">Chào mừng quay trở lại!</h2>
            <p class="text-muted">Theo dõi và quản lý các hoạt động tuyển dụng của bạn tại đây.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('employer.job.create') }}" class="btn btn-success btn-lg shadow-sm">Đăng tin mới</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <nav class="employer-menu">
                <button type="button" class="employer-menu-btn active" data-employer-panel="jobs">Quản lý tin đăng</button>
                <button type="button" class="employer-menu-btn" data-employer-panel="applications">Tổng đơn ứng viên nộp</button>
                <button type="button" class="employer-menu-btn" data-employer-panel="stats">Thống kê ứng viên nộp</button>
            </nav>
        </div>
        <div class="col-lg-9">
            <div class="employer-center p-4 p-md-5">
                <div id="employer-panel-jobs" class="employer-panel is-visible">
                    <h4 class="fw-bold text-dark mb-4">Quản lý tin đăng</h4>
                    <div class="table-responsive border rounded-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Tiêu đề công việc</th>
                                    <th>Ngành nghề</th>
                                    <th>Lương</th>
                                    <th class="text-end pe-3">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($my_jobs as $job)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $job->title }}</td>
                                    <td><span class="badge bg-light text-primary border">{{ $job->category->name }}</span></td>
                                    <td class="text-success fw-bold">{{ $job->salary }}</td>
                                    <td class="text-end pe-3">
                                        <a href="{{ route('employer.job.edit', $job->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4">Chưa có tin đăng nào.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.employer-menu-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.employer-panel').forEach(p => p.classList.remove('is-visible'));
            document.getElementById('employer-panel-' + this.dataset.employerPanel).classList.add('is-visible');
            document.querySelectorAll('.employer-menu-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
@endsection