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
        Schema::create('m_service_internals', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_mulai')->nullable(false);
            $table->date('tgl_selesai')->nullable(true);
            $table->foreignId('m_barang_id')->constrained()->cascadeOnDelete();
            $table->foreignId('m_pemakai_id')->constrained()->cascadeOnDelete();
            $table->unsignedFloat('biaya', 14, 2)->default(0)->nullable(true);
            $table->text('keterangan')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_service_internals');
    }
};
