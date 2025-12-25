<?php

namespace App\Livewire;

use App\Models\UlasanKatalog;
use Livewire\Component;
use Livewire\WithPagination;

class ListUlasanKatalog extends Component
{
    use WithPagination;

    public $katalog_id;

    public function mount($katalogId)
    {
        $this->katalog_id = $katalogId;
    }

    public function render()
    {
        $ulasan = UlasanKatalog::where('katalog_id', $this->katalog_id)
            ->latest()
            ->paginate(5);

        return view('livewire.list-ulasan-katalog', [
            'ulasan' => $ulasan
        ]);
    }
}
