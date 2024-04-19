<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    // Khai báo mối quan hệ với người dùng (một bài viết thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
