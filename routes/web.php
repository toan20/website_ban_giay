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
});
