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
        Schema::create('mt_mutasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_mutasi', 8)->unique();
            $table->foreignId('m_supplier_id')->nullable(true);
            $table->enum('jenis_mutasi', ['pembelian', 'penjualan', 'perpindahan'])->default('pembelian');
            $table->date('tgl_mutasi')->nullable(false);
            $table->text('keterangan')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_mutasis');
    }
};