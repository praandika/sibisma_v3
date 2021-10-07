<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColoumnKeluars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keluars', function (Blueprint $table) {
            $table->dropColumn('qty_out');
            $table->dropColumn('cabang');
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
        Schema::table('keluars', function (Blueprint $table) {
            $table->integer('qty_out');
            $table->string('cabang');
            $table->integer('stok_id');
        });
    }
}
