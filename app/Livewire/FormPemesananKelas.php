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
    public $total_harga = 0;
    public $total_booking_hari = 0;

    public $isShowModal = false;

    public function mount($catalog, $store)
    {
        $this->catalog = $catalog;
        $this->store = $store;
    }

    public function openModal() 
    {
         if(!auth('web')->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'nama_grup'      => 'required|string|max:255',
            'hari_mulai'     => 'required|string|max:100',
            'hari_selesai'   => 'required|string|max:100',
            'jumlah_anggota' => 'required|integer|min:1',
        ]);

        // Validasi: cek apakah tanggal mulai atau selesai sebelum hari ini
        $hariMulai = new \DateTime($this->hari_mulai);
        $hariSelesai = new \DateTime($this->hari_selesai);
        $sekarang = new \DateTime();
        
        if ($hariMulai < $sekarang) {
            LivewireAlert::title('Gagal')
                ->text('Tanggal mulai booking tidak boleh sebelum hari ini.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }
        
        if ($hariSelesai < $sekarang) {
            LivewireAlert::title('Gagal')
                ->text('Tanggal selesai booking tidak boleh sebelum hari ini.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }
        
        if ($hariSelesai < $hariMulai) {
            LivewireAlert::title('Gagal')
                ->text('Tanggal selesai tidak boleh sebelum tanggal mulai.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }
        
        // Validasi: cek jam operasional (08:00 - 17:00)
        $jamMulai = (int)$hariMulai->format('H');
        $jamSelesai = (int)$hariSelesai->format('H');
        
        if ($jamMulai < 8 || $jamMulai >= 17) {
            LivewireAlert::title('Gagal')
                ->text('Jam mulai harus antara pukul 08:00 - 17:00.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }
        
        if ($jamSelesai < 8 || $jamSelesai >= 17) {
            LivewireAlert::title('Gagal')
                ->text('Jam selesai harus antara pukul 08:00 - 17:00.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }

        // Validasi: cek apakah tanggal mulai booking sudah ada pemesanan
        $existingPemesanan = Pemesanan::where('katalog_id', $this->catalog->katalog_id)
            ->where('tgl_mulai_booking', $this->hari_mulai)
            ->exists();
        
        if ($existingPemesanan) {
            LivewireAlert::title('Gagal')
                ->text('Tanggal mulai booking yang Anda pilih sudah terdaftar. Silakan pilih tanggal yang berbeda.')
                ->error()
                ->withConfirmButton('OK')
                ->show();
            
            return;
        }

        $this->total_booking_hari = (new \DateTime($this->hari_selesai))->diff(new \DateTime($this->hari_mulai))->days + 1;
        $this->total_harga = ($this->catalog->harga * $this->jumlah_anggota) * $this->total_booking_hari;
            
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
                'pengguna_id'           => auth('web')->id(),
                'katalog_id'            => $this->catalog->katalog_id,
                'tanggal_pemesanan'     => now(),
                'status'                => 'unpaid',
                'total_harga'           => $this->total_harga,
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
                    "Total Booking Hari:" => $this->total_booking_hari . " hari",
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
        $this->isShowModal = false;
        return redirect()->away($data['url']);
    }
}
