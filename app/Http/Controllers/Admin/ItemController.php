<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data dari tabel items
        // Jika tabel kosong, ini akan mengembalikan array kosong (bukan error)
        $items = \App\Models\Item::paginate(10); 

        // WAJIB pakai return. Tanpa return, halaman akan PUTIH.
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga_awal' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        'deskripsi' => 'nullable|string',
    ]);

    $data = [
        'nama' => $request->nama,
        'harga_awal' => $request->harga_awal,
        'deskripsi_barang' => $request->deskripsi,
    ];

    // Cek jika ada file foto yang diunggah
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('images/items'), $nama_file);
        $data['foto'] = $nama_file; // Simpan nama file ke kolom 'foto'
    }

    \App\Models\Item::create($data);

    return redirect()->route('admin.items.index')->with('success', 'Barang berhasil disimpan!');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = \App\Models\Item::findOrFail($id);
        return view('admin.items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = \App\Models\Item::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'harga_awal' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'harga_awal' => $request->harga_awal,
            'deskripsi_barang' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada pilihan baru (opsional)
            if ($item->foto && file_exists(public_path('images/items/' . $item->foto))) {
                unlink(public_path('images/items/' . $item->foto));
            }

            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/items'), $nama_file);
            $data['foto'] = $nama_file;
        }

        $item->update($data);

        return redirect()->route('admin.items.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari data barang berdasarkan ID
        $item = \App\Models\Item::findOrFail($id);

        // 2. Hapus file foto dari folder public/images/items jika file tersebut ada
        if ($item->foto && file_exists(public_path('images/items/' . $item->foto))) {
            unlink(public_path('images/items/' . $item->foto));
        }

        // 3. Hapus data dari database
        $item->delete();

        // 4. Kembali ke halaman utama dengan pesan sukses
        return redirect()->route('admin.items.index')->with('success', 'Barang dan fotonya berhasil dihapus!');
    }
}
