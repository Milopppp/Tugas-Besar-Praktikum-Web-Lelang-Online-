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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi_barang')->nullable(); // atau ganti jadi 'deskripsi' agar sama dengan form
            $table->decimal('harga_awal', 15, 2);
            $table->dateTime('batas_waktu')->nullable(); // Kolom baru untuk batas waktu
            $table->enum('status', ['tersedia', 'terjual'])->default('tersedia'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
