<?php

namespace App\Http\Controllers;

use App\Models\Bisnis;
use App\Models\Katalog;
use Illuminate\Http\Request;

class BisnisController extends Controller
{
    // INI DUMMY DATA (Pura-pura jadi Database)
    private $dummyStores = [
        [
            'id' => 1,
            'nama' => 'Tihingan Gamelans',
            'slug' => 'tihingan-gamelans',
            'deskripsi' => 'Pusat gamelan terbaik di Bali.',
            'tag_bisnis' => ['Learn', 'Workshop', 'Purchase'],
            'profile' => 'images/ulasan_profile.png',
            'katalog' => [
                [
                    'id' => 101,
                    'nama_produk' => 'Gamelan Bonang',
                    'deskripsi' => 'The Bonang is a traditional Indonesian musical instrument that is part of the gamelan ensemble.',
                    'jenis' => 'gamelan',
                    'harga' => 10000000,
                    'gambar' => 'images/bende1.png'
                ],
                [
                    'id' => 102,
                    'nama_produk' => 'Gamelan Saron',
                    'deskripsi' => 'The Saron is a traditional Indonesian musical instrument with bright metallic sound.',
                    'jenis' => 'gamelan',
                    'harga' => 5000000,
                    'gambar' => 'images/bende1.png'
                ],
                [
                    'id' => 103,
                    'nama_produk' => 'Kendang Bali',
                    'deskripsi' => 'Traditional Balinese drum that provides rhythmic foundation for gamelan music.',
                    'jenis' => 'workshop', // Contoh jenis beda
                    'harga' => 3500000,
                    'gambar' => 'images/bende1.png'
                ]
            ]
        ],
        [
            'id' => 2,
            'nama' => 'Bali Craft Center',
            'slug' => 'bali-craft-center',
            'deskripsi' => 'Oleh-oleh khas Bali lengkap.',
            'tag_bisnis' => ['Learn', 'Purchase', 'Workshop'],
            'profile' => 'images/ulasan_profile.png',
            'katalog' => [
                [
                    'id' => 201,
                    'nama_produk' => 'Kain Endek',
                    'deskripsi' => 'Traditional Balinese woven fabric with beautiful patterns and vibrant colors.',
                    'jenis' => 'kelas',
                    'harga' => 250000,
                    'gambar' => 'images/bende1.png'
                ]
            ]
        ]
    ];

    // 1. HALAMAN LIST TOKO
    public function index()
    {
        // Ubah array jadi object supaya enak dipanggil di blade ($store->nama)
        $stores = Bisnis::query()
                         ->where('status', 'active')
                         ->orWhere('status', 'verified')
                         ->with('tags')
                         ->get();
        // dd($stores->toArray());
        return view('list-store', ['stores' => $stores]);
    }

    // 2. HALAMAN DETAIL TOKO
    public function showStore($slug) {
        $storeData = Bisnis::where('slug', $slug)->with('katalogs')->first();

        $workshops = $storeData->katalogs->where('jenis', 'Workshop');
        $classes = $storeData->katalogs->where('jenis', 'Kelas');
        $gamelans = $storeData->katalogs->where('jenis', 'Gamelan');

        dd($gamelans->toArray());

        if (!$storeData) {
            abort(404);
        }

        // dd($storeData->toArray());n

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
        // A. Cari Tokonya dulu
        $storeData = Bisnis::where('slug', $slug)
                        ->with('katalogs')
                        ->first();
        
        if (!$storeData) {
            abort(404); 
        }

        // B. Cari Produk di dalam toko tersebut
        $catalogData = $storeData->katalogs
                        ->where('id', $id_katalog)
                        // Opsional: Validasi jenis juga kalau mau ketat
                        ->where('jenis', $jenis_katalog) 
                        ->first();

        if (!$catalogData) {
            abort(404);
        }

        // Convert ke object
        $store = (object) $storeData;
        $catalog = (object) $catalogData;

        return view('detail-katalog', [
            'store' => $store,
            'catalog' => $catalog,
            'jenis' => $jenis_katalog
        ]);
    }   
}
