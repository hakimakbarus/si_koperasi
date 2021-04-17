<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->datetime('waktu');
            $table->string('nisn');
            $table->string('telepon_merchant');
            $table->foreign('nisn')->references('nisn')->on('santris')->onDelete('cascade');
            $table->foreign('telepon_merchant')->references('telepon')->on('users')->onDelete('cascade');
            $table->integer('nominal')->unsigned();
            $table->string('keterangan')->nullable();
            $table->enum('status_pencairan', ['0', '1'])->default('0');
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
        Schema::dropIfExists('transaksis');
    }
}
