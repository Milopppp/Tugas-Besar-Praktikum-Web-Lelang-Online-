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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel auctions (ID Lelang)
            $table->foreignId('auction_id')->constrained('auctions')->onDelete('cascade');
            
            // Menghubungkan ke tabel users (Siapa yang menawar)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Nominal harga yang ditawarkan
            $table->bigInteger('penawaran_harga');
            
            // Waktu penawaran
            $table->dateTime('tgl_penawaran');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
