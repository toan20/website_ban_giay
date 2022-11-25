<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrangChuController extends Controller
{
    public function index()
    {

        $menuCha = DanhMuc::where('id_danh_muc_cha',0)
                            ->where ('is_open',1)
                            ->get();
        $menuCon = DanhMuc::where('id_danh_muc_cha','<>',0)
                            ->where ('is_open',1)
                            ->get();

        $config  = Config::latest()->first();

        foreach($menuCha as $key => $value_cha){
            $value_cha->tmp = $value_cha->id;
            foreach($menuCha as $key => $value_con){
                if($value_con->id_danh_muc_cha == $value_cha->id){
                    $value_cha->tmp = $value_cha->tmp . ',' . $value_con->id;
                }
            }
        }

        $sql = "SELECT *, (`don_gia_ban` - `don_gia_khuyen_mai`) / `don_gia_ban` * 100 AS `TYLE` FROM `san_phams` ORDER BY TYLE DESC";
        $allSanPham = DB::select($sql);
        $allSanPham = SanPham::where ('is_open',1)->get();
        return view('master',compact('menuCha','menuCon','config','allSanPham'));
        // dd( $allSanPham->toArray());
    }
}
