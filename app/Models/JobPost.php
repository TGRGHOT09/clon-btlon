<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_posts';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'salary',
        'expire_date',
        'status',
    ];

    // Bài đăng thuộc về 1 Nhà tuyển dụng (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Bài đăng thuộc về 1 Ngành nghề (Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 1 Bài đăng yêu cầu nhiều Kỹ năng (Skill) - Quan hệ N-N qua bảng phụ job_post_skill
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_post_skill', 'job_post_id', 'skill_id');
    }

    // 1 Bài đăng có nhiều Đơn ứng tuyển (Application)
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}