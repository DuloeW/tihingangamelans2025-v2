<div>
    {{-- Tombol Pemicu Modal --}}
    <button wire:click="openModal" 
            class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:bg-opacity-90 transition">
        Buat Ulasan
    </button>

    {{-- Modal Overlay --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative animate-fade-in-down">
            
            {{-- Header Modal --}}
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Beri Ulasan Katalog</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="save">
                
                {{-- Rating Bintang --}}
                <div class="mb-4 text-center">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating Anda</label>
                    <div class="flex justify-center gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition transform hover:scale-110">
                                <svg class="w-8 h-8 {{ $rating >= $i ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" 
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Komentar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                    <textarea wire:model="isi_ulasan" rows="4" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                              placeholder="Ceritakan pengalaman Anda tentang produk ini..."></textarea>
                    @error('isi_ulasan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
