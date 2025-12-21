<?php

namespace App\Livewire;

use App\Models\Bisnis;
use App\Models\UlasanBisnis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class StoreReview extends Component
{
    public $store;
    public $ulasan;
    public $rating = ''; 

    public function mount($store)
    {
        $this->store = $store;
    }

    public function save()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'ulasan' => 'required|string|max:255',
        ]);

        try {
            UlasanBisnis::create([
                'pengguna_id' => Auth::id(),
                'bisnis_id' => $this->store->bisnis_id,
                'isi_ulasan' => $this->ulasan,
                'rating' => (int) $this->rating,
                'nama_pengulas' => Auth::user()->nama,
            ]);

            $this->reset(['rating', 'ulasan']);

            LivewireAlert::title('Ulasan berhasil ditambahkan!')
                        ->success()
                        ->position('center')
                        ->timer(1000)
                        ->show();
        } catch (\Exception $e) {
            //throw $th;
            LivewireAlert::title('Terjadi kesalahan saat menambahkan ulasan.')
                        ->error()
                        ->position('center')
                        ->timer(1000)
                        ->show();
        }

    }

    public function render()
    {
        // Ambil ulasan terbaru
        $reviews = $this->store->ulasanBisnis()
                            ->with('pengguna')
                            ->latest()->get();

        return view('livewire.store-review', [
            'reviews' => $reviews
        ]);
    }
}
