@php
    $containerClass = match ($layout) {
        'register' => 'flex flex-col gap-6 w-full',
        'profile' => 'contents',
        default => 'grid grid-cols-1 md:grid-cols-3 gap-4',
    };
@endphp

{{-- // TODO tambahkan outline/border supaya masuk dengan design form lainnya --}}
<div class="{{ $containerClass }}">
    {{-- Input Provinsi --}}
    <div class="flex flex-col gap-2">
        <x-input-label for="province" :value="__('Provinsi')" />
        <select wire:model.live="selectedProvince" name="province_code"
            class="bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] focus:ring-2 focus:ring-[#3E2C22] block w-full">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinces as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Input Kota --}}
    <div class="flex flex-col gap-2">
        <x-input-label for="city" :value="__('Kabupaten/Kota')" />
        <select wire:model.live="selectedCity" name="city_code"
            class="bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] focus:ring-2 focus:ring-[#3E2C22] block w-full"
            @if (empty($cities)) disabled @endif>
            <option value="">Pilih Kabupaten</option>
            @foreach ($cities as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Input Kecamatan --}}
    <div class="flex flex-col gap-2">
        <x-input-label for="district" :value="__('Kecamatan')" />
        <select wire:model.live="selectedDistrict" name="district_code"
            class="bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] focus:ring-2 focus:ring-[#3E2C22] block w-full"
            @if (empty($districts)) disabled @endif>
            <option value="">Pilih Kecamatan</option>
            @foreach ($districts as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

</div>
