<x-global-layout>

    <x-slot:title>
        Store {{ $slug }}
    </x-slot:title>


    <div class="min-h-[480px] px-20 pb-20 font-markazi" x-data="{ activeTab: '{{ session('activeTab', 'katalog') }}' }">

        <div class="max-w-8xl mx-auto mt-6">
            <div class="flex items-center border text-primary border-gray-300 rounded-xl px-6 py-4 bg-white shadow-sm">
                <!-- Gambar kiri -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('storage/' . $store->gambar) }}" alt="Logo Toko"
                        class="w-20 h-20 rounded-full border border-gray-200 object-cover" />
                </div>
                <!-- Info toko tengah -->
                <div class="flex-1 ml-6">
                    <h2 class="text-3xl font-semibold tracking-wide">{{ $store->nama }}</h2>
                    <p class="text-xl font-medium leading-snug mt-1">{{ $store->deskripsi }}</p>
                </div>
                <!-- Rating kanan -->
                <div class="flex flex-col items-end ml-6">
                    <h2 class="text-3xl font-bold text-primary">Baik</h2>
                    <p class="text-sm text-primary/30 mt-1">Rating & Ulasan</p>
                </div>
            </div>
        </div>

        <div class="w-full max-h-40 flex gap-5 mt-4 border-b-2 py-6">
            <button @click="activeTab = 'katalog'"
                :class="activeTab === 'katalog' ?
                    'bg-primary text-white rounded-md' :
                    'text-primary '"
                class="px-10 py-3 ">
                Katalog
            </button>
            <button @click="activeTab = 'ulasan'"
                :class="activeTab === 'ulasan' ?
                    'bg-primary text-white rounded-md' :
                    'text-primary '"
                class="px-10 py-3 ">
                Ulasan
            </button>
        </div>

        @php
            $jenisBisnis = $store->tags->pluck('jenis')->toArray()    
        @endphp

        {{-- KATALOG --}}
        <div class="w-full mt-10" x-show="activeTab === 'katalog'">
            <div class="flex flex-col gap-10">
                @if (in_array('Purchase', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Gamelans</h2>
                        <p class="text-xl">Gamelan yang kami sediakan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($gamelans as $gamelan)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$gamelan->nama" 
                                        :deskripsi="$gamelan->deskripsi" 
                                        :price="$gamelan->harga"
                                        :slug="$slug"
                                        :jenis="$gamelan->jenis"
                                        :katalog_id="$gamelan->katalog_id"
                                        :gambar="$gamelan->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog gamelan tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                @if (in_array('Workshop', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Workshop</h2>
                        <p class="text-xl">Berbagai macam workshop gamelan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($workshops as $workshop)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$workshop->nama" 
                                        :deskripsi="$workshop->deskripsi" 
                                        :price="$workshop->harga"
                                        :slug="$slug"
                                        :jenis="$workshop->jenis"
                                        :katalog_id="$workshop->katalog_id"
                                        :gambar="$workshop->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog workshop tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                @if (in_array('Learn', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Kelas Belajar</h2>
                        <p class="text-xl">Berbagai macam kelas gamelan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($classes as $class)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$class->nama" 
                                        :deskripsi="$class->deskripsi" 
                                        :price="$class->harga"
                                        :slug="$slug"
                                        :jenis="$class->jenis"
                                        :katalog_id="$class->katalog_id"
                                        :gambar="$class->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog kelas belajar tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Ulasan Bisnis --}}
        <div class="w-full mt-10" x-show="activeTab === 'ulasan'">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative mb-6 flex items-center gap-2" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif
            <div>
                <div>
                    {{-- List Ulasan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($store->ulasanBisnis as $ulasan)
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
                        <form method="POST" action="{{ route('store.review.store', $slug) }}" class="space-y-4">
                            @csrf
                            <div class="flex gap-8 mb-2">
                                <label class="font-semibold text-primary text-base cursor-pointer">
                                    <input type="radio" name="rating" value="Sangat Bagus" class="hidden peer" required>
                                    <span class="peer-checked:underline peer-checked:text-amber-600 transition-colors">Sangat Bagus</span>
                                </label>
                                <label class="font-semibold text-primary text-base cursor-pointer">
                                    <input type="radio" name="rating" value="Bagus" class="hidden peer">
                                    <span class="peer-checked:underline peer-checked:text-amber-600 transition-colors">Bagus</span>
                                </label>
                                <label class="font-semibold text-primary text-base cursor-pointer">
                                    <input type="radio" name="rating" value="Cukup" class="hidden peer">
                                    <span class="peer-checked:underline peer-checked:text-amber-600 transition-colors">Cukup</span>
                                </label>
                                <label class="font-semibold text-primary text-base cursor-pointer">
                                    <input type="radio" name="rating" value="Kurang" class="hidden peer">
                                    <span class="peer-checked:underline peer-checked:text-amber-600 transition-colors">Kurang</span>
                                </label>
                            </div>
                            <textarea name="ulasan" rows="4" required
                                class="w-full border border-gray-400 rounded-md p-3 text-primary placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Ceritakan pengalaman anda berbelanja di sini..."></textarea>
                            <button type="submit"
                                class="w-full bg-[#3A2415] text-white py-2 rounded-md text-base tracking-wide hover:bg-[#2a1a0f] transition-colors">Kirim Ulasan</button>
                        </form>
                    @else
                        <div class="bg-gray-50 p-6 rounded-lg text-center border border-gray-200">
                            <p class="text-gray-600 mb-4">Silakan login terlebih dahulu untuk memberikan ulasan.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-primary text-white px-6 py-2 rounded-md hover:bg-primary/90 transition-colors">Login</a>
                        </div>
                    @endauth
                </div>
            </div>

        </div>
    </div>

</x-global-layout>
