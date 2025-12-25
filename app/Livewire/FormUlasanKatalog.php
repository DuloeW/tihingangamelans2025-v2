<?php

namespace App\Livewire;

use App\Models\Katalog;
use App\Models\Pemesanan;
use App\Models\UlasanKatalog;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class FormUlasanKatalog extends Component
{
    public $katalog_id;
    public $rating = 0;
    public $isi_ulasan;
    public $showModal = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'isi_ulasan' => 'required|string|max:500',
    ];

    public function mount($katalogId)
    {
        $this->katalog_id = $katalogId;
    }

    public function openModal()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user pernah memesan katalog ini
        $hasOrdered = Pemesanan::where('pengguna_id', Auth::id())
            ->where('katalog_id', $this->katalog_id)
            ->exists();

        if (!$hasOrdered) {
            LivewireAlert::title('Anda belum pernah memesan produk ini.')
                ->error()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['rating', 'isi_ulasan']);
    }

    public function save()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user pernah memesan katalog ini
        $hasOrdered = Pemesanan::where('pengguna_id', Auth::id())
            ->where('katalog_id', $this->katalog_id)
            ->exists();

        if (!$hasOrdered) {
            LivewireAlert::title('Anda belum pernah memesan produk ini.')
                ->error()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        $this->validate();

        UlasanKatalog::create([
            'katalog_id' => $this->katalog_id,
            'pengguna_id' => Auth::id(),
            'nama_pengulas' => Auth::user()->nama ?? 'Pengguna', // Sesuaikan dengan field di tabel users/pengguna
            'rating' => $this->rating,
            'isi_ulasan' => $this->isi_ulasan,
        ]);

        $this->closeModal();
        
        LivewireAlert::title('Ulasan berhasil dikirim!')
            ->success()
            ->position('center')
            ->timer(3000)
            ->show();

        // Emit event jika ingin merefresh list ulasan di komponen lain
        $this->dispatch('ulasanUpdated'); 
    }

    public function render()
    {
        return view('livewire.form-ulasan-katalog');
    }
}
