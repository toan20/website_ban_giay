<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonNhapKho extends Model
{
    use HasFactory;
    protected $fillable = [
        'ma_don_hang',
        'hash',
        'tong_tien',
        'tong_san_pham',
        'tinh_trang',
        'hinh_thuc_thanh_toan',
        'minh_chung',
    ];
}
