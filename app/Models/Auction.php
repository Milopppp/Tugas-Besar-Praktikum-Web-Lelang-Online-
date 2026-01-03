<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'auctions';

    // Kolom yang boleh diisi
    protected $fillable = [
        'item_id',
        'tgl_lelang',
        'tgl_akhir',
        'harga_akhir',
        'user_id',
        'petugas_id',
        'status'
    ];

    // Relasi ke Item (Satu lelang memiliki satu barang)
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    // Relasi ke Bids (Satu lelang memiliki banyak tawaran)
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}