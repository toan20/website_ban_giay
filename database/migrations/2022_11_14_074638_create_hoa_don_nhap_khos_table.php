<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonNhapKhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don_nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->nullable();
            $table->string('hash');
            $table->integer('tong_tien')->nullable();
            $table->integer('tong_san_pham')->nullable();
            $table->integer('tinh_trang')->default(0)->comment('0: Chưa thanh toán, 1: Đã thanh toán');
            $table->integer('hinh_thuc_thanh_toan')->nullable()->comment('0: Tiền Mặt, 1: Chuyển khoản');
            $table->string('minh_chung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_don_nhap_khos');
    }
}
