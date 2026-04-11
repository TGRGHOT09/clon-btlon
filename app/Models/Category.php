<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    // 1 Ngành nghề (Category) có nhiều Bài đăng (JobPost) - Quan hệ 1-N
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}