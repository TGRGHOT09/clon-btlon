<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Cần dùng Controller gốc
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    // Trang Dashboard tổng của Admin
    public function dashboard() {
        $jobSeekers = User::where('account_type', 2)
            ->with('profile')
            ->orderByDesc('created_at')
            ->get();
        $employers = User::where('account_type', 3)
            ->with('profile')
            ->orderByDesc('created_at')
            ->get();
        $categories = Category::all();

        return view('admin.dashboard', compact('jobSeekers', 'employers', 'categories'));
    }

    public function userDetail($id)
    {
        $user = User::with(['profile', 'jobPosts' => function ($q) {
            $q->orderByDesc('created_at');
        }])->findOrFail($id);

        if ((int) $user->account_type === 1) {
            abort(403);
        }

        return view('admin.user_detail', compact('user'));
    }

    // Khóa/Mở khóa tài khoản người dùng
    public function toggleUserStatus($id) {
        $user = User::findOrFail($id);
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // --- QUẢN LÝ DANH MỤC (CATEGORY) ---

    public function storeCategory(Request $request) {
        $request->validate(['name' => 'required|unique:categories,name']);
        Category::create($request->all());
        return back()->with('success', 'Thêm ngành nghề thành công!');
    }

    public function updateCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return back()->with('success', 'Cập nhật ngành nghề thành công!');
    }

    public function destroyCategory($id) {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa ngành nghề!');
    }
}