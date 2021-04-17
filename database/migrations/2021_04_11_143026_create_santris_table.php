<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn')->unique();
            $table->string('foto')->nullable();
            $table->integer('tahun_masuk')->length(4)->unsigned();
            $table->integer('saldo')->unsigned()->default(0);
            $table->enum('status', ['0', '1'])->default(1);
            $table->integer('pin')->length(6)->unsigned()->nullable();
            $table->text('alamat')->nullable();
            $table->bigInteger('id_madrasah')->unsigned()->nullable();
            $table->foreign('id_madrasah')->references('id')->on('madrasahs')->onDelete('set null');
            $table->bigInteger('id_ribath')->unsigned()->nullable();
            $table->foreign('id_ribath')->references('id')->on('ribaths')->onDelete('set null');
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
        Schema::dropIfExists('santris');
    }
}
