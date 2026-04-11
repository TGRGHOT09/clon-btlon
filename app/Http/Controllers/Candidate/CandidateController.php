<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Application;

class CandidateController extends Controller
{
    /**
     * [Giao diện 9] Hiển thị trang Hồ sơ cá nhân
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Lấy Profile của ứng viên hiện tại. Nếu chưa có (trường hợp hi hữu) thì tạo mới.
        $profile = Profile::firstOrCreate(['user_id' => $user->id]);
        
        return view('candidate.profile', compact('user', 'profile'));
    }

    /**
     * Xử lý cập nhật thông tin và Upload file CV
     */
    public function updateProfile(Request $request)
    {
        // Validate dữ liệu đầu vào chỉnh chu
        $request->validate([
            'phone'    => 'nullable|string|max:15',
            'address'  => 'nullable|string|max:255',
            'cv_link'  => 'nullable|mimes:pdf,doc,docx|max:5120', // Giới hạn 5MB
        ], [
            'cv_link.mimes' => 'Hệ thống chỉ chấp nhận file định dạng PDF, DOC hoặc DOCX.',
            'cv_link.max'   => 'Dung lượng file CV không được vượt quá 5MB.'
        ]);

        $user = Auth::user();
        $profile = Profile::firstOrCreate(['user_id' => $user->id]);

        // Cập nhật thông tin cơ bản
        $profile->phone = $request->phone;
        $profile->address = $request->address;

        // Xử lý logic Upload CV (Nếu ứng viên có chọn file mới)
        if ($request->hasFile('cv_link')) {
            $file = $request->file('cv_link');
            
            // Đặt tên file theo thời gian để tránh trùng lặp
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Di chuyển file vào thư mục public/uploads/cv
            $file->move(public_path('uploads/cv'), $filename); 
            
            // Lưu đường dẫn file vào database
            $profile->cv_link = $filename;
        }

        $profile->save();

        return back()->with('success', 'Cập nhật hồ sơ và CV thành công!');
    }

    /**
     *Danh sách các công việc mà ứng viên này đã nộp đơn
     */
    public function appliedJobs()
    {
        $user_id = Auth::id();
        
        // Lấy danh sách đơn ứng tuyển kèm theo thông tin chi tiết bài đăng và danh mục
        $applications = Application::with(['jobPost.category', 'jobPost.user'])
                                   ->where('user_id', $user_id)
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('candidate.applied_jobs', compact('applications'));
    }
}