<?php

namespace App\Livewire\Katalog;

use Livewire\Component;
use App\Models\UlasanKatalog;
use Illuminate\Support\Facades\Auth;

class CreateReview extends Component
{
    public $katalogId;
    public $skor = 5; // Default rating
    public $komentar;

    protected $rules = [
        'skor' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string|min:10',
    ];

    public function mount($katalogId)
    {
        $this->katalogId = $katalogId;
    }

    public function simpanUlasan()
    {
        // Cek login
        if (!Auth::guard('pengguna')->check()) {
            return session()->flash('error', 'Silakan login terlebih dahulu untuk memberikan ulasan.');
        }

        $this->validate();

        UlasanKatalog::create([
            'katalog_id' => $this->katalogId,
            'pengguna_id' => Auth::guard('pengguna')->id(),
            'skor' => $this->skor,
            'komentar' => $this->komentar,
        ]);

        $this->reset(['komentar', 'skor']);
        session()->flash('message', 'Ulasan Anda berhasil dikirim!');
        
        // Refresh halaman atau emit event untuk memperbarui daftar ulasan
        $this->dispatch('ulasanDitambahkan');
    }

    public function render()
    {
        return view('livewire.katalog.create-review');
    }
}