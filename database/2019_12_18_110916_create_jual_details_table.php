<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJualDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jual_details', function (Blueprint $table) {
            $table->bigIncrements('id_jd');
            $table->string('jual_id',100);
            $table->date('tanggal_jual');
            $table->integer('qty');
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
        Schema::dropIfExists('jual_details');
    }
}
