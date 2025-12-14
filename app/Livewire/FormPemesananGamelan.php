<?php

namespace App\Livewire;

use App\Models\Pemesanan;
use App\Traits\WhatsAppTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class FormPemesananGamelan extends Component
{

    use WhatsAppTrait;

    public $store;
    public $catalog;

    public $jumlah_gamelan = 1;
    public $nama_penerima = '';
    public $province_code = '';
    public $city_code = '';
    public $district_code = '';
    public $alamat_lengkap = '';

    public function mount($store, $catalog) {
        $this->store = $store;
        $this->catalog = $catalog;
    }

    #[On('alamat-update')] 
    public function updateAlamat($data)
    {
        // dd($data);
        if($data == null) {
            $this->province_code = '';
            $this->city_code = '';
            $this->district_code = '';
        } 

        $this->province_code = $data['province_code'];
        $this->city_code = $data['city_code'];
        $this->district_code = $data['district_code'];

    }

    public function save() 
    {

        if(!auth('web')->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'jumlah_gamelan' => 'required|integer|min:1',
            'nama_penerima' => 'required|string|max:255',
            'province_code' => 'required|exists:indonesia_provinces,code',
            'city_code' => 'required|exists:indonesia_cities,code',
            'district_code' => 'required|exists:indonesia_districts,code',
            'alamat_lengkap' => 'required|string|max:500',
        ]);

        try {
            $total_harga = $this->catalog->harga * $this->jumlah_gamelan;
        
            $pesanan = Pemesanan::create([
                'pengguna_id' => auth('web')->id(),
                'katalog_id' => $this->catalog->katalog_id,
                'penerima' => $this->nama_penerima,
                'provice_code' => $this->province_code,
                'city_code' => $this->city_code,
                'status' => 'unpaid',
                'total_harga' => $total_harga,
                'alamat_lengkap' => $this->alamat_lengkap,
                'jumlah' => $this->jumlah_gamelan,
                'tanggal_pemesanan' => now(),
            ]);

            $wa_url = $this->generateWaUrl(
                $this->store,
                $this->catalog,
                $pesanan,
            );

        
            LivewireAlert::title('Success')
                ->text('Pesanan berhasil dibuat ')
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
                ->timer(3000)
                ->show();
            return;
        }

    }

    public function render()
    {
        return view('livewire.form-pemesanan-gamelan', [
            'isAuthenticated' => auth('web')->check(),
        ]);
    }

    public function goToWa($data)
    {
        return redirect()->away($data['url']);
    }
}
