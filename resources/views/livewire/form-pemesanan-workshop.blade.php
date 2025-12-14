<form wire:submit="save" class="space-y-4">
    
    {{-- NAMA GRUP --}}
    <div>
        <label class="block text-xl font-semibold text-[#3A2415] mb-1">
            Nama Group
        </label>
        <input type="text" wire:model="nama_grup" placeholder="Man Lari"
            class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
        @error('nama_group') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- PILIH JADWAL (DROPDOWN) --}}
    <div>
        <label for="jadwal_id" class="block text-xl font-semibold text-[#3A2415] mb-1">
            Pilih Jadwal
        </label>
        
        <div class="relative">
            <select id="jadwal_id" wire:model="jadwal_id" 
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] bg-white focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent appearance-none">
                
                <option value="">-- Pilih Tanggal Workshop --</option>
                
                @foreach($jadwals as $jadwalItem)
                    @php
                        // Hitung Sisa Kuota Realtime
                        $terisi = $jadwalItem->pemesanans->where('jadwal_id', $jadwalItem->jadwal_id)->sum('jumlah');
                        $sisa = $jadwalItem->kuota - $terisi;
                    @endphp

                    {{-- Hanya tampilkan jika kuota masih ada --}}
                    <option 
                        wire:key="{{ $jadwalItem->jadwal_id }}"
                        value="{{ $jadwalItem->jadwal_id }}" {{ $sisa <= 0 ? 'disabled' : '' }}>
                        {{ \Carbon\Carbon::parse($jadwalItem->waktu_mulai)->format('d F Y, H:i -') }} 
                        {{ \Carbon\Carbon::parse($jadwalItem->waktu_selesai)->format('d F Y, H:i')}} 
                        (Sisa: {{ $sisa }} kursi)
                    </option>
                @endforeach

            </select>
            
        </div>

        @error('jadwal_id') 
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
        @enderror

        {{-- Pesan error khusus jika kuota penuh saat submit --}}
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mt-2">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- JUMLAH ANGGOTA --}}
    <div>
        <label for="jumlah_anggota" class="block text-xl font-semibold text-[#3A2415] mb-1">
            Banyak Anggota
        </label>
        <input type="number" id="jumlah_anggota" wire:model="jumlah_anggota" min="1"
            class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent"> 
        @error('jumlah_anggota') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="flex gap-4 pt-2">
        <a href="{{ route('store.show', $store->slug) }}"
            class="flex-1 border-2 py-3 border-[#3A2415] text-[#3A2415] text-lg tracking-wide rounded-md text-center font-semibold hover:bg-gray-50 transition">
            Balik
        </a>
        <div class="flex-1">
            <button type="submit"
                @disabled(!$isAuthenticated)
                class="w-full bg-[#3A2415] {{ $isAuthenticated ? '' : 'opacity-50 cursor-not-allowed' }} text-white py-3 text-lg tracking-wide rounded-md font-semibold hover:bg-[#2a180a] transition flex justify-center items-center gap-2">
                <span wire:loading.remove wire:target="save">Pesan</span>
                <span wire:loading wire:target="save">Memproses...</span>
            </button>
        </div>
    </div>
</form>