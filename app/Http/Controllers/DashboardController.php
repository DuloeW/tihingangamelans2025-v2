<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\UlasanKatalog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth('web')->id();

        $riwayatWorkshop = Pemesanan::with(['katalog', 'jadwal', 'ulasan'])
            ->where('pengguna_id', $userId)
            ->whereHas('katalog', function($query) {
                $query->where('jenis', 'Workshop');
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();
    
        $riwayatKelas = Pemesanan::with(['katalog', 'jadwal', 'ulasan'])
            ->where('pengguna_id', $userId)
            ->whereHas('katalog', function($query) {
                $query->where('jenis', 'Kelas');
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        $riwayatGamelan = Pemesanan::with(['katalog', 'jadwal', 'ulasan'])
            ->where('pengguna_id', $userId)
            ->whereHas('katalog', function($query) {
                $query->where('jenis', 'Gamelan');
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        $ulasanSaya = UlasanKatalog::with('katalog')
            ->where('pengguna_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dashboard', [
            'workshops' => $riwayatWorkshop,
            'classes' => $riwayatKelas,
            'gamelans' => $riwayatGamelan,
            'ulasanSaya' => $ulasanSaya,
        ]);
    }
}
