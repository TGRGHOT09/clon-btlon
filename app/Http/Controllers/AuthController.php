<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- HIỂN THỊ GIAO DIỆN LOGIN RIÊNG BIỆT ---
    
    public function showLogin() {
        return view('auth.login'); // Giao diện cho Ứng viên
    }

    public function showLoginEmployer() {
        return view('employer.login'); // Giao diện cho Nhà tuyển dụng
    }

    public function showLoginAdmin() {
        return view('admin.login'); // Giao diện cho Admin
    }

    // --- XỬ LÝ LOGIC ĐĂNG NHẬP CHUNG ---

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản (nếu bị Admin khóa thì không cho vào)
            if ($user->status == 0) {
                Auth::logout();
                return back()->with('error', 'Tài khoản của bạn đã bị khóa bởi quản trị viên!');
            }

            // Phân luồng chuyển hướng sau khi đăng nhập thành công
            if ($user->account_type == 1) return redirect()->route('admin');
            if ($user->account_type == 3) return redirect()->route('empl');
            return redirect()->route('home');
        }

        return back()->with('error', 'Email hoặc mật khẩu không chính xác!');
    }

    // --- ĐĂNG KÝ VÀ ĐĂNG XUẤT ---

    public function showRegister() {
        return view('auth.register');
    }

    public function showRegisterEmployer() {
        return view('employer.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'account_type' => 'required|in:2,3' 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'status' => 1
        ]);

        // Nếu là Ứng viên, tạo luôn Profile rỗng để tránh lỗi null
        if ($user->account_type == 2) {
            Profile::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        return ($user->account_type == 3) ? redirect()->route('empl') : redirect()->route('home');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}