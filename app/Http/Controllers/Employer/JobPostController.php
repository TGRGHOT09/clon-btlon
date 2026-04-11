<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPost;
use App\Models\Category;
use App\Models\Skill;

class JobPostController extends Controller
{
    // ==========================================
    // PHẦN PUBLIC (Dành cho Ứng viên & Khách)
    // ==========================================

    // [Giao diện 3] Hiển thị danh sách việc làm trang chủ
    public function index()
    {
        $job_posts = JobPost::with('category', 'user')
                            ->where('status', 1) // Chỉ hiện tin đang hoạt động
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return view('public.home', compact('job_posts'));
    }

    // [Giao diện 4] Chi tiết một công việc cụ thể
    public function show($id)
    {
        $job_post = JobPost::with(['category', 'user', 'skills'])->findOrFail($id);
        return view('public.job_detail', compact('job_post'));
    }


    // ==========================================
    // PHẦN QUẢN LÝ (Dành cho Nhà Tuyển Dụng)
    // ==========================================

    // [Giao diện 7] Form tạo tin tuyển dụng
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $skills = Skill::all();
        return view('employer.job_form', compact('categories', 'skills'));
    }

    // Lưu bài đăng mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'salary' => 'required|string',
            'expire_date' => 'required|date',
            'skills' => 'required|array'
        ]);

        $job_post = JobPost::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'expire_date' => $request->expire_date,
            'status' => 1
        ]);

        // Lưu kỹ năng vào bảng trung gian N-N
        $job_post->skills()->attach($request->skills);

        return redirect()->route('empl')->with('success', 'Đăng tin thành công!');
    }

    // [Giao diện 7] Form chỉnh sửa tin (Dùng chung View)
    public function edit($id)
    {
        $job_post = JobPost::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        $skills = Skill::all();
        
        return view('employer.job_form', compact('job_post', 'categories', 'skills'));
    }

    // Cập nhật thông tin bài đăng
    public function update(Request $request, $id)
    {
        $job_post = JobPost::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'skills' => 'required|array'
        ]);

        $job_post->update($request->except('skills'));
        
        // Đồng bộ lại danh sách kỹ năng
        $job_post->skills()->sync($request->skills);

        return redirect()->route('empl')->with('success', 'Cập nhật tin thành công!');
    }

    // Xóa bài đăng
    public function destroy($id)
    {
        $job_post = JobPost::where('user_id', Auth::id())->findOrFail($id);
        $job_post->delete();

        return redirect()->route('empl')->with('success', 'Đã xóa bài tuyển dụng!');
    }
}