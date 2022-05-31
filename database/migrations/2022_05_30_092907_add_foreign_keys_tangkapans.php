<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysTangkapans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tangkapans', function (Blueprint $table) {
            $table->foreign('id_boat','id_boat_fk2')->references('id')->
            on('boats')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tangkapans', function (Blueprint $table) {
            $table->dropForeign('id_boat_fk1');
        });
    }
}
