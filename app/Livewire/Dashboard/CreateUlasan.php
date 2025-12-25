<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\UlasanKatalog;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; // Jika pakai Livewire v3

class CreateUlasan extends Component
{
    public $isOpen = false; // Mengontrol modal tampil/sembunyi
    public $katalogId;
    public $namaProduk;
    public $rating = 5;
    public $isi_ulasan;

    // Event Listener: Menunggu perintah 'buka-modal' dari halaman riwayat
    #[On('buka-modal-ulasan')] 
    public function openModal($id, $nama)
    {
        $this->katalogId = $id;
        $this->namaProduk = $nama;
        $this->rating = 5;
        $this->isi_ulasan = '';
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function simpan()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'isi_ulasan' => 'required|string|min:5',
        ]);

        $user = Auth::guard('pengguna')->user();

        // Simpan ke database
        UlasanKatalog::create([
            'katalog_id' => $this->katalogId,
            'pengguna_id' => $user->pengguna_id,
            'nama_pengulas' => $user->nama, 
            'rating' => $this->rating,
            'isi_ulasan' => $this->isi_ulasan,
        ]);

        // Tutup modal dan beri notifikasi
        $this->isOpen = false;
        $this->dispatch('ulasan-berhasil-disimpan'); // Optional: refresh parent
        session()->flash('message', 'Ulasan berhasil dikirim!');
        
        // Redirect agar halaman riwayat terefresh (tombol ulasan hilang)
        return redirect(request()->header('Referer')); 
    }

    public function render()
    {
        return view('livewire.dashboard.create-ulasan');
    }
}