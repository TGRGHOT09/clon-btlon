<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'user_id',
        'job_post_id',
        'status', // 0: Chờ duyệt, 1: Đã duyệt, 2: Từ chối
        'applied_date',
    ];

    // Đơn ứng tuyển thuộc về 1 Ứng viên (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Đơn ứng tuyển thuộc về 1 Bài đăng (JobPost)
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}