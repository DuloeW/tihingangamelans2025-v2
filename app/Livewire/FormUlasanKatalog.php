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
    public $pemesanan_id;
    public $rating = 0;
    public $isi_ulasan;
    public $showModal = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'isi_ulasan' => 'required|string|max:500',
    ];

    public function mount($katalogId, $pemesananId = null)
    {
        $this->katalog_id = $katalogId;
        $this->pemesanan_id = $pemesananId;
    }

    public function openModal()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user berhak mengulas pesanan ini
        $query = Pemesanan::where('pengguna_id', Auth::id())
            ->where('katalog_id', $this->katalog_id);

        if ($this->pemesanan_id) {
            $query->where('pemesanan_id', $this->pemesanan_id);
        }

        $pemesanan = $query->first();

        if (!$pemesanan) {
            LivewireAlert::title('Anda tidak memiliki akses untuk mengulas pesanan ini.')
                ->error()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        // Validasi Status Pemesanan
        if (in_array($pemesanan->status, ['unpaid', 'cancelled'])) {
            LivewireAlert::title('Pesanan belum selesai atau dibatalkan, tidak dapat memberikan ulasan.')
                ->warning()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        // Cek apakah sudah pernah diulas (double check)
        if ($this->pemesanan_id) {
            $alreadyReviewed = UlasanKatalog::where('pemesanan_id', $this->pemesanan_id)->exists();
            if ($alreadyReviewed) {
                LivewireAlert::title('Pesanan ini sudah diulas.')
                    ->warning()
                    ->position('center')
                    ->timer(3000)
                    ->show();
                return;
            }
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

        // Validasi kepemilikan pesanan
        $query = Pemesanan::where('pengguna_id', Auth::id())
            ->where('katalog_id', $this->katalog_id);

        if ($this->pemesanan_id) {
            $query->where('pemesanan_id', $this->pemesanan_id);
        }

        $pemesanan = $query->first();

        if (!$pemesanan) {
            LivewireAlert::title('Anda tidak memiliki akses untuk mengulas pesanan ini.')
                ->error()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        // Validasi Status Pemesanan
        if (in_array($pemesanan->status, ['unpaid', 'cancelled'])) {
            LivewireAlert::title('Pesanan belum selesai atau dibatalkan, tidak dapat memberikan ulasan.')
                ->warning()
                ->position('center')
                ->timer(3000)
                ->show();
            return;
        }

        // Cek duplikasi ulasan
        if ($this->pemesanan_id) {
            $alreadyReviewed = UlasanKatalog::where('pemesanan_id', $this->pemesanan_id)->exists();
            if ($alreadyReviewed) {
                LivewireAlert::title('Pesanan ini sudah diulas.')
                    ->warning()
                    ->position('center')
                    ->timer(3000)
                    ->show();
                return;
            }
        }

        $this->validate();

        UlasanKatalog::create([
            'katalog_id' => $this->katalog_id,
            'pemesanan_id' => $this->pemesanan_id,
            'pengguna_id' => Auth::id(),
            'nama_pengulas' => Auth::user()->nama ?? 'Pengguna',
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
        
        // Refresh halaman agar status tombol berubah
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.form-ulasan-katalog');
    }
}
