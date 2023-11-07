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
        Schema::create('m_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_pemakai_id')->constrained()->cascadeOnDelete();
            $table->string('kode_barang', 10)->unique()->nullable(false);
            $table->string('nama_barang', 100)->nullable(false);
            $table->string('serial_number', 50)->unique()->nullable(false);
            $table->string('kategori')->default('lainlain');
            $table->unsignedFloat('harga', 14, 2)->default(0);
            $table->text('keterangan')->nullable(true);
            $table->enum('status', ['aktif', 'sedang_service', 'tidak_aktif'])->default('tidak_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barangs');
    }
};