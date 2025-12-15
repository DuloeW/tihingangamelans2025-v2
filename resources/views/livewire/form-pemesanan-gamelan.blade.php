<div>
    <form wire:submit.prevent="openModal"  class="space-y-4">
        {{-- JUMLAH GAMELAN --}}
        <div>
            <label for="jumlah_gamelan" class="block text-xl font-semibold text-[#3A2415] mb-1">Jumlah Gamelan</label>
            <input 
                type="number" 
                id="jumlah_gamelan" 
                wire:model="jumlah_gamelan" 
                min="1" 
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
            @error('jumlah_gamelan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        {{-- NAMA PENEMERIMA --}}
        <div>
            <label for="nama_penerima" class="block text-xl font-semibold text-[#3A2415] mb-1">Nama Penerima</label>
            <input 
                type="text" 
                id="nama_penerima" 
                wire:model="nama_penerima" 
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                @error('nama_penerima') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        {{-- ALAMAT PENEMERIMA --}}
        <div>
            @livewire('alamat-selector')
        </div>
    
        {{-- AlAMAT LENGKAP --}}
        <div>
            <label for="alamat_lengkap" class="block text-xl font-semibold text-[#3A2415] mb-1">Alamat Lengkap</label>
            <textarea id="alamat_lengkap" wire:model="alamat_lengkap" class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent"></textarea>
            @error('alamat_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        {{-- TOMBOL AKSI --}}
        <div class="flex gap-4 pt-2">
            <a href="{{ route('store.show', $store->slug) }}"
                class="flex-1 border-2 py-3 border-[#3A2415] text-[#3A2415] text-lg tracking-wide rounded-md text-center font-semibold hover:bg-gray-50 transition">
                Balik
            </a>
            <div class="flex-1">
    
                <button 
                    @disabled(!$isAuthenticated)
                    type="submit" 
                    class="w-full bg-[#3A2415] {{ $isAuthenticated ? '' : 'opacity-50 cursor-not-allowed' }} text-white py-3 text-lg tracking-wide rounded-md font-semibold hover:bg-[#2a180a] transition flex justify-center items-center gap-2">
                    <span wire:loading.remove wire:target="openModal">
                        Cek Pesanan
                    </span>
                    <span wire:loading wire:target="openModal">
                        Memproses...
                    </span>
                </button>
    
            </div>
        </div>
    
    </form>

    @if($isShowModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">
        
        {{-- Kotak Modal --}}
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in-up">
            
            {{-- Header Modal --}}
            <div class="bg-[#3A2415] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Konfirmasi Pesanan</h3>
                <button wire:click="closeModal" class="text-white hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- Body Modal (Rincian) --}}
            <div class="p-6 space-y-4 text-gray-700">
                <p class="text-sm text-gray-500">Pastikan detail pesanan Anda sudah benar sebelum melanjutkan ke WhatsApp.</p>
                
                <div class="bg-gray-50 p-4 rounded-lg space-y-2 border border-gray-100">
                    <div class="flex justify-between">
                        <span class="font-semibold">Produk:</span>
                        <span>{{ $catalog->nama }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Jumlah:</span>
                        <span>{{ $jumlah_gamelan }} item</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Harga Satuan:</span>
                        <span>Rp {{ number_format($catalog->harga, 0, ',', '.') }}</span>
                    </div>
                    <hr class="border-dashed border-gray-300 my-2">
                    <div class="flex justify-between text-lg font-bold text-[#3A2415]">
                        <span>Total Bayar:</span>
                        <span>Rp {{ number_format($catalog->harga * $jumlah_gamelan, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div>
                    <span class="font-semibold block mb-1">Alamat Pengiriman:</span>
                    <p class="text-sm bg-gray-50 p-3 rounded border border-gray-100 italic">
                        {{ $alamat_lengkap ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Footer Modal (Tombol Aksi) --}}
            <div class="bg-gray-100 px-6 py-4 flex gap-3 justify-end">
                <button wire:click="closeModal" 
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </button>
                
                <button wire:click="confirmPesanan" 
                        wire:loading.attr="disabled"
                        class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition flex items-center gap-2 shadow-lg">
                    <span wire:loading.remove wire:target="confirmPesanan">
                        Ya, Lanjut ke WhatsApp
                    </span>
                    <span wire:loading wire:target="confirmPesanan">
                        Memproses...
                    </span>
                    {{-- Icon WA --}}
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>