@extends('layouts.admin')

@section('admin_content')
<div class="tab-content" id="adminPanels">
    {{-- Tài khoản người tìm việc --}}
    <div class="tab-pane fade show active" id="panel-seekers" role="tabpanel">
        <div class="admin-main-card p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4">Tài khoản người tìm việc</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle admin-table mb-0">
                    <thead class="border-bottom">
                        <tr>
                            <th class="ps-0">STT</th>
                            <th>Họ tên</th>
                            <th>Địa chỉ email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-0">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobSeekers as $i => $user)
                        <tr>
                            <td class="ps-0 text-muted">{{ $i + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ optional($user->profile)->phone ?? '—' }}</td>
                            <td>
                                <form action="{{ route('update-status', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" {{ $user->status == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                    </div>
                                </form>
                            </td>
                            <td class="text-end pe-0">
                                <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-primary btn-sm px-3 rounded-pill">Chi tiết</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">Chưa có tài khoản người tìm việc.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Tài khoản nhà tuyển dụng --}}
    <div class="tab-pane fade" id="panel-employers" role="tabpanel">
        <div class="admin-main-card p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4">Tài khoản nhà tuyển dụng</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle admin-table mb-0">
                    <thead class="border-bottom">
                        <tr>
                            <th class="ps-0">STT</th>
                            <th>Tên công ty</th>
                            <th>Địa chỉ email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-0">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employers as $i => $user)
                        <tr>
                            <td class="ps-0 text-muted">{{ $i + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ optional($user->profile)->phone ?? '—' }}</td>
                            <td>
                                <form action="{{ route('update-status', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" {{ $user->status == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                    </div>
                                </form>
                            </td>
                            <td class="text-end pe-0">
                                <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-primary btn-sm px-3 rounded-pill">Chi tiết</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">Chưa có tài khoản nhà tuyển dụng.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Ngành nghề --}}
    <div class="tab-pane fade" id="panel-categories" role="tabpanel">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="admin-main-card p-4 sticky-top" style="top: 88px;">
                    <h5 class="fw-bold mb-4">Thêm ngành nghề mới</h5>
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên ngành</label>
                            <input type="text" name="name" class="form-control" placeholder="VD: Công nghệ thông tin" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Lưu ngành nghề</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="admin-main-card p-0 overflow-hidden">
                    <div class="p-4 border-bottom">
                        <h5 class="fw-bold mb-0">Danh sách ngành nghề</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 admin-table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Tên ngành</th>
                                    <th>Mô tả</th>
                                    <th class="text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $cat->name }}</td>
                                    <td class="small text-muted">{{ Str::limit($cat->description, 50) }}</td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 border-0" onclick="return confirm('Xóa ngành nghề này?')">
                                                <i class="bi bi-trash3 fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.admin-sidebar [data-bs-toggle="tab"]').forEach(function (btn) {
        btn.addEventListener('shown.bs.tab', function () {
            document.querySelectorAll('.admin-sidebar .nav-link').forEach(function (l) { l.classList.remove('active'); });
            btn.classList.add('active');
        });
    });
});
</script>
@endpush
@endsection
