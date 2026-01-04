<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 12px; color: #666; }
        
        .section-title { background: #f4f4f4; padding: 8px 10px; font-weight: bold; font-size: 14px; margin-top: 20px; border-left: 4px solid #333; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 12px; }
        th { background-color: #f9f9f9; width: 30%; }
        
        .text-blue { color: #2563eb; font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; font-size: 12px; }
        .signature { margin-top: 60px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL LELANG ONLINE</h2>
        <p>Barang: {{ $auction->item->nama }} | Tanggal Cetak: {{ $date }}</p>
    </div>

    <div class="section-title">INFORMASI BARANG</div>
    <table>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $auction->item->nama }}</td>
        </tr>
        <tr>
            <th>Harga Awal</th>
            <td>Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status Lelang</th>
            <td style="text-transform: uppercase; font-weight: bold;">{{ $auction->status }}</td>
        </tr>
    </table>

    {{-- BAGIAN PEMENANG: Model tabel disamakan dengan Informasi Barang --}}
    @if($auction->status == 'ditutup' && $auction->user)
    <div class="section-title">🏆 PEMENANG LELANG</div>
    <table>
        <tr>
            <th>Nama Pemenang</th>
            <td>{{ $auction->user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $auction->user->email }}</td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td>{{ $auction->user->telp ?? $auction->user->phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $auction->user->alamat ?? $auction->user->address ?? '-' }}</td>
        </tr>
        <tr>
            <th>Harga Akhir (Deal)</th>
            <td class="text-blue" style="font-size: 14px;">
                Rp {{ number_format($auction->harga_akhir, 0, ',', '.') }}
            </td>
        </tr>
    </table>
    @endif

    <div class="section-title">RIWAYAT PENAWARAN (BID)</div>
    <table>
        <thead>
            <tr style="background: #f9f9f9;">
                <th style="width: 40%;">Nama Penawar</th>
                <th style="width: 30%;">Nominal Bid</th>
                <th style="width: 30%;">Waktu Penawaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($auction->bids->sortByDesc('penawaran_harga') as $bid)
            <tr>
                <td>{{ $bid->user->name }}</td>
                <td>Rp {{ number_format($bid->penawaran_harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($bid->tgl_penawaran)->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; color: #999;">Belum ada penawaran masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Garut, {{ $date }}</p>
        <div class="signature">
            <p>Admin Lelang Pro</p>
        </div>
    </div>
</body>
</html>