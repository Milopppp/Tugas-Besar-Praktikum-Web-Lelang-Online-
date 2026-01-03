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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel items
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->dateTime('tgl_lelang');
            $table->dateTime('tgl_akhir');
            $table->bigInteger('harga_akhir')->nullable();
            // User pemenang (masyarakat)
            $table->foreignId('user_id')->nullable()->constrained('users'); 
            // Admin/Petugas yang membuka lelang
            $table->foreignId('petugas_id')->constrained('users'); 
            $table->enum('status', ['dibuka', 'ditutup'])->default('ditutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
