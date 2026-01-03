<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids'; // atau nama tabel Anda

    // TAMBAHKAN INI ← PENTING!
    protected $fillable = [
        'auction_id',
        'user_id',
        'penawaran_harga',
        'tgl_penawaran',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Auction
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}