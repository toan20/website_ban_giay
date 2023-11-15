<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            foreach($menuCon as $key => $value_con){
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


    public function viewsanpham($id)

    {
        $sql = "SELECT *, (`don_gia_ban` - `don_gia_khuyen_mai`) / `don_gia_ban` * 100 AS `TYLE` FROM `san_phams` ORDER BY TYLE DESC";
        $allSanPham = DB::select($sql);
        $allSanPham = SanPham::where ('is_open',1)->get();

        while(strpos($id,'post')){
            $viTri = strpos($id,'post');
            $id= Str::substr($id,$viTri+4);
        }
        $sanPham = SanPham::find($id);
        if($sanPham){
        return view('trangchu.viewsanpham',compact('sanPham','allSanPham'));

        }else{
            // return redirect('/');
        }
    }

    public function viewDanhmuc($id){
        while(strpos($id,'post')){
            $viTri = strpos($id,'post');
            $id= Str::substr($id,$viTri+4);
        }
        $danhMuc =DanhMuc::find($id);
        if($danhMuc){
        if($danhMuc->id_danh_muc_cha>0){
            $sanPham=SanPham::where('is_open',1)
                            ->where ('danh_muc_id',$danhMuc->id)
                            ->get();

        }else{
            $danhMucCon=DanhMuc::where('id_danh_muc_cha',$danhMuc->id)
                                ->get();
            $danhSach = $danhMuc->id;
            foreach($danhMucCon as $key=>$value){
                $danhSach =$danhSach . ',' . $value->id;
            }
            $sanPham =SanPham::whereIn('danh_muc_id',explode(",",$danhSach))->get();
        }
        return view('trangchu.list.listsanpham',compact('sanPham'));
    }
}
}
