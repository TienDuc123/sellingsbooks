<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable =[
        'TenSach',
        'TacGia',
        'MoTa',
        'Gia',
        'SoLuongTrongKho',
        'URL',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_Sach', 'id');
    }
}
