<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view()
    {
        return view('admin.donhang.index');
    }
    public function index()
    {
        $agent = Auth::guard('agent')->check();
            if($agent){
                $id_agent =  Auth::guard('agent')->id();
                return view('trangchu.cart.giohang',compact('id_agent'));
            }else{
                toastr()->warning('Vui lòng đăng nhập');
                return redirect()->back();
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonHangRequest $request)
    {
        $agent =Auth::guard('agent')->user();
        if($agent){

            $gioHang =ChiTietDonHang::where('is_cart',1)
                                    ->where ('agent_id',$agent->id)
                                    ->get();

            if(empty($gioHang)|| count($gioHang)>0){
                $donHang= DonHang::create([
                    'ma_don_hang'=>rand(11111,99999),
                    'tong_tien' => 0,
                    'tien_giam_gia'=>0,
                    'thuc_tra' =>0,
                    'phi_van_chuyen'=> $request->phi_van_chuyen,
                    'agent_id'=> $agent->id,
                    'loai_thanh_toan'=>$request->loai_thanh_toan,
                    'ten_nguoi_nhan'=>$request->ten_nguoi_nhan,
                    'sdt_nguoi_nhan'=>$request->sdt_nguoi_nhan,
                    'email_nguoi_nhan'=>$request->email_nguoi_nhan,
                    'dia_chi_nguoi_nhan'=>$request->dia_chi_nguoi_nhan,
                ]);

                $thuc_tra =0; $tong_tien=0;$phivanchuyen=0;

                foreach($gioHang as $key => $value){
                    $sanPham =SanPham::find($value->san_pham_id);
                    if($sanPham){
                        $giaBan =$sanPham->don_gia_khuyen_mai ? $sanPham->don_gia_khuyen_mai : $sanPham->don_gia_ban;
                        $thuc_tra +=  $value->so_luong * $giaBan;
                        $tong_tien +=  $value->so_luong * $sanPham->don_gia_ban ;
                        $value->don_gia = $giaBan;
                        // $value->thanh_tien  = $value->don_gia * $value->so_luong;
                        $value->is_cart = 0;
                        $value->don_hang_id = $donHang->id;
                        // if($value->so_luong >1){
                        //     $phivanchuyen = $value->phi_van_chuyen = 0;
                        // } else if ($value->so_luong = 1){
                        //     $value->phi_van_chuyen = $request->phi_van_chuyen;
                        // } else {
                        //     $value->phi_van_chuyen = 0;
                        // }
                        $value->save();
                    }else{
                        $value->delete();
                    }
                }
                $donHang->thuc_tra = $thuc_tra  ;
                $donHang->tong_tien = $tong_tien;
                $donHang->tien_giam_gia= $tong_tien - $thuc_tra;
                $donHang->save();

                // dd('true');
                return response()->json(['status'=>true]);  // thành công
                    $data = $request->all();
                    DonHang::create($data);
            }else{
                return response()->json(['status'=>false]);
            }
            }
        return response()->json(['status'=>0]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function showBill()
    {
        $agent = Auth::guard('agent')->check();
        if($agent){
        $dataBill = DonHang::where('agent_id' , Auth::guard('agent')->id())->get();
        return response()->json([
            'dataBillGate' => $dataBill
        ]);
            }

    }
    public function showdonhang()
    {


        $dataBill = DonHang::all();
        return response()->json([
            'dataBillGate' => $dataBill
        ]);

    }

    public function phivanchuyen($san_pham_id){
        $agent = Auth::guard('agent')->user();
        if($agent) {
            // $sanPham = SanPham::find($san_pham_id);

            $gioHang =ChiTietDonHang::where('is_cart',1)
                                    ->where ('agent_id',$agent->id)
                                    ->get();
            if($gioHang) {
                $gioHang->phi_van_chuyen;
                $gioHang->save();
                return response()->json(['status' => true]);

            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function showBillchitiet($id)
    {
        while(strpos($id,'post')){
            $viTri = strpos($id,'post');
            $id= Str::substr($id,$viTri+4);
        }
        $dataBill = ChiTietDonHang::all();
        return response()->json([
            'dataBillGateDetails' => $dataBill
        ]);

    }
    public function addDonHangtUpdate(DonHangRequest $request)
    {
        // Phải kiểm tra xem là đã login hay chưa?
        $agent = Auth::guard('agent')->user();
        if($agent) {
            $sanPham = SanPham::find($request->san_pham_id);
            if(empty($gioHang)|| count($gioHang)>0){
            $gioHang =ChiTietDonHang::where('is_cart',1)
                                    ->where ('agent_id',$agent->id)
                                    ->get();
            if($gioHang) {
                $gioHang->phi_van_chuyen = $request->phi_van_chuyen;
                $gioHang->save();
            } else {
                // $tien_duoc_giam =  (($sanPham->gia_ban)* ($request->so_luong)) - (($sanPham->gia_khuyen_mai)* ($request->so_luong)) ;
                $donHang= DonHang::create([
                    'ma_don_hang'=>rand(11111,99999),
                    'tong_tien' => 0,
                    'tien_giam_gia'=>0,
                    'thuc_tra' =>0,
                    'agent_id'=> $agent->id,
                    'loai_thanh_toan'=>$request->loai_thanh_toan,
                    'phi_van_chuyen'=>$request->phi_van_chuyen,
                ]);
            }

            $thuc_tra =0; $tong_tien=0;

            foreach($gioHang as $key => $value){
                $sanPham =SanPham::find($value->san_pham_id);
                if($sanPham){
                    $giaBan =$sanPham->don_gia_khuyen_mai ? $sanPham->don_gia_khuyen_mai : $sanPham->don_gia_ban;
                    $thuc_tra +=  $value->so_luong * $giaBan;
                    $tong_tien +=  $value->so_luong * $sanPham->don_gia_ban ;
                    $value->don_gia = $giaBan;
                    // $value->thanh_tien  = $value->don_gia * $value->so_luong;
                    $value->is_cart = 0;
                    $value->don_hang_id = $donHang->id;
                    $value->save();
                }else{
                    $value->delete();
                }
            }
            $donHang->thuc_tra = $thuc_tra  ;
            $donHang->tong_tien = $tong_tien;
            $donHang->tien_giam_gia= $tong_tien - $thuc_tra;
            $donHang->save();

            // dd('true');
            return response()->json(['status'=>true]);  // thành công
        }else{
            return response()->json(['status'=>false]);
        }
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function tinhtrang($id)
    {
        $daa= DonHang::find($id);
        if($daa){
            $daa->tinh_trang = !$daa->tinh_trang;
            $daa->save();
            return response()->json([
                'status' => true,
            ]);
        } else {
            dd('cc');
        }
    }
    public function removeDonHang($idlatao)
    {

        $dataBill = DonHang::find($idlatao);
        if($dataBill){
            $dataBill->delete();
            return response()->json([
            'status' => true,
            ]);

        }else {
            dd('cc');
        }


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonHang $donHang)
    {
        //
    }
}
