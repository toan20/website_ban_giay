<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trangchu.cart.index');
    }

    public function addToCart(AddToCartRequest $request)
    {

        $tong_tien1=0;
        $agent = Auth::guard('agent')->user();
        if($agent) {
            $sanPham = SanPham::find($request->san_pham_id);

            $chiTietDonHang = ChiTietDonHang::where('san_pham_id', $request->san_pham_id)
                                            ->where('is_cart', 1)
                                            ->where('agent_id', $agent->id)
                                            ->first();
            if($chiTietDonHang) {
                $chiTietDonHang->so_luong += $request->so_luong;
                $chiTietDonHang->save();
            } else {
                ChiTietDonHang::create([
                    'san_pham_id'       => $sanPham->id,
                    'ten_san_pham'      => $sanPham->ten_san_pham,
                    'don_gia'           => $sanPham->don_gia_khuyen_mai ? $sanPham->don_gia_khuyen_mai : $sanPham->don_gia_ban,
                    'so_luong'          => $request->so_luong,
                    'is_cart'           => 1,
                    'tien_duoc_giam'    => ($sanPham->don_gia_ban) -  ($sanPham->don_gia_khuyen_mai) ,
                    'agent_id'          => $agent->id,
                    'tong_tien_san_pham'=> $sanPham->don_gia_ban ? $sanPham->don_gia_ban : $sanPham->don_gia_khuyen_mai,
                    'size'              =>0,
                ]);

               


            }

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }

    }
    public function tangsoluong($san_pham_id){
        $agent = Auth::guard('agent')->user();
        if($agent) {
            // $sanPham = SanPham::find($san_pham_id);

            $chiTietDonHang = ChiTietDonHang::where('san_pham_id', SanPham::find($san_pham_id) )
                                            ->where('is_cart', 1)
                                            ->where('agent_id', $agent->id)
                                            ->first();
            if($chiTietDonHang) {
                $chiTietDonHang->so_luong = $chiTietDonHang->so_luong++;
                $chiTietDonHang->save();
                return response()->json(['status' => true]);

            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function dataCart()
    {
        $agent = Auth::guard('agent')->user();
        if($agent) {
            $data = ChiTietDonHang::join('san_phams', 'chi_tiet_don_hangs.san_pham_id', 'san_phams.id')
                                  ->where('agent_id', $agent->id)
                                  ->where('is_cart', 1)
                                  ->select('chi_tiet_don_hangs.*', 'san_phams.hinh_anh')
                                  ->get();

            return response()->json(['data' => $data]);
        }else{
            toastr()->warning('vui lòng đăng nhập');
            return redirect()->back();

        }
    }
    public function addToCartUpdate(AddToCartRequest $request)
    {
        // Phải kiểm tra xem là đã login hay chưa?
        $agent = Auth::guard('agent')->user();
        if($agent) {
            $sanPham = SanPham::find($request->san_pham_id);

            $chiTietDonHang = ChiTietDonHang::where('san_pham_id', $request->san_pham_id)
                                            ->where('is_cart', 1)
                                            ->where('agent_id', $agent->id)
                                            ->first();
            if($chiTietDonHang) {
                $chiTietDonHang->so_luong = $request->so_luong;
                $chiTietDonHang->save();
            } else {
                // $tien_duoc_giam =  (($sanPham->gia_ban)* ($request->so_luong)) - (($sanPham->gia_khuyen_mai)* ($request->so_luong)) ;
                ChiTietDonHang::create([
                    'san_pham_id'       => $sanPham->id,
                    'ten_san_pham'      => $sanPham->ten_san_pham,
                    'don_gia'           => $sanPham->don_gia_khuyen_mai ? $sanPham->don_gia_khuyen_mai : $sanPham->don_gia_ban,
                    'so_luong'          => $request->so_luong,
                    'tien_duoc_giam'    => ($sanPham->don_gia_ban) -  ($sanPham->don_gia_khuyen_mai) ,
                    'is_cart'           => 1,
                    'agent_id'          => $agent->id,
                    'tong_tien_san_pham'=> $sanPham->don_gia_ban ? $sanPham->don_gia_ban : $sanPham->don_gia_khuyen_mai,
                    'size'              =>0,
                ]);
            }

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function removeCart(Request $request)
    {
        $agent = Auth::guard('agent')->user();
        if($agent) {
            $chiTietDonHang = ChiTietDonHang::where('is_cart', 1)
                                            ->where('agent_id', $agent->id)
                                            ->where('san_pham_id', $request->san_pham_id)
                                            ->first();
            $chiTietDonHang->delete();
        }
    }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function show(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function edit(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChiTietDonHang $chiTietDonHang)
    {
        //
    }
}
