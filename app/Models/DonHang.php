<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hangs';

    protected $fillable = [
        'ma_don_hang',
        'tong_tien',
        'tien_giam_gia',
        'thuc_tra',
        'agent_id',
        'loai_thanh_toan',
        'ten_nguoi_nhan',
        'sdt_nguoi_nhan',
        'email_nguoi_nhan',
        'dia_chi_nguoi_nhan',
        'phi_van_chuyen',
        'tinh_trang',
    ];
}
