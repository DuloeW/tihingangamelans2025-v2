<div>
    <div>
        {{-- List Ulasan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($reviews as $ulasan)
                <div class="w-full bg-white rounded-2xl shadow-md px-8 py-6 flex flex-col gap-2">
                    <div class="flex items-center gap-4 mb-2">
                        <img class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-sm" 
                                src="{{ $ulasan->pengguna->gambar ? asset('storage/' . $ulasan->pengguna->gambar) : asset('images/ulasan_profile.png') }}" 
                                alt="Ulasan Profile">
                        <span class="text-lg font-bold text-gray-800">{{ $ulasan->nama_pengulas }}</span>
                    </div>
                    <div class="flex gap-3 text-sm font-medium text-orange-500 mb-1">
                        @php
                            $ratingLabel = match($ulasan->rating) {
                                5 => 'Sangat Bagus',
                                4 => 'Bagus',
                                3 => 'Cukup',
                                2 => 'Kurang',
                                1 => 'Tidak Memuaskan',
                                default => 'Tidak Ada Rating'
                            };
                        @endphp
                        <span class="bg-orange-50 rounded px-2 py-0.5">{{ $ratingLabel }}</span>
                    </div>
                    <blockquote class="mt-2 text-base italic text-[#7c4a1e] font-medium leading-relaxed">"{{ $ulasan->isi_ulasan }}"</blockquote>
                    <span class="text-xs text-gray-400 mt-2">{{ $ulasan->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada ulasan untuk toko ini.</p>
            @endforelse
        </div>
    </div>

    <div class="mt-10">
        <hr class="mb-4">
        <h2 class="text-3xl font-semibold text-primary mb-2">Berikan Ulasan</h2>
        
        @auth
            <div class="space-y-4">
                <div class="flex gap-8 mb-2">
                    <select wire:model="rating"
                        class="border border-gray-400 rounded-md p-3 text-primary focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="" disabled>Pilih Rating</option>
                        <option value="5" selected>Sangat Bagus</option>
                        <option value="4">Bagus</option>
                        <option value="3">Cukup</option>
                        <option value="2">Kurang</option>
                        <option value="1">Tidak Memuaskan</option>
                    </select>
                </div>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea wire:model="ulasan" rows="4"
                    class="w-full border border-gray-400 rounded-md p-3 text-primary placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Ceritakan pengalaman anda berbelanja di sini..."></textarea>
                @error('ulasan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <button wire:click="save"
                    class="w-full bg-[#3A2415] text-white py-2 rounded-md text-base tracking-wide hover:bg-[#2a1a0f] transition-colors disabled:opacity-50" wire:loading.attr="disabled">
                    <span wire:loading.remove>Kirim Ulasan</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </div>
        @else
            <div class="bg-gray-50 p-6 rounded-lg text-center border border-gray-200">
                <p class="text-gray-600 mb-4">Silakan login terlebih dahulu untuk memberikan ulasan.</p>
                <a href="{{ route('login') }}" class="inline-block bg-primary text-white px-6 py-2 rounded-md hover:bg-primary/90 transition-colors">Login</a>
            </div>
        @endauth
    </div>
</div>
