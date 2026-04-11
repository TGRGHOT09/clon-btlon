<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Candidate\ApplicationController;

// --- 1. CỤM PUBLIC (DÀNH CHO KHÁCH XEM) ---
Route::get('/', [JobPostController::class, 'index'])->name('home');
Route::get('/chi-tiet-viec-lam/{id}', [JobPostController::class, 'show'])->name('show-post-info');
Route::get('/home', function () { return redirect()->route('home'); });

// --- 2. CỤM AUTH (ĐĂNG NHẬP / ĐĂNG KÝ) ---
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');

// Cho Nhà tuyển dụng
Route::prefix('employer')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginEmployer'])->name('show-login-emp');
    Route::post('login', [AuthController::class, 'login'])->name('login-emp');
});

// Cho Admin
Route::prefix('adm')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginAdmin'])->name('show-login-admin');
    Route::post('login', [AuthController::class, 'login'])->name('login-admin');
});

// --- 3. CỤM CANDIDATE (ỨNG VIÊN - MIDDLEWARE: auth) ---
Route::middleware(['auth'])->group(function () {
    Route::get('tai-khoan', [CandidateController::class, 'profile'])->name('show-account');
    Route::put('tai-khoan/cap-nhat', [CandidateController::class, 'updateProfile'])->name('account');
    Route::get('viec-da-ung-tuyen', [CandidateController::class, 'appliedJobs'])->name('recruitment-list');
    Route::post('nop-don/{job_post_id}', [ApplicationController::class, 'apply'])->name('apply');
});

// --- 4. CỤM EMPLOYER (NHÀ TUYỂN DỤNG - MIDDLEWARE: empl) ---
Route::prefix('employer')->middleware(['auth', 'empl'])->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('empl');
    Route::resource('job', JobPostController::class, ['as' => 'employer']);
    Route::get('/danh-sach-ung-vien', [EmployerController::class, 'applicants'])->name('show-candidate');
    Route::post('/duyet-ho-so/{id}', [ApplicationController::class, 'updateStatus'])->name('update-status-candidate');
});

// --- 5. CỤM ADMIN (QUẢN TRỊ VIÊN - MIDDLEWARE: admin) ---
Route::prefix('adm')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/user/{id}/chi-tiet', [AdminController::class, 'userDetail'])->name('admin.user.detail');
    Route::post('/user/status/{id}', [AdminController::class, 'toggleUserStatus'])->name('update-status');
    Route::resource('category', AdminController::class, ['as' => 'admin']);
});