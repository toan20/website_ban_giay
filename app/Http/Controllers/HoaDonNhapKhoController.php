<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNhapKho;
use App\Models\HoaDonNhapKho;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HoaDonNhapKhoController extends Controller
{
    public function store()
    {
        $chiTietNhapKho = ChiTietNhapKho::whereNull('id_hoa_don_nhap_kho')->get(); // get, all -> array. first, find -> obj

        if(count($chiTietNhapKho) > 0) {
            $hoaDonNhapKho = HoaDonNhapKho::create([
                'hash'  => Str::uuid(),
            ]);

            $hoaDonNhapKho->ma_don_hang = 'HDNK' . (100000 + $hoaDonNhapKho->id);

            $tongTien       = 0;
            $tongSanPham    = 0;
            foreach($chiTietNhapKho as $key => $value) {
                $sanPham = SanPham::find($value->id_san_pham);
                if($sanPham) {
                    $tongTien       = $tongTien + $value->so_luong_nhap * $value->don_gia_nhap;
                    $tongSanPham    = $tongSanPham + $value->so_luong_nhap;

                    $value->id_hoa_don_nhap_kho = $hoaDonNhapKho->id;
                    $value->save();
                } else {
                    $value->delete();
                }
            }

            $hoaDonNhapKho->tong_tien = $tongTien;
            $hoaDonNhapKho->tong_san_pham = $tongSanPham;
            $hoaDonNhapKho->save();

            if($tongSanPham > 0) {
                return response()->json([
                    'status'    => true,
                ]);
            } else {
                $hoaDonNhapKho->delete();

                return response()->json([
                    'status'    => false,
                    'message'   => 'Sản phẩm không tồn tại!',
                ]);
            }



        } else {
            return response()->json([
                'status'    => false,
                'message'   => '',
            ]);
        }
    }

    public function history()
    {
        $hoaDonNhapKho = HoaDonNhapKho::all();

        return view('admin.nhapkho.history', compact('hoaDonNhapKho'));
    }

    public function detail($id_hoa_don)
    {
        $chiTietNhapKho = ChiTietNhapKho::where('id_hoa_don_nhap_kho', $id_hoa_don)
                                        ->join('san_phams', 'chi_tiet_nhap_khos.id_san_pham', 'san_phams.id')
                                        ->select('chi_tiet_nhap_khos.*', 'san_phams.ma_san_pham')
                                        ->get();

        if(count($chiTietNhapKho) > 0) {
            return response()->json([
                'status'    => true,
                'data'      => $chiTietNhapKho,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Hóa đơn không tồn tại!',
            ]);
        }
    }

    public function viewAnalytic($begin, $end)
    {
        $data = HoaDonNhapKho::select(DB::raw('date(created_at) as date'),  DB::raw('sum(tong_tien) as total'))
                             ->whereDate('created_at', '>=', $begin)
                             ->whereDate('created_at', '<=', $end)
                             ->groupBy('date')
                             ->get();

        return $data;
    }

    public function analytic()
    {
        $end     = Carbon::now();
        $begin   = Carbon::now()->subDays(10);

        $data    = $this->viewAnalytic($begin, $end);

        $labels  = [];
        $data_js = [];
        foreach ($data as $key => $value) {
            array_push($labels,  $value->date);
            array_push($data_js, $value->total);
        }

        // dd($data->toArray(), $labels, $data_js);

        return view('admin.nhapkho.analytic', compact('begin', 'end', 'data', 'labels', 'data_js'));
    }

    public function analyticPost(Request $request)
    {
        $end    = $request->end_date;
        $begin  = $request->from_date;

        $data    = $this->viewAnalytic($begin, $end);

        $labels  = [];
        $data_js = [];

        foreach ($data as $key => $value) {
            array_push($labels,  $value->date);
            array_push($data_js, $value->total);
        }

        return view('admin.nhapkho.analytic', compact('begin', 'end', 'data', 'labels', 'data_js'));
    }
}
