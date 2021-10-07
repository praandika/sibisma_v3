<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColoumnMasuks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masuks', function (Blueprint $table) {
            $table->dropColumn('qty_in');
            $table->dropColumn('pemasok');
            $table->dropColumn('stok_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masuks', function (Blueprint $table) {
            $table->integer('qty_in');
            $table->string('pemasok');
            $table->integer('stok_id');
        });
    }
}
