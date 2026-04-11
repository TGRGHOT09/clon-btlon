@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Danh sách Ứng viên nộp đơn</h3>
    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tên ứng viên</th>
                        <th>Vị trí ứng tuyển</th>
                        <th>Ngày nộp</th>
                        <th>Hồ sơ CV</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="fw-bold">Nguyễn Văn Vũ</div>
                            <small class="text-muted">vu.nguyen@email.com</small>
                        </td>
                        <td>Lập trình viên Laravel</td>
                        <td>Hôm nay</td>
                        <td>
                            <a href="#" onclick="alert('Đang tải file PDF... Chức năng xem CV thực tế sẽ demo tuần sau.'); return false;" class="text-danger fw-bold text-decoration-none">
                                <i class="bi bi-file-earmark-pdf"></i> Xem CV
                            </a>
                        </td>
                        <td><span class="badge bg-warning text-dark">Chờ duyệt</span></td>
                        <td>
                            <button onclick="alert('Đã ghi nhận hành động: CHẤP NHẬN ứng viên. (Database sẽ update ở tuần sau)')" class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                            <button onclick="alert('Đã ghi nhận hành động: TỪ CHỐI ứng viên.')" class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('empl') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Về trang Quản lý</a>
    </div>
</div>
@endsection