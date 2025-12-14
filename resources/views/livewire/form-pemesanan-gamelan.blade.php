<form wire:submit="save" class="space-y-4">
    {{-- JUMLAH GAMELAN --}}
    <div>
        <label for="jumlah_gamelan" class="block text-xl font-semibold text-[#3A2415] mb-1">Jumlah Gamelan</label>
        <input 
            type="number" 
            id="jumlah_gamelan" 
            wire:model="jumlah_gamelan" 
            min="1" 
            class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
    </div>

    {{-- NAMA PENEMERIMA --}}
    <div>
        <label for="nama_penerima" class="block text-xl font-semibold text-[#3A2415] mb-1">Nama Penerima</label>
        <input 
            type="text" 
            id="nama_penerima" 
            wire:model="nama_penerima" 
            class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
    </div>

    {{-- ALAMAT PENEMERIMA --}}
    <div>
        @livewire('alamat-selector')
    </div>

    {{-- AlAMAT LENGKAP --}}
    <div>
        <label for="alamat_lengkap" class="block text-xl font-semibold text-[#3A2415] mb-1">Alamat Lengkap</label>
        <textarea id="alamat_lengkap" wire:model="alamat_lengkap" class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent"></textarea>
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