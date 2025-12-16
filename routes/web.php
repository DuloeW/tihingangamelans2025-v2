<?php

use App\Http\Controllers\BisnisController;
use App\Http\Controllers\GalleryGamelanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('gallery-gamelan')->name('gallery-gamelan.')->controller(GalleryGamelanController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('detail');
});

Route::post('/pesan-workshop', [PemesananController::class, 'storeWorkshop'])->name('pesan.workshop');

// Kita group semua URL yang berawalan 'store'
Route::prefix('store')->name('store.')->controller(BisnisController::class)->group(function () {

    // 1. Halaman List Semua Toko
    Route::get('/', 'index')->name('index');

    // 2. Halaman Detail Toko
    Route::get('/{slug}', 'showStore')->name('show');

    // 3. Halaman Detail Produk/Katalog
    Route::get('/{slug}/{jenis}/{katalog_id}', 'showCatalog')->name('catalog.detail');

});

Route::get('/detail-katalog', function () {
    return view('detail-katalog');
});


Route::get('/dashboard', function () {
    // 1. Ambil User ID yang sedang login
    $userId = Auth::id();

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

    // 3. Return view dashboard sambil membawa data '$riwayatWorkshop' sebagai '$workshops'
    return view('dashboard', [
        'workshops' => $riwayatWorkshop,
        'classes' => $riwayatKelas,
        'gamelans' => $riwayatGamelan,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
