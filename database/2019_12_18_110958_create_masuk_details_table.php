<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasukDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masuk_details', function (Blueprint $table) {
            $table->bigIncrements('id_md');
            $table->string('masuk_id',100);
            $table->date('tanggal_masuk');
            $table->integer('qty_in');
            $table->string('pemasok',200);
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
        Schema::dropIfExists('masuk_details');
    }
}
