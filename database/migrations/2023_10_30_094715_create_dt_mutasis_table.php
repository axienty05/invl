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
        Schema::create('dt_mutasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mt_mutasi_id')->constrained()->cascadeOnDelete();
            $table->integer('pemakai_lama')->nullable(false);
            $table->foreignId('m_barang_id')->constrained()->cascadeOnDelete();
            $table->integer('pemakai_baru')->nullable(true);
            $table->unsignedFloat('harga', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_mutasis');
    }
};