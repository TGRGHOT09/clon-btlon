<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\JobPost;

class ApplicationController extends Controller
{
    /**
     * Xử lý hành động Ứng tuyển ngay (Dành cho Ứng viên)
     */
    public function apply(Request $request, $job_post_id)
    {
        $user = Auth::user();
        $user->loadMissing('profile');

        // 1. Kiểm tra xem ứng viên đã cập nhật CV chưa
        if (!$user->profile || empty($user->profile->cv_link)) {
            return back()->with('error', 'Vui lòng cập nhật file CV trong trang Hồ sơ trước khi ứng tuyển!');
        }

        // 2. Kiểm tra xem ứng viên đã nộp đơn vào công việc này trước đó chưa
        $is_applied = Application::where('user_id', $user->id)
                                 ->where('job_post_id', $job_post_id)
                                 ->exists();

        if ($is_applied) {
            return back()->with('error', 'Bạn đã nộp đơn cho công việc này rồi. Vui lòng chờ phản hồi!');
        }

        // 3. Tạo mới đơn ứng tuyển
        Application::create([
            'user_id'      => $user->id,
            'job_post_id'  => $job_post_id,
            'status'       => 0, // 0: Chờ duyệt, 1: Đã duyệt, 2: Từ chối
            'applied_date' => now(),
        ]);

        return back()->with('success', 'Ứng tuyển thành công! Bạn có thể theo dõi trạng thái ở mục Việc đã ứng tuyển.');
    }

    /**
     * Xử lý thay đổi trạng thái đơn hàng (Dành cho Nhà tuyển dụng & Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2' // Chỉ chấp nhận giá trị 1 (Duyệt) hoặc 2 (Từ chối)
        ]);

        $application = Application::findOrFail($id);
        
        // Cập nhật trạng thái mới
        $application->status = $request->status;
        $application->save();

        $message = ($request->status == 1) ? 'Đã duyệt hồ sơ ứng viên thành công.' : 'Đã từ chối đơn ứng tuyển này.';
        
        return back()->with('success', $message);
    }
}