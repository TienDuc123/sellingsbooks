<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable =[
        'ID_Sach',
        'ID_Kh',
        'SoLuong',
        'Gia',
        'trang_thai',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_Kh', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'ID_Sach', 'id');
    }
}
