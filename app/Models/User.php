<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các cột được phép thêm dữ liệu
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type', // 1: Admin, 2: Ứng viên, 3: NTD
        'status',
    ];

    /**
     * Các cột bị ẩn đi khi truy vấn (Bảo mật)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ==========================================
    // KHAI BÁO CÁC MỐI QUAN HỆ (RELATIONSHIPS)
    // ==========================================

    // 1 User (Ứng viên) 
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // 1 User (Nhà tuyển dụng) có nhiều Bài đăng (1-N)
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    // 1 User (Ứng viên) có nhiều Đơn ứng tuyển (1-N)
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}