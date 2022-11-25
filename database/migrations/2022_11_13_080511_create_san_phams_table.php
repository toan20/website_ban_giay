<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham');
            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->integer('is_open');
            $table->double('don_gia_ban', 18, 0);
            $table->double('don_gia_khuyen_mai', 18, 0)->default(0);
            $table->integer('danh_muc_id');
            $table->string('hinh_anh');
            $table->longText('mo_ta_ngan');
            $table->longText('mo_ta_chi_tiet');
            $table->integer('so_luong')->default(0);
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
        Schema::dropIfExists('san_phams');
    }
}
