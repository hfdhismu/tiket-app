<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->enum('status', ['belum_bayar', 'pending', 'dibayar', 'batal'])
                  ->default('belum_bayar')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->enum('status', ['pending', 'dibayar', 'diproses', 'selesai'])
                  ->default('pending')
                  ->change();
        });
    }
};
