<?php

use Illuminate\Support\Facades\Route;

// Trỏ đúng Namespace cho các Controller trong thư mục con
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Candidate\ApplicationController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES - Online JOB
|--------------------------------------------------------------------------
|Chức năng: Phân quyền Admin, Nhà tuyển dụng, Ứng viên
*/

// =========================================================================
// 1. CỤM PUBLIC (DÀNH CHO KHÁCH XEM)
// =========================================================================
Route::get('/', [JobPostController::class, 'index'])->name('home');
Route::get('/chi-tiet-viec-lam/{id}', [JobPostController::class, 'show'])->name('show-post-info');

// Điều hướng mặc định của Laravel về trang chủ
Route::get('/home', function () {
    return redirect()->route('home');
});


// =========================================================================
// 2. CỤM AUTH (ĐĂNG NHẬP / ĐĂNG KÝ RIÊNG BIỆT)
// =========================================================================

// --- Cho Ứng viên ---
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');

// --- Cho Nhà tuyển dụng (Prefix: employer) ---
Route::prefix('employer')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginEmployer'])->name('show-login-emp');
    Route::get('register', [AuthController::class, 'showRegister'])->name('show-register-emp');
    // Lưu ý: Các xử lý POST dùng chung logic trong AuthController
    Route::post('login', [AuthController::class, 'login'])->name('login-emp');
    Route::post('register', [AuthController::class, 'register'])->name('register-emp');
});

// --- Cho Quản trị viên (Prefix: adm) ---
Route::prefix('adm')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginAdmin'])->name('show-login-admin');
    Route::post('login', [AuthController::class, 'login'])->name('login-admin');
});


// =========================================================================
// 3. CỤM CANDIDATE (ỨNG VIÊN - ĐÃ ĐĂNG NHẬP)
// =========================================================================
Route::middleware(['auth'])->group(function () {
    // Quản lý hồ sơ & CV
    Route::get('tai-khoan', [CandidateController::class, 'profile'])->name('show-account');
    Route::put('tai-khoan/cap-nhat', [CandidateController::class, 'updateProfile'])->name('account');
    
    // Quản lý việc làm
    Route::get('viec-da-ung-tuyen', [CandidateController::class, 'appliedJobs'])->name('recruitment-list');
    Route::post('nop-don/{job_post_id}', [ApplicationController::class, 'apply'])->name('apply');
});


// =========================================================================
// 4. CỤM EMPLOYER (NHÀ TUYỂN DỤNG - MIDDLEWARE: empl)
// =========================================================================
Route::prefix('employer')->middleware(['auth', 'empl'])->group(function () {
    // Dashboard & Thống kê
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('empl');

    // Quản lý Tin tuyển dụng (CRUD)
    Route::get('/post/create', [JobPostController::class, 'create'])->name('employer.job.create');
    Route::post('/post/store', [JobPostController::class, 'store'])->name('employer.job.store');
    Route::get('/post/{id}/edit', [JobPostController::class, 'edit'])->name('employer.job.edit');
    Route::put('/post/{id}', [JobPostController::class, 'update'])->name('employer.job.update');
    Route::delete('/post/{id}', [JobPostController::class, 'destroy'])->name('employer.job.destroy');

    // Quản lý Ứng viên & Duyệt hồ sơ
    Route::get('/danh-sach-ung-vien', [EmployerController::class, 'applicants'])->name('show-candidate');
    Route::post('/duyet-ho-so/{id}', [ApplicationController::class, 'updateStatus'])->name('update-status-candidate');
});


// =========================================================================
// 5. CỤM ADMIN (QUẢN TRỊ VIÊN - MIDDLEWARE: admin)
// =========================================================================
Route::prefix('adm')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard quản trị tổng thể
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin');

    Route::get('/user/{id}/chi-tiet', [AdminController::class, 'userDetail'])->name('admin.user.detail');
    
    // Quản lý trạng thái User (Khóa/Mở)
    Route::post('/user/status/{id}', [AdminController::class, 'toggleUserStatus'])->name('update-status');
    
    // Quản lý Danh mục (Category)
    Route::post('/category/store', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::put('/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/category/delete/{id}', [AdminController::class, 'destroyCategory'])->name('admin.category.destroy');
});