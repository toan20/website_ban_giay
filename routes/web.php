<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/admin'], function() {
    Route::group(['prefix' => '/danh-muc'], function() {
        Route::get('/index', [\App\Http\Controllers\DanhMucController::class, 'index']);
        Route::get('/get-data', [\App\Http\Controllers\DanhMucController::class, 'getData']);
        Route::get('/update-status/{id}',  [\App\Http\Controllers\DanhMucController::class, 'updateStatus']);
        Route::post('/index', [\App\Http\Controllers\DanhMucController::class, 'store']);
        Route::get('/edit/{id}', [\App\Http\Controllers\DanhMucController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\DanhMucController::class, 'update']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\DanhMucController::class, 'destroy']);
    });
    Route::group(['prefix' => '/san-pham'], function() {
        Route::post('/search', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'search']);
        Route::get('/index', [\App\Http\Controllers\SanPhamController::class, 'index']);
        Route::get('/update-status/{id}',  [\App\Http\Controllers\SanPhamController::class, 'updateStatus']);
        Route::get('/data', [\App\Http\Controllers\SanPhamController::class, 'getData']);
        Route::post('/index', [\App\Http\Controllers\SanPhamController::class, 'store']);
        Route::post('/check-product-id', [\App\Http\Controllers\SanPhamController::class, 'checkProuctId']);
        Route::get('/edit/{id}', [\App\Http\Controllers\SanPhamController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\SanPhamController::class, 'update']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\SanPhamController::class, 'destroy']);
        Route::get('/auto-complete', [\App\Http\Controllers\SanPhamController::class, 'autoComplete']);
    });
    Route::group(['prefix' => '/nhap-kho'], function() {
        Route::get('/index', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'index']);

        Route::get('/data', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'getData']);

        Route::post('/create', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'store']);
        Route::post('/delete', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'destroy']);
        Route::post('/update', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'update']);
        Route::post('/updatePrice', [\App\Http\Controllers\ChiTietNhapKhoController::class, 'updatePrice']);
        Route::get('/lich-su', [\App\Http\Controllers\HoaDonNhapKhoController::class, 'history']);
    });
    Route::group(['prefix' => '/hoa-don-nhap-kho'], function() {
        Route::get('/create', [\App\Http\Controllers\HoaDonNhapKhoController::class, 'store']);
        Route::get('/detail/{id_hoa_don}', [\App\Http\Controllers\HoaDonNhapKhoController::class, 'detail']);
        Route::get('/thong-ke', [\App\Http\Controllers\HoaDonNhapKhoController::class, 'analytic']);
        Route::post('/thong-ke', [\App\Http\Controllers\HoaDonNhapKhoController::class, 'analyticPost'])->name('postThongKeNhapKho');
    });
});
