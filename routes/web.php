<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Candidate\ApplicationController;

// =========================================================================
// 1. CỤM PUBLIC (DÀNH CHO KHÁCH XEM)
// =========================================================================
Route::get('/', [JobPostController::class, 'index'])->name('home');
Route::get('/chi-tiet-viec-lam/{id}', [JobPostController::class, 'show'])->name('show-post-info');

Route::get('/home', function () {
    return redirect()->route('home');
});

// =========================================================================
// 2. CỤM AUTH (ĐĂNG NHẬP / ĐĂNG KÝ MỞ GIAO DIỆN)
// =========================================================================
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
// Đổi logout thành GET để dễ dàng click thoát ra ngoài lúc báo cáo
Route::get('logout', [AuthController::class, 'logout'])->name('logout'); 

Route::prefix('employer')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginEmployer'])->name('show-login-emp');
    Route::get('register', [AuthController::class, 'showRegister'])->name('show-register-emp');
});

Route::prefix('adm')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginAdmin'])->name('show-login-admin');
});

// =========================================================================
// 3. CỤM CANDIDATE (ỨNG VIÊN - ĐÃ ĐĂNG NHẬP)
// =========================================================================
Route::middleware(['auth'])->group(function () {
    Route::get('tai-khoan', [CandidateController::class, 'profile'])->name('show-account');
    Route::get('viec-da-ung-tuyen', [CandidateController::class, 'appliedJobs'])->name('recruitment-list');
    
});

// =========================================================================
// 4. CỤM EMPLOYER (NHÀ TUYỂN DỤNG)
// =========================================================================
Route::prefix('employer')->middleware(['auth', 'empl'])->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('empl');
    Route::get('/post/create', [JobPostController::class, 'create'])->name('employer.job.create');
    Route::get('/post/{id}/edit', [JobPostController::class, 'edit'])->name('employer.job.edit');
    Route::get('/danh-sach-ung-vien', [EmployerController::class, 'applicants'])->name('show-candidate');

});

// =========================================================================
// 5. CỤM ADMIN (QUẢN TRỊ VIÊN)
// =========================================================================
Route::prefix('adm')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/user/{id}/chi-tiet', [AdminController::class, 'userDetail'])->name('admin.user.detail');
    
});