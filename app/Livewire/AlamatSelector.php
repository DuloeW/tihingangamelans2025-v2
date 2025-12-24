<?php

namespace App\Livewire;

use Livewire\Component;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class AlamatSelector extends Component
{
    //Variabel ubah layout
    public $layout = 'register';

    // Variabel untuk menampung data dropdown
    public $provinces;
    public $cities = [];
    public $districts = [];

    // Variabel untuk menampung Pilihan User (Model Binding)
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedDistrict = null;

    // Load Provinsi saat pertama kali komponen dimuat
    public function mount($layout = 'register')
    {
        $this->layout = $layout;
        $this->provinces = Province::pluck('name', 'code')->sortBy(function($name) {
            return $name;
        });
    }

    // LISTENER: Berjalan otomatis saat user memilih Provinsi
    public function updatedSelectedProvince($provinceId)
    {
        // 1. Ambil Kabupaten berdasarkan Kode Provinsi
        $this->cities = City::where('province_code', $provinceId)->pluck('name', 'code')->sortBy(function($name) {
            return $name;
        });

        // 2. Reset pilihan di bawahnya agar tidak error
        $this->districts = [];
        $this->selectedCity = null;
        $this->selectedDistrict = null;
    }

    // LISTENER: Berjalan otomatis saat user memilih Kabupaten
    public function updatedSelectedCity($cityId)
    {
        // 1. Ambil Kecamatan berdasarkan Kode Kabupaten
        $this->districts = District::where('city_code', $cityId)->pluck('name', 'code')->sortBy(function($name) {
            return $name;
        });
        
        // 2. Reset pilihan di bawahnya
        $this->selectedDistrict = null;
    }

    public function updatedSelectedDistrict($districtId)
    {
        $this->dispatch('alamat-update', [
            'province_code' => $this->selectedProvince,
            'city_code' => $this->selectedCity,
            'district_code' => $this->selectedDistrict,
        ]);
    }

    public function render()
    {
        $provice_code = $this->selectedProvince;
        $city_code = $this->selectedCity;
        $district_code = $this->selectedDistrict;
        return view('livewire.alamat-selector', compact('provice_code', 'city_code', 'district_code'));
    }
}