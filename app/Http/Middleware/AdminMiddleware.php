<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if(Auth::check()){
            // Nếu đúng là Admin (type = 1) thì cho qua
            if (Auth::user()->account_type == 1){
                return $next($request);
            }
            // Nếu đã đăng nhập nhưng không phải Admin thì đá về trang login với lỗi
            Auth::logout();
            return redirect()->route('show-login-admin')->with('error','Bạn không có quyền truy cập');
        }
        
        // Nếu chưa đăng nhập thì bắt buộc phải về trang login
        return redirect()->route('show-login-admin');
    }
}