<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function index()
    {
        $config = Config::latest()->first();
        return view('admin.config.index');
    }




    public function store(Request $request)
    {
        Config::create([
            'slide_1'       => $request->slide_1,
            'slide_2'      => $request->slide_2,
            'slide_3'     => $request->slide_3,

        ]);
        $data = $request->all();

        Config::create($data);
        toastr()->success("Đã cập nhật cấu hình thành công!!!");

        return redirect()->back();
    }

}
