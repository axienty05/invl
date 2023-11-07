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
        Schema::create('m_services', function (Blueprint $table) {
            $table->id();
            $table->string('no_sj', 8)->nullable(false);
            $table->foreignId('m_pemakai_id')->constrained()->cascadeOnDelete();
            $table->foreignId('m_barang_id')->constrained()->cascadeOnDelete();
            $table->foreignId('m_service_center_id')->constrained()->cascadeOnDelete();
            $table->date('tgl_service')->nullable(false);
            $table->date('tgl_selesai')->nullable(true);
            $table->unsignedFloat('biaya', 14, 2)->default(0);
            $table->text('kerusakan')->nullable(false);
            $table->text('analisa')->nullable(true);
            $table->text('solusi')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_services');
    }
};