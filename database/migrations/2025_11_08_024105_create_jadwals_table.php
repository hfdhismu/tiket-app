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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal')->unique(); // contoh: AAA001
            $table->string('asal');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat');
            $table->integer('jumlah_kursi')->default(10);
            $table->decimal('harga', 12, 2);
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
