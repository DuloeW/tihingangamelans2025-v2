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
                    <div class="flex items-center gap-1 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $ulasan->rating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" 
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="text-xs text-gray-500 ml-2">({{ $ulasan->rating }}/5)</span>
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
                <div x-data="{ hoverRating: 0 }" class="flex items-center gap-1 mb-4">
                    <span class="text-gray-700 font-medium mr-2">Rating:</span>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" 
                                wire:click="$set('rating', {{ $i }})" 
                                @mouseenter="hoverRating = {{ $i }}" 
                                @mouseleave="hoverRating = 0"
                                class="focus:outline-none transition-transform hover:scale-110 p-1">
                                <svg class="w-8 h-8 transition-colors" 
                                     :class="{ 'text-yellow-400 fill-current': hoverRating >= {{ $i }} || (!hoverRating && '{{ $rating }}' >= {{ $i }}), 'text-gray-300': !(hoverRating >= {{ $i }} || (!hoverRating && '{{ $rating }}' >= {{ $i }})) }"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <span class="ml-2 text-sm text-gray-600 font-medium">
                        @if($rating)
                            {{ match((int)$rating) {
                                5 => 'Sangat Bagus',
                                4 => 'Bagus',
                                3 => 'Cukup',
                                2 => 'Kurang',
                                1 => 'Tidak Memuaskan',
                                default => ''
                            } }}
                        @endif
                    </span>
                </div>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea wire:model="ulasan" rows="4"
                    class="w-full border border-gray-400 rounded-md p-3 text-primary placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Ceritakan pengalaman anda berbelanja di sini..."></textarea>
                @error('ulasan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <button wire:click="save"
                    class="w-full bg-[#3A2415] text-white py-2 rounded-md text-base tracking-wide hover:bg-[#2a1a0f] transition-colors disabled:opacity-50" 
                    wire:loading.attr="disabled" 
                    wire:target="save">
                    <span wire:loading.remove wire:target="save">Kirim Ulasan</span>
                    <span wire:loading wire:target="save">Mengirim...</span>
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
