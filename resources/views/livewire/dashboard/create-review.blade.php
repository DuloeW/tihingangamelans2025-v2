<div>
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm p-4">
        
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden transform transition-all">
            
            <div class="bg-primary px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-lg">Nilai Produk: {{ $nama }}</h3>
                <button wire:click="closeModal" class="text-2xl hover:text-gray-200">&times;</button>
            </div>

            <div class="p-6">
                <form wire:submit.prevent="simpan">
                    
                    <div class="mb-6 text-center">
                        <label class="block text-gray-700 font-bold mb-2">Berapa bintang untuk produk ini?</label>
                        <div class="flex justify-center gap-3">
                            @foreach([1,2,3,4,5] as $star)
                                <button type="button" wire:click="$set('rating', {{ $star }})" 
                                    class="text-4xl transition transform hover:scale-110 {{ $rating >= $star ? 'text-yellow-400' : 'text-gray-300' }}">
                                    ★
                                </button>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Rating: {{ $rating }}/5</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Ceritakan pengalamanmu</label>
                        <textarea wire:model="isi_ulasan" rows="4" 
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-primary focus:border-primary outline-none"
                            placeholder="Kualitas barang bagus, pengiriman cepat..."></textarea>
                        @error('isi_ulasan') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2 rounded-xl text-gray-600 hover:bg-gray-100 font-semibold">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-primary text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>