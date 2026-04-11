@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white text-primary fw-bold">
                    <i class="bi bi-file-earmark-plus"></i> Tạo tin tuyển dụng mới
                </div>
                <div class="card-body">
                    <form action="#" onsubmit="event.preventDefault(); alert('Giao diện Form đã hoàn thiện! Nút Lưu dữ liệu vào Database sẽ được đấu nối và demo vào tiến độ Tuần sau.');">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề công việc <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="VD: Lập trình viên PHP/Laravel" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ngành nghề</label>
                                <select class="form-select">
                                    <option>IT - Phần mềm</option>
                                    <option>Marketing - PR</option>
                                    <option>Quản trị kinh doanh</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Mức lương</label>
                                <input type="text" class="form-control" placeholder="VD: 10 - 15 Triệu">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả công việc</label>
                            <textarea class="form-control" rows="4" placeholder="Nhập chi tiết yêu cầu công việc..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('empl') }}" class="btn btn-light border">Quay lại</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">Đăng tin ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection