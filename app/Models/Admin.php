<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable = [
        'ho_lot',
        'ten',
        'email',
        'password',
        'so_dien_thoai',
        'gioi_tinh',
        'is_master',
        'id_rule',
        'is_block',
    ];
}
