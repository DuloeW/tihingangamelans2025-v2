<?php

namespace App\Livewire;

use App\Models\Pemesanan;
use App\Traits\WhatsAppTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class FormPemesananKelas extends Component
{
    use WhatsAppTrait;

    public $catalog;
    public $store;

    public $nama_grup = '';
    public $hari_mulai = '';
    public $hari_selesai = '';
    public $jumlah_anggota = 1; 

    public function mount($catalog, $store)
    {
        $this->catalog = $catalog;
        $this->store = $store;
    }

    public function save() {
        if(!auth('web')->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'nama_grup'      => 'required|string|max:255',
            'hari_mulai'     => 'required|string|max:100',
            'hari_selesai'   => 'required|string|max:100',
            'jumlah_anggota' => 'required|integer|min:1',
        ]);

        try {

            $total_booking_hari = (new \DateTime($this->hari_selesai))->diff(new \DateTime($this->hari_mulai))->days + 1;
            $total_harga = ($this->catalog->harga * $this->jumlah_anggota) * $total_booking_hari;
            
            $pesanan = Pemesanan::create([
                'pengguna_id'           => auth('web')->id(),
                'katalog_id'            => $this->catalog->katalog_id,
                'tanggal_pemesanan'     => now(),
                'status'                => 'unpaid',
                'total_harga'           => $total_harga,
                'jumlah'                => $this->jumlah_anggota,
                'nama_grup'             => $this->nama_grup,
                'tgl_mulai_booking'     => $this->hari_mulai,
                'tgl_selesai_booking'   => $this->hari_selesai,
            ]);

            $wa_url = $this->generateWaUrl(
                $this->store,
                $this->catalog,
                $pesanan,
                [
                    "Nama Grup:"      => $this->nama_grup,
                    "Hari Mulai:"     => preg_replace('/[T]/', ' ', $this->hari_mulai),
                    "Hari Selesai:"   => preg_replace('/[T]/', ' ', $this->hari_selesai),
                    "Total Booking Hari:" => $total_booking_hari . " hari",
                ]
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
        return view('livewire.form-pemesanan-kelas', [
            'isAuthenticated' => auth('web')->check(),
        ]);
    }

    public function goToWa($data)
    {
        return redirect()->away($data['url']);
    }
}
