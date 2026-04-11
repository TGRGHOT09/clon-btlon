@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Lịch sử Ứng tuyển</h3>
    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table align-middle mb-0 table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Vị trí công việc</th>
                        <th>Công ty tuyển dụng</th>
                        <th>Thời gian nộp</th>
                        <th>Trạng thái hồ sơ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold text-primary">Chuyên viên Kiểm thử phần mềm (Tester)</td>
                        <td>Tập đoàn Công nghệ J-One</td>
                        <td>Hôm nay</td>
                        <td><span class="badge bg-warning text-dark px-2 py-1"><i class="bi bi-hourglass-split"></i> Đang chờ duyệt</span></td>
                        <td>
                            <button onclick="alert('Đã khóa tính năng Hủy ứng tuyển để bảo vệ dữ liệu lúc demo!')" class="btn btn-sm btn-outline-danger">Rút hồ sơ</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-primary">Trợ lý Quản lý Dự án IT</td>
                        <td>Công ty Phần mềm ABC</td>
                        <td>08/04/2026</td>
                        <td><span class="badge bg-success px-2 py-1"><i class="bi bi-telephone"></i> Đã liên hệ phỏng vấn</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary" disabled>Rút hồ sơ</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('show-account') }}" class="btn btn-outline-primary"><i class="bi bi-person"></i> Về trang Hồ sơ</a>
    </div>
</div>
@endsection