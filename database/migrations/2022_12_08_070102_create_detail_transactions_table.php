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
        Schema::create('detail_transactions', function (Blueprint $table) {
            //praktikum 06
            $table->id();
            $table->foreignId('id_transaksi');
            $table->foreignId('id_koleksi');
            $table->date('tanggal_kembali')->nullable();
            $table->tinyInteger('status');
            $table->string('keterangan', 1000)->nullable();
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')
                ->on('transactions')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_koleksi')->references('id')
                ->on('collections')->onDelete('cascade')
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
        Schema::dropIfExists('detail_transactions');
    }
};
