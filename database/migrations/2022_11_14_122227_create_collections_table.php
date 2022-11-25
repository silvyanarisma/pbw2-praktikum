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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();

            //tambah kolom
            $table->string('nama_koleksi', 100);
            $table->integer('jumlah_awal');
            $table->tinyInteger('jenis_koleksi');
            $table->date('created_at')->nullable();
            
            //tambah kolom praktikum 05
            $table->integer('jumlah_sisa');
            $table->integer('jumlah_keluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
