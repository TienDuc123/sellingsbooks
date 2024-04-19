<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable =[
        'Ten',
        'DiaChi',
        'Email',
        'SoDienThoai',
        'ghi_chu',
        'created_at',
        'updated_at',
    ];

    public function book()
    {
        return $this->belongsToMany(Book::class, 'orders', 'ID_Kh', 'ID_Sach');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_Kh', 'id');
    }

}
