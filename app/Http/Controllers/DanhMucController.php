<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMuc\CreateDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function getNewData()
    {
        $danhMuc = DanhMuc::find(1);

        return response()->json(['product' => $danhMuc]);
    }

    public function index()
    {
        return view("admin.danhmuc.index");
    }

    public function getData()
    {
        $danhMuc    = DanhMuc::all();

        $danhMucCha = DanhMuc::where('id_danh_muc_cha', 0)->get(); // trả về 1 array

        return response()->json([
            'data'      => $danhMuc,
            'dataCha'   => $danhMucCha,
        ]);
    }

    public function updateStatus($id)
    {
        $danhMuc = DanhMuc::find($id);

        if($danhMuc) {
            // $danhMuc->is_open = !$danhMuc->is_open;
            $danhMuc->is_open = $danhMuc->is_open == 0 ? 1 : 0;
            $danhMuc->save();

            return response()->json([
                'status'  => true,
            ]);

        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }

    public function store(CreateDanhMucRequest $request)
    {
        DanhMuc::create([
            'ma_danh_muc'       => $request->ma_danh_muc,
            'ten_danh_muc'      => $request->ten_danh_muc,
            'slug_danh_muc'     => $request->slug_danh_muc,
            'is_open'           => $request->is_open,
            'id_danh_muc_cha'   => $request->id_danh_muc_cha,
        ]);

        return response()->json([
            'status'    => 1,
        ]);
    }


    public function show(DanhMuc $danhMuc)
    {
        //
    }


    public function edit($id)
    {
        $danhMuc = DanhMuc::find($id); // Trả về 1 object
        if($danhMuc) {
            return response()->json([
                'status'    => true,
                'data'      => $danhMuc,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }


    public function update(UpdateDanhMucRequest $request)
    {
        $danhMuc = DanhMuc::find($request->id);

        $danhMuc->ten_danh_muc      = $request->ten_danh_muc;
        $danhMuc->ma_danh_muc       = $request->ma_danh_muc;
        $danhMuc->slug_danh_muc     = $request->slug_danh_muc;
        $danhMuc->is_open           = $request->is_open;
        $danhMuc->id_danh_muc_cha   = $request->id_danh_muc_cha;

        $danhMuc->save();
    }


    public function destroy($id)
    {
        $danhMuc = DanhMuc::find($id);
        if($danhMuc) {
            $danhMuc->delete();

            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
}
