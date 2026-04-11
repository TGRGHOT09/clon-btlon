<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPost;
use App\Models\Application;

class EmployerController extends Controller
{
    /**
     *Trang Dashboard dành cho Nhà tuyển dụng
     * Hiển thị thống kê tổng quan và danh sách việc làm đã đăng
     */
    public function dashboard()
    {
        $user_id = Auth::id();
        
        // Lấy danh sách tin tuyển dụng do chính công ty này đăng
        $my_jobs = JobPost::with('category')
                          ->where('user_id', $user_id)
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        $job_ids = $my_jobs->pluck('id');

        $total_applications = Application::whereIn('job_post_id', $job_ids)->count();
        $applications_pending = Application::whereIn('job_post_id', $job_ids)->where('status', 0)->count();
        $applications_approved = Application::whereIn('job_post_id', $job_ids)->where('status', 1)->count();
        $applications_rejected = Application::whereIn('job_post_id', $job_ids)->where('status', 2)->count();

        $recent_applications = Application::with(['user', 'jobPost'])
            ->whereIn('job_post_id', $job_ids)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('employer.dashboard', compact(
            'my_jobs',
            'total_applications',
            'applications_pending',
            'applications_approved',
            'applications_rejected',
            'recent_applications'
        ));
    }

    /**
     *Danh sách Ứng viên đã nộp CV
     */
    public function applicants()
    {
        $user_id = Auth::id();
        
        // Tìm ID các bài đăng thuộc sở hữu của NTD hiện tại
        $job_ids = JobPost::where('user_id', $user_id)->pluck('id');
        
        // Lấy danh sách đơn ứng tuyển kèm thông tin Ứng viên và Bài đăng tương ứng
        $applications = Application::with(['user.profile', 'jobPost'])
                                   ->whereIn('job_post_id', $job_ids)
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('employer.applicants', compact('applications'));
    }
}