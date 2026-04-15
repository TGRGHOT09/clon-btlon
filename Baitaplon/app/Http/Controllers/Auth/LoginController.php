<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller này xử lý việc xác thực người dùng và điều hướng họ sau khi 
    | đăng nhập thành công. 
    |
    */

    use AuthenticatesUsers;

    /**
     * Đường dẫn mặc định sau khi đăng nhập (nếu không có logic redirectTo)
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Khởi tạo Controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Thêm hàm này vào trong LoginController.php
    public function username()
    {
        return 'email';
    }
    /**
     * Logic điều hướng phân quyền sau khi đăng nhập thành công
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // 1. Nếu là Admin (account_type = 1) -> Về trang quản trị
        if ($user->account_type == 1) {
            return route('admin');
        }

        // 2. Nếu là Người tìm việc (account_type = 2) -> Về trang người tìm việc
        if ($user->account_type == 2) {
            return route('developer');
        }

        // 3. Nếu là Nhà tuyển dụng (account_type = 3) -> Về trang nhà tuyển dụng
        if ($user->account_type == 3) {
            return route('employer');
        }

        // Nếu không khớp các loại trên thì về trang HOME mặc định
        return RouteServiceProvider::HOME;
    }
}