<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
    <div class="flex flex-col gap-2">
        <label class="font-bold text-xl text-primary">Provinsi</label>
        <select wire:model.live="selectedProvince" name="province_id" class="border p-2 rounded-md">
            <option value="">Pilih Provinsi</option>
            @foreach($provinces as $code => $name)
                <option value="{{ $code }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-bold text-xl text-primary">Kabupaten/Kota</label>
        <select wire:model.live="selectedCity" name="city_id" class="border p-2 rounded-md" {{ empty($cities) ? 'disabled' : '' }}>
            <option value="">Pilih Kabupaten</option>
            @foreach($cities as $code => $name)
                <option value="{{ $code }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-bold text-xl text-primary">Kecamatan</label>
        <select wire:model.live="selectedDistrict" name="district_id" class="border p-2 rounded-md" {{ empty($districts) ? 'disabled' : '' }}>
            <option value="">Pilih Kecamatan</option>
            @foreach($districts as $code => $name)
                <option value="{{ $code }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

</div>