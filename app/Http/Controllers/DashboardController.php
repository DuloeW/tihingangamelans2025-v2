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

        $riwayatWorkshop = Pemesanan::with(['katalog', 'jadwal'])
            ->where('pengguna_id', $userId)
            ->whereHas('katalog', function($query) {
                $query->where('jenis', 'Workshop');
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();
    
        $riwayatKelas = Pemesanan::with(['katalog', 'jadwal'])
            ->where('pengguna_id', $userId)
            ->whereHas('katalog', function($query) {
                $query->where('jenis', 'Kelas');
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        $riwayatGamelan = Pemesanan::with(['katalog', 'jadwal'])
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

        // Logic 1 pemesanan = 1 ulasan
        // Kita mapping secara manual karena di DB tidak ada relasi langsung pemesanan -> ulasan
        $reviewsGrouped = $ulasanSaya->groupBy('katalog_id');
        $pemesananReviewStatus = [];

        $processOrders = function($orders) use (&$reviewsGrouped, &$pemesananReviewStatus) {
            foreach ($orders as $order) {
                $katalogId = $order->katalog_id;
                // Cek apakah ada ulasan 'nganggur' untuk katalog ini
                if ($reviewsGrouped->has($katalogId) && $reviewsGrouped[$katalogId]->isNotEmpty()) {
                    // Ambil satu ulasan, anggap ulasan ini milik pemesanan ini
                    $reviewsGrouped[$katalogId]->shift();
                    $pemesananReviewStatus[$order->pemesanan_id] = true;
                } else {
                    $pemesananReviewStatus[$order->pemesanan_id] = false;
                }
            }
        };

        // Proses mapping status ulasan
        $processOrders($riwayatWorkshop);
        $processOrders($riwayatKelas);
        $processOrders($riwayatGamelan);
        
        return view('dashboard', [
            'workshops' => $riwayatWorkshop,
            'classes' => $riwayatKelas,
            'gamelans' => $riwayatGamelan,
            'ulasanSaya' => $ulasanSaya,
            'pemesananReviewStatus' => $pemesananReviewStatus,
        ]);
    }
}
