<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColoumnJuals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('juals', function (Blueprint $table) {
            $table->dropColumn('qty');
            $table->dropColumn('harga_unit');
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
        Schema::table('juals', function (Blueprint $table) {
            $table->integer('qty');
            $table->integer('harga_unit');
            $table->integer('stok_id');
        });
    }
}
