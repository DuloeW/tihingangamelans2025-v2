<?php

use App\Http\Controllers\BisnisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/gallery-gamelan', function () {
    return view('gallery-gamelan');
});

// Kita group semua URL yang berawalan 'store'
Route::prefix('store')->name('store.')->controller(BisnisController::class)->group(function () {

    // 1. Halaman List Semua Toko
    // URL: /store
    Route::get('/', 'index')->name('index');

    // 2. Halaman Detail Toko
    // URL: /store/nama-toko-gamelan
    Route::get('/{slug}', 'showStore')->name('show');

    // 3. Halaman Detail Produk/Katalog
    // URL: /store/nama-toko-gamelan/gamelan-bali/15
    Route::get('/{slug}/{jenis_katalog}/{id_katalog}', 'showCatalog')->name('catalog.detail');

});

Route::get('/detail-katalog', function () {
    return view('detail-katalog');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
