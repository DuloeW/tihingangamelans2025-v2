<?php

use App\Http\Controllers\BisnisController;
use App\Http\Controllers\DashboardController;
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

Route::prefix('store')->name('store.')->controller(BisnisController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get('/{slug}', 'showStore')->name('show');

    Route::get('/{slug}/{jenis}/{katalog_id}', 'showCatalog')->name('catalog.detail');

});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
