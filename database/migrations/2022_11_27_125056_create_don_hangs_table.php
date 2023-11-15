<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang');
            $table->double('tong_tien', 18, 0);
            $table->double('tien_giam_gia', 18, 0);
            $table->double('thuc_tra', 18, 0);
            $table->integer('agent_id');
            $table->integer('loai_thanh_toan');
            $table->string('ten_nguoi_nhan');
            $table->string('sdt_nguoi_nhan');
            $table->string('email_nguoi_nhan');
            $table->string('dia_chi_nguoi_nhan');
            $table->double('phi_van_chuyen', 18, 0);
            $table->integer('tinh_trang')->default(0)->comment('0: Chưa thanh toán, 1: Đã thanh toán');
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
        Schema::dropIfExists('don_hangs');
    }
}
