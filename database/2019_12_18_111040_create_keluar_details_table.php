<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_details', function (Blueprint $table) {
            $table->bigIncrements('id_kd');
            $table->string('keluar_id',100);
            $table->date('tanggal_keluar');
            $table->integer('qty_out');
            $table->string('cabang',200);
            $table->integer('stok_id');
            $table->string('dealer_kode',50);
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
        Schema::dropIfExists('keluar_details');
    }
}
