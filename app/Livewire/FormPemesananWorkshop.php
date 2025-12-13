<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class FormPemesananWorkshop extends Component
{
    public $catalog;
    public $store;
    public $jadwals;
    public $pemesanan;
    
    // Data Inputan Form (Wire Model)
    public $nama_grup = ''; 
    public $jumlah_anggota = 1;
    public $jadwal_id = '';

    public function mount($catalog, $store, $jadwals, $pemesanan)
    {
        $this->catalog = $catalog;
        $this->store = $store;
        $this->jadwals = $jadwals;
        $this->pemesanan = $pemesanan;
    }

    public function save()
    {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }

        // 1. Validasi Input
        $this->validate([
            'nama_grup'      => 'required|string|max:255',
            'jumlah_anggota' => 'required|integer|min:1',
            'jadwal_id'      => 'required|exists:jadwal,jadwal_id', // Pastikan user memilih jadwal
        ]);

        // 3. Simpan
        Pemesanan::create([
            'pengguna_id'       => auth('web')->id(),
            'katalog_id'        => $this->catalog->katalog_id,
            'jadwal_id'         => $this->jadwal_id, // Ambil dari wire:model
            'tanggal_pemesanan' => now(),
            'status'            => 'unpaid',
            'total_harga'       => $this->catalog->harga * $this->jumlah_anggota,
            'jumlah'            => $this->jumlah_anggota,
            'nama_grup'         => $this->nama_grup,
        ]);

        LivewireAlert::title('Success')
            ->text('Pesanan berhasil dibuat')
            ->success()
            ->timer(3000)
            ->withConfirmButton('OK')
            ->onConfirm('goToDashboard')
            ->onDeny('goToDashboard')
            ->onDismiss('goToDashboard')
            ->show();

    }

    public function render()
    {
        return view('livewire.form-pemesanan-workshop', [
            'isAuthenticated' => auth('web')->check(),
        ]);
    }

    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }
}