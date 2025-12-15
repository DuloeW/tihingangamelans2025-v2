<form wire:submit="save" class="space-y-4">

    {{-- NAMA GRUP --}}
    <div>
        <label for="nama_grup" class="block text-xl font-semibold text-[#3A2415] mb-1">
            Nama Grup
        </label>
        <input type="text" id="nama_grup" wire:model="nama_grup" placeholder="Man Lari"
            class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
        @error('nama_grup') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror  
    </div>

    {{-- PILIH JADWAL --}}
    <div class="flex gap-4">

        {{-- MULAI --}}
        <div class="flex-1">
            <label for="hari_mulai" class="block text-xl font-semibold text-[#3A2415] mb-1">
                Hari Mulai
            </label>
            <input type="datetime-local" id="hari_mulai" wire:model="hari_mulai"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
            @error('hari_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
        </div>


        {{-- SELESAI --}}
        <div class="flex-1">
            <label for="hari_selesai" class="block text-xl font-semibold text-[#3A2415] mb-1">
                Hari Selesai
            </label>
            <input type="datetime-local" id="hari_selesai" wire:model="hari_selesai"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
            @error('hari_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
        </div>

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