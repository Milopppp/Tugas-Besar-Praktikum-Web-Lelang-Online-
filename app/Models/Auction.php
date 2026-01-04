<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'auctions';

    // Kolom yang boleh diisi (Mass Assignable)
    protected $fillable = [
        'item_id',
        'tgl_lelang',
        'tgl_akhir',
        'harga_akhir',
        'user_id',    // ID Pemenang lelang
        'petugas_id', // ID Admin/Petugas yang membuat lelang
        'status'
    ];

    /**
     * Relasi ke Model Item
     * Menghubungkan item_id ke tabel items
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Relasi ke Model User (Pemenang)
     * Menghubungkan user_id ke tabel users
     * Inilah yang dicari oleh Laporan PDF untuk menampilkan data pemenang
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Model Bid (Riwayat Penawaran)
     * Satu lelang memiliki banyak tawaran masuk
     */
    public function bids()
    {
        return $this->hasMany(Bid::class, 'auction_id');
    }

    /**
     * Relasi ke Model User (Petugas/Admin)
     * Menghubungkan petugas_id ke tabel users
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}