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
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier', 50)->nullable(false);
            $table->string('alamat', 100)->nullable(false);
            $table->string('no_telp', 20)->unique()->nullable(true);
            $table->string('email')->unique()->nullable(true);
            $table->string('cp', 50)->nullable(true);
            $table->string('no_hp', 20)->nullable(true);
            $table->text('keterangan')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_suppliers');
    }
};