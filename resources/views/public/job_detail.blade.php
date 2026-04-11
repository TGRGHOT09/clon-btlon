@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm p-4 mb-4">
            <h2 class="fw-bold text-dark">{{ $job_post->title }}</h2>
            <p class="text-primary fw-bold mb-4">{{ $job_post->user->name }}</p>
            <hr>
            <h5 class="fw-bold mb-3">Mô tả công việc</h5>
            <div class="lh-lg text-secondary mb-4" style="white-space: pre-line;">{{ $job_post->description }}</div>
            <h5 class="fw-bold mb-3">Kỹ năng yêu cầu</h5>
            <div>
                @foreach($job_post->skills as $skill)
                    <span class="badge bg-light text-dark border p-2 px-3 me-2">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4 p-4">
            <h5 class="fw-bold mb-4">Thông tin tuyển dụng</h5>
            <p class="mb-2">Mức lương: <span class="fw-bold text-success">{{ $job_post->salary }}</span></p>
            <p class="mb-4">Hạn nộp: <span class="fw-bold text-danger">{{ date('d/m/Y', strtotime($job_post->expire_date)) }}</span></p>
            
            @auth
                @if(Auth::user()->account_type == 2)
                    <form action="{{ route('apply', $job_post->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-lg w-100 fw-bold">ỨNG TUYỂN NGAY</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-warning btn-lg w-100 fw-bold">ĐĂNG NHẬP ĐỂ ỨNG TUYỂN</a>
            @endauth
        </div>
    </div>
</div>
@endsection