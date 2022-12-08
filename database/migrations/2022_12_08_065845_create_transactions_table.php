<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            //praktikum 06
            $table->id();
            $table->foreignId('id_petugas');
            $table->foreignId('id_peminjam');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
            
            $table->foreign('id_petugas')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_peminjam')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
