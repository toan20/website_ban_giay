<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_phams';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'slug_san_pham',
        'is_open',
        'don_gia_ban',
        'don_gia_khuyen_mai',
        'danh_muc_id',
        'hinh_anh',
        'mo_ta_ngan',
        'mo_ta_chi_tiet',
        'so_luong',
    ];
}
