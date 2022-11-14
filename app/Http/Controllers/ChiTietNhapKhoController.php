<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChiTietNhapKho\CreateChiTietNhapKhoRequest;
use App\Http\Requests\ChiTietNhapKho\DeleteChiTietNhapKhoRequest;
use App\Http\Requests\ChiTietNhapKho\UpdateChiTietNhapKho;
use App\Http\Requests\ChiTietNhapKho\UpdatePriceChiTietNhapKho;
use App\Models\ChiTietNhapKho;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ChiTietNhapKhoController extends Controller
{
    public function index()
    {
        return view('admin.nhapkho.index');
    }

    public function getData()
    {
        $data = ChiTietNhapKho::join('san_phams','chi_tiet_nhap_khos.id_san_pham', 'san_phams.id')
                              ->whereNull('id_hoa_don_nhap_kho')
                              ->select('chi_tiet_nhap_khos.*', 'san_phams.ma_san_pham')
                              ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function destroy(DeleteChiTietNhapKhoRequest $request)
    {
        $chiTietNhapKho = ChiTietNhapKho::where('id', $request->id)
                                        ->whereNull('id_hoa_don_nhap_kho')
                                        ->first();
        if($chiTietNhapKho) {
            $chiTietNhapKho->delete();
            return response()->json([
                'status' => true,
                'message' => 'Đã xóa sản phẩm!',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Ê, cấm chơi mất dạy nhé!',
            ]);
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $data= SanPham::where('ma_san_pham', 'like', '%'.$search.'%')
                            ->orWhere('ten_san_pham', 'like', '%'.$search.'%')
                            ->get();
        return response()->json([
            'listSanPham' => $data,
        ]);
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
    public function store(CreateChiTietNhapKhoRequest $request)
    {
        $chiTietNhapKho = ChiTietNhapKho::where('id_san_pham', $request->id_san_pham)
                                        ->whereNull('id_hoa_don_nhap_kho')
                                        ->first();
        if($chiTietNhapKho) {
            $chiTietNhapKho->so_luong_nhap++;
            $chiTietNhapKho->save();
        } else {
            $sanPham = SanPham::find($request->id_san_pham);
            ChiTietNhapKho::create([
                'id_san_pham'    =>  $sanPham->id,
                'ten_san_pham'   =>  $sanPham->ten_san_pham,
                'so_luong_nhap'  =>  1,
                'don_gia_nhap'   =>  $sanPham->don_gia_ban,
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChiTietNhapKho  $chiTietNhapKho
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChiTietNhapKho $request)
    {
        $chiTietNhapKho = ChiTietNhapKho::where('id', $request->id)
                                        ->whereNull('id_hoa_don_nhap_kho')
                                        ->first();

        if($chiTietNhapKho) {
            $chiTietNhapKho->so_luong_nhap = $request->so_luong_nhap;
            $chiTietNhapKho->save();
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Sản phẩm không tồn tại!',
            ]);
        }

    }

    public function updatePrice(UpdatePriceChiTietNhapKho $request)
    {
        $chiTietNhapKho = ChiTietNhapKho::where('id', $request->id)->whereNull('id_hoa_don_nhap_kho')->first();

        if($chiTietNhapKho) {
            $chiTietNhapKho->don_gia_nhap = $request->don_gia_nhap;
            $chiTietNhapKho->save();
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Sản phẩm không tồn tại!',
            ]);
        }
    }
}
