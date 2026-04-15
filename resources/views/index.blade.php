<?php

use Illuminate\Support\Facades\Route;

// Trỏ đúng Namespace cho các Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Candidate\ApplicationController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckEmployer;

/*
|--------------------------------------------------------------------------
| WEB ROUTES - Online JOB
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. CỤM PUBLIC (DÀNH CHO KHÁCH XEM - KHÔNG CẦN ĐĂNG NHẬP)
// =========================================================================
Route::get('/', [JobPostController::class, 'index'])->name('home');
Route::get('/chi-tiet-viec-lam/{id}', [JobPostController::class, 'show'])->name('show-post-info');

// Điều hướng mặc định
Route::get('/home', function () {
    return redirect()->route('home');
});


// =========================================================================
// 2. CỤM AUTH (ĐĂNG NHẬP / ĐĂNG KÝ)
// =========================================================================

// --- Cho Ứng viên ---
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');

// --- Cho Nhà tuyển dụng ---
Route::prefix('employer')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginEmployer'])->name('show-login-emp');
    Route::get('register', [AuthController::class, 'showRegisterEmployer'])->name('show-register-emp');
    Route::post('login', [AuthController::class, 'login'])->name('login-emp');
    Route::post('register', [AuthController::class, 'register'])->name('register-emp');
});

// --- Cho Quản trị viên ---
Route::prefix('adm')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginAdmin'])->name('show-login-admin');
    Route::post('login', [AuthController::class, 'login'])->name('login-admin');
});


// =========================================================================
// 3. CỤM CANDIDATE (ỨNG VIÊN) - Chỉ yêu cầu đăng nhập chung (auth)
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
// 4. CỤM EMPLOYER (NHÀ TUYỂN DỤNG) - Khóa bằng CheckEmployer
// =========================================================================
Route::prefix('employer')->middleware(['auth', CheckEmployer::class])->group(function () {
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
// 5. CỤM ADMIN (QUẢN TRỊ VIÊN) - Khóa bằng CheckAdmin
// =========================================================================
Route::prefix('adm')->middleware(['auth', CheckAdmin::class])->group(function () {
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