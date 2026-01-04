<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pemesanan;
use App\Traits\WhatsAppTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class FormPemesananWorkshop extends Component
{
    use WhatsAppTrait;
    
    public $catalog;
    public $store;
    public $jadwals;
    
    public $nama_grup = ''; 
    public $jumlah_anggota = 1;
    public $jadwal_id = '';
    public $total_harga = 0;    

    public $jadwal_workshop = '';

    public $isShowModal = false;

    public function mount($catalog, $store, $jadwals)
    {
        $this->catalog = $catalog;
        $this->store = $store;
        $this->jadwals = $jadwals;
    }

    public function openModal()
    {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'nama_grup'      => 'required|string|max:255',
            'jumlah_anggota' => 'required|integer|min:1',
            'jadwal_id'      => 'required|exists:jadwal,jadwal_id', // Pastikan user memilih jadwal
        ]);

        $this->jadwal_workshop = $this->jadwals->where('jadwal_id', $this->jadwal_id)->first();
        $this->total_harga = $this->catalog->harga * $this->jumlah_anggota;
        
        return $this->isShowModal = true;
    }

    public function closeModal()
    {
        $this->isShowModal = false;
    }

    public function confirmPesanan()
    {   
        try {
            $pesanan = Pemesanan::create([
                'pengguna_id'       => auth('web')->id(),
                'katalog_id'        => $this->catalog->katalog_id,
                'jadwal_id'         => $this->jadwal_id, // Ambil dari wire:model
                'tanggal_pemesanan' => now(),
                'status'            => 'unpaid',
                'total_harga'       => $this->total_harga,
                'jumlah'            => $this->jumlah_anggota,
                'nama_grup'         => $this->nama_grup,
            ]);

            $wa_url = $this->generateWaUrl(
                $this->store,
                $this->catalog,
                $pesanan,
                [
                    "Nama Grup:" => $this->nama_grup,
                    "Mulai Workshop:" => $this->jadwals->where('jadwal_id', $this->jadwal_id)->first()->waktu_mulai,
                    "Selesai Workshop:" => $this->jadwals->where('jadwal_id', $this->jadwal_id)->first()->waktu_selesai,
                ],
            );

            LivewireAlert::title('Success')
                ->text('Pesanan berhasil dibuat')
                ->success()
                ->timer(3000)
                ->withConfirmButton('OK')
                ->onConfirm('goToWa', ['url' => $wa_url])
                ->onDeny('goToWa', ['url' => $wa_url])
                ->onDismiss('goToWa', ['url' => $wa_url])
                ->show();
        } catch (\Exception $e) {
            LivewireAlert::title('Error')
                ->text('Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage())
                ->error()
                ->withConfirmButton('OK')
                ->show();
            return;
        }
    }

    public function render()
    {
        return view('livewire.form-pemesanan-workshop', [
            'isAuthenticated' => auth('web')->check(),
        ]);
    }

    public function goToWa($data)
    {
        $this->isShowModal = false;
        return redirect()->away($data['url']);
    }
}