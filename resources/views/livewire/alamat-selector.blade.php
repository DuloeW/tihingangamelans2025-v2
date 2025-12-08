<div>
    @php
        $containerClass = match($layout) {
            'register' => 'flex flex-col gap-6 w-full', 
            default    => 'grid grid-cols-1 md:grid-cols-3 gap-4', 
        };

    @endphp

    <div class="{{ $containerClass }}">
        
        <div class="flex flex-col gap-2">
            <x-input-label for="province" :value="__('Provinsi')" />
            <select wire:model.live="selectedProvince" name="province_code" class="bg-gray-50 border border-gray-300 text-primary text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-2">
            <x-input-label for="city" :value="__('Kabupaten/Kota')" />
            <select wire:model.live="selectedCity" name="city_code" class="bg-gray-50 border border-gray-300 text-primary text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" @if(empty($cities)) disabled @endif>
                <option value="">Pilih Kabupaten</option>
                @foreach($cities as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-2">
            <x-input-label for="district" :value="__('Kecamatan')" />
            <select wire:model.live="selectedDistrict" name="district_code" class="bg-gray-50 border border-gray-300 text-primary text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" @if(empty($districts)) disabled @endif>
                <option value="">Pilih Kecamatan</option>
                @foreach($districts as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>