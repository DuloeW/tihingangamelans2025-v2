<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    
    public function storeWorkshop(Request $request)
    {
        //TODO membuat validate
        // $pemesan = auth('web')->id();
        // dd($request->all());
        $katalogId = $request->input('katalog_id');
        $penggunaId = $request->input('pengguna_id');
        $jadwalId = $request->input('jadwal_id');
        $totalHarga = $request->input('total_harga');
        $nama_grup = $request->input('nama_grup');
        $jumlah = $request->input('jumlah');



        $pemesanan = Pemesanan::create([
            'katalog_id' => $katalogId,
            'pengguna_id' => $penggunaId,
            'tgl_mulai_booking' => null,
            'tgl_selesai_booking' => null,
            'jadwal_id' => $jadwalId,
            'status' => 'unpaid',
            'tanggal_pemesanan' => now(),   
            'total_harga' => $totalHarga,
        ]);

        // dd($pemesanan);

        return redirect()->back()->with('success', 'Pemesanan workshop berhasil dibuat!');
    }

}
