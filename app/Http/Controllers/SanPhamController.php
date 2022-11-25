<?php

namespace App\Http\Controllers;

use App\Http\Requests\SanPham\CreateSanPhamRequest;
use App\Http\Requests\SanPham\UpdateSanPhamRequest;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function autoComplete(Request $request)
    {
        $data = SanPham::select('ten_san_pham')
                       ->where('ten_san_pham', 'like', '%' . $request->ten_san_pham . '%')
                       ->get();

        return response()->json($data);
    }

    public function index()
    {
        return view('admin.sanpham.index');
    }

    public function getData()
    {
        $data = SanPham::join('danh_mucs', 'san_phams.danh_muc_id', 'danh_mucs.id')
                       ->select('san_phams.*', 'danh_mucs.ten_danh_muc')
                       ->get();
        return response()->json([
            'listSanPham'  => $data
        ]);
    }

    public function checkProuctId(Request $request)
    {
        $sanPham = SanPham::where('ma_san_pham', $request->ma_san_pham)->first();

        if($sanPham) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
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
    public function store(CreateSanPhamRequest $request)
    {
        $data   = $request->all();
        
        SanPham::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function show(SanPham $sanPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $sanPham = SanPham::find($id);

        if($sanPham) {
            $sanPham->is_open = $sanPham->is_open == 0 ? 1 : 0;
            $sanPham->save();

            return response()->json([
                'status'  => true,
            ]);

        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sanPham = SanPham::find($id);
        if($sanPham) {
            $sanPham->delete();

            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function edit($id)
    {
        $sanPham = SanPham::find($id); // Trả về 1 object
        if($sanPham) {
            return response()->json([
                'status'    => true,
                'data'      => $sanPham,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function update(UpdateSanPhamRequest $request)
    {
        $sanPham = SanPham::find($request->id);

        $sanPham->ten_san_pham                 = $request->ten_san_pham;
        $sanPham->ma_san_pham                  = $request->ma_san_pham;
        $sanPham->slug_san_pham                = $request->slug_san_pham;
        $sanPham->is_open                      = $request->is_open;
        $sanPham->don_gia_ban                 = $request->don_gia_ban;
        $sanPham->don_gia_khuyen_mai          = $request->don_gia_khuyen_mai;
        $sanPham->danh_muc_id                 = $request->danh_muc_id;
        $sanPham->hinh_anh                    = $request->hinh_anh;
        $sanPham->mo_ta_ngan                  = $request->mo_ta_ngan;
        $sanPham->mo_ta_chi_tiet              = $request->mo_ta_chi_tiet;

        $sanPham->save();
    }
}
