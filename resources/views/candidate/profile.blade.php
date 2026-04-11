@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                <img src="https://via.placeholder.com/150" class="rounded-circle mx-auto mb-3" alt="Avatar" style="width: 120px; height: 120px; object-fit: cover;">
                <h5 class="fw-bold text-primary">Ứng viên Thúy</h5>
                <p class="text-muted">Quản lý Dự án / QA Tester</p>
                <button onclick="alert('Tính năng Upload ảnh đại diện sẽ hoạt động khi đấu nối CSDL vào tuần sau!')" class="btn btn-sm btn-outline-primary mt-2">Đổi ảnh đại diện</button>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold text-primary py-3">
                    <i class="bi bi-person-lines-fill me-2"></i> Thông tin cá nhân & Hồ sơ (CV)
                </div>
                <div class="card-body">
                    <form action="#" onsubmit="event.preventDefault(); alert('Đã giả lập thao tác: Lưu hồ sơ thành công! Dữ liệu sẽ chính thức được ghi nhận vào bảng Profiles ở tiến độ tuần tới.');">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ và Tên</label>
                                <input type="text" class="form-control" value="Trần Thị Thúy" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" class="form-control" value="0987654321">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kỹ năng chuyên môn nổi bật</label>
                            <input type="text" class="form-control" value="Software Testing, Quản lý dự án Agile, Giao tiếp">
                        </div>

                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-dark"><i class="bi bi-cloud-upload me-1"></i> Tải lên CV (Hồ sơ năng lực)</label>
                            <input type="file" class="form-control border-primary">
                            <small class="text-muted d-block mt-1">Hỗ trợ định dạng .pdf, .doc, .docx (Tối đa 5MB).</small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">Lưu cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection