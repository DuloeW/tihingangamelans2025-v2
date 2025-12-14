<?php

namespace App\Http\Controllers;

use App\Models\Bisnis;
use App\Models\Jadwal;
use App\Models\Katalog;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class BisnisController extends Controller
{

    // 1. HALAMAN LIST TOKO
    public function index()
    {
        $stores = Bisnis::query()
                         ->where('status', 'active')
                         ->orWhere('status', 'verified')
                         ->with('tags')
                         ->get();
        return view('list-store', ['stores' => $stores]);
    }

    // 2. HALAMAN DETAIL TOKO
    public function showStore($slug) {
        $storeData = Bisnis::where('slug', $slug)->with('katalogs')->with('tags')->first();

        $workshops = $storeData->katalogs->where('jenis', 'Workshop');
        $classes = $storeData->katalogs->where('jenis', 'Kelas');
        $gamelans = $storeData->katalogs->where('jenis', 'Gamelan');

        if (!$storeData) {
            abort(404);
        }

        // 3. Kirim ke View
        return view('detail-store', [
            'store' => $storeData,
            'slug' => $slug,
            'workshops' => $workshops,
            'classes' => $classes,
            'gamelans' => $gamelans
        ]);
    }

    // 3. HALAMAN DETAIL KATALOG (SESUAI REQUEST KAMU)
    public function showCatalog($slug, $jenis_katalog, $id_katalog)
    {
        $katalog = Katalog::where('katalog_id', $id_katalog)
                            ->with('bisnis')
                            ->first();
        

        if (!$katalog) {
            abort(404); 
        }

        $store = $katalog->bisnis;
        $jadwal = Jadwal::where('katalog_id', $katalog->katalog_id)->get();
        $isAuthenticated = auth('web')->check();
        $pemesanan = Pemesanan::get();

        return view('detail-katalog', [
            'store' => $store,
            'catalog' => $katalog,
            'jenis' => $jenis_katalog,
            'isAuthenticated' => $isAuthenticated,
            'jadwal' => $jadwal,
            'pemesanan' => $pemesanan,
        ]);
    }   
}
