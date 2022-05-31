<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNelayansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nelayans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_boat')->unsigned();
            $table->string('nama',100);
            $table->string('alamat',100);
            $table->bigInteger('no_hp');
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
        Schema::dropIfExists('nelayans');
    }
}
