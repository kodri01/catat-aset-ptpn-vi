<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori')->nullable();
            $table->string('kode_aset');
            $table->string('nama_aset');
            $table->string('brand');
            $table->string('umur_aset');
            $table->timestamp('tgl_peroleh')->nullable();
            $table->integer('qty');
            $table->integer('harga_peroleh');
            $table->string('kondisi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
