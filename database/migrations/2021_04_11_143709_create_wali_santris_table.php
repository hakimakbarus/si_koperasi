<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaliSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wali_santris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_santri')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_santri')->references('id')->on('santris')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('wali_santris');
    }
}
