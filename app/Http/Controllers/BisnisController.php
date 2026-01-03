<?php

namespace App\Http\Controllers;

use App\Models\Bisnis;
use App\Models\Jadwal;
use App\Models\Katalog;
use App\Models\Pemesanan;
use App\Models\UlasanBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BisnisController extends Controller
{

    // 1. HALAMAN LIST TOKO
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenis = $request->input('jenis');

        $stores = Bisnis::query()
                         ->where(function ($query) {
                             $query->where('status', 'active')
                                   ->orWhere('status', 'verified');
                         })
                         ->when($search, function ($query, $search) {
                             $query->where('nama', 'like', '%' . $search . '%');
                         })
                         ->when($jenis, function ($query, $jenis) {
                             $query->whereHas('tags', function ($q) use ($jenis) {
                                 $q->where('jenis', $jenis);
                             });
                         })
                         ->with('tags')
                         ->get();

        $jenisOptions = ['Learn', 'Workshop', 'Purchase'];

        return view('list-store', [
            'stores' => $stores,
            'search' => $search,
            'selectedJenis' => $jenis,
            'jenisOptions' => $jenisOptions,
        ]);
    }

    // 2. HALAMAN DETAIL TOKO
    public function showStore($slug) 
    {
        $storeData = Bisnis::where('slug', $slug)
            ->with(['katalogs', 'tags', 'ulasanBisnis.pengguna',])
            ->first();

        $workshops = $storeData->katalogs->where('jenis', 'Workshop');
        $classes = $storeData->katalogs->where('jenis', 'Kelas');
        $gamelans = $storeData->katalogs->where('jenis', 'Gamelan');

        $rating = $storeData->average_rating;

        // Jika toko tidak ditemukan, tampilkan halaman 404
        if(!$storeData) {
            abort(404);
        }

        // 3. Kirim ke View
        return view('detail-store', [
            'store' => $storeData,
            'slug' => $slug,
            'workshops' => $workshops,
            'classes' => $classes,
            'gamelans' => $gamelans,
            'rating' => $rating,
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

        return view('detail-katalog', [
            'store' => $store,
            'catalog' => $katalog,
            'jenis' => $jenis_katalog,
            'isAuthenticated' => $isAuthenticated,
            'jadwal' => $jadwal,
        ]);
    }   
}
