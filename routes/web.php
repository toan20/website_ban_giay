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
    Route::group(['prefix' => '/account'], function() {
        Route::get('/index', [\App\Http\Controllers\AdminController::class, 'index']);

        Route::get('/data', [\App\Http\Controllers\AdminController::class, 'getData']);
        Route::post('/check-email', [\App\Http\Controllers\AdminController::class, 'checkEmail']);
        Route::post('/index', [\App\Http\Controllers\AdminController::class, 'store']);

        Route::get('/edit/{id}', [\App\Http\Controllers\AdminController::class, 'edit']);

        Route::post('/update', [\App\Http\Controllers\AdminController::class, 'update']);
    });
    Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'logout']);

    Route::group(['prefix' => '/cau-hinh'], function() {
        Route::get('/', [\App\Http\Controllers\ConfigController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\ConfigController::class, 'store']);
    });
});
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'viewLogin']);
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'actionLogin']);

Route::get('/agent/dangky', [\App\Http\Controllers\AgentController::class, 'register']);
Route::post('/agent/register', [\App\Http\Controllers\AgentController::class, 'registerAction']);
Route::get('/agent/login', [\App\Http\Controllers\AgentController::class, 'login']);
Route::get('/agent/login-addtocart', [\App\Http\Controllers\AgentController::class, 'login_addtocart']);
Route::get('/agent/logout', [\App\Http\Controllers\AgentController::class, 'logout']);
Route::post('/agent/login', [\App\Http\Controllers\AgentController::class, 'loginAction']);
Route::get('/active/{hash}', [\App\Http\Controllers\AgentController::class, 'active']);
Route::get('/', [\App\Http\Controllers\TrangChuController::class, 'index']);
