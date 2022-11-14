<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietNhapKhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_san_pham');
            $table->string('ten_san_pham');
            $table->integer('so_luong_nhap');
            $table->integer('don_gia_nhap');
            $table->integer('id_hoa_don_nhap_kho')->nullable();
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
        Schema::dropIfExists('chi_tiet_nhap_khos');
    }
}
