@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold">Khu vực Nhà tuyển dụng</h3>
            <p class="text-muted">Quản lý tin đăng và hồ sơ ứng viên của công ty bạn.</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('employer.job.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Đăng tin mới
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center bg-primary text-white p-3 shadow-sm">
                <h5>Tổng tin đã đăng</h5>
                <h2 class="fw-bold">12</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-success text-white p-3 shadow-sm">
                <h5>Hồ sơ chờ duyệt</h5>
                <h2 class="fw-bold">5</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-warning text-dark p-3 shadow-sm">
                <h5>Lượt xem tin</h5>
                <h2 class="fw-bold">340</h2>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
            Tin tuyển dụng gần đây
            <a href="{{ route('show-candidate') }}" class="btn btn-sm btn-outline-info">Xem tất cả ứng viên</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tiêu đề công việc</th>
                        <th>Ngày đăng</th>
                        <th>Lượt ứng tuyển</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">Lập trình viên Laravel (Middle)</td>
                        <td>10/04/2026</td>
                        <td><span class="badge bg-danger rounded-pill">3 ứng viên</span></td>
                        <td><span class="badge bg-success">Đang mở</span></td>
                        <td>
                            <button onclick="alert('Demo báo cáo: Chức năng Sửa đang bảo trì!')" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            <button onclick="alert('Demo báo cáo: Không thể xóa tin lúc này!')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Thực tập sinh Flutter</td>
                        <td>08/04/2026</td>
                        <td><span class="badge bg-secondary rounded-pill">0 ứng viên</span></td>
                        <td><span class="badge bg-warning text-dark">Sắp hết hạn</span></td>
                        <td>
                            <button onclick="alert('Demo báo cáo: Chức năng Sửa đang bảo trì!')" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            <button onclick="alert('Demo báo cáo: Không thể xóa tin lúc này!')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection