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
        Schema::create('penyusutans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_aset');
            $table->timestamp('tgl_perolehan');
            $table->integer('harga_peroleh');
            $table->string('penyusutan_pertahun');
            $table->integer('nilai_penyusutan');
            $table->integer('nilai_pelepasan');
            $table->integer('nilai_buku');
            $table->integer('tahun_pakai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyusutans');
    }
};
