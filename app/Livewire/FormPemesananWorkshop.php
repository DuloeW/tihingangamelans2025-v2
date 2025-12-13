<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pemesanan;
use App\Models\Jadwal; // Jangan lupa import model Jadwal
use Illuminate\Support\Facades\Auth;

class FormPemesananWorkshop extends Component
{
    // Data dari Database (Dikirim dari Controller/View Parent)
    public $catalog;
    public $store;
    public $jadwals; // Ubah jadi bentuk array/collection
    public $pemesanan;
    public $nama_grup = ''; // Tambahkan properti untuk nama grup

    // Data Inputan Form (Wire Model)
    public $jumlah_anggota = 1; // Default 1
    public $jadwal_id = '';     // Untuk menampung pilihan user

    public function mount($catalog, $store, $jadwals, $pemesanan, $nama_grup = '')
    {
        $this->catalog = $catalog;
        $this->store = $store;
        $this->jadwals = $jadwals;
        $this->pemesanan = $pemesanan;
        $this->nama_grup = $nama_grup;
    }

    public function save()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 1. Validasi Input
        $this->validate([
            'jumlah_anggota' => 'required|integer|min:1',
            'jadwal_id'      => 'required|exists:jadwal,jadwal_id', // Pastikan user memilih jadwal
        ]);

        // 2. Cek Validasi Kuota (Server Side Security)
        // Kita cek lagi apakah jadwal yang dipilih masih muat?
        $jadwalPilihan = Jadwal::find($this->jadwal_id);
        $terisi = $jadwalPilihan->pemesanans()->where('status', '!=', 'Batal')->count();
        
        // Kalau ternyata penuh saat tombol ditekan
        if ($terisi >= $jadwalPilihan->kuota) {
            session()->flash('error', 'Maaf, jadwal ini baru saja penuh. Silakan pilih jadwal lain.');
            return;
        }

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

        session()->flash('success', 'Pesanan berhasil dibuat!');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.form-pemesanan-workshop', [
            'isAuthenticated' => Auth::check(),
        ]);
    }
}