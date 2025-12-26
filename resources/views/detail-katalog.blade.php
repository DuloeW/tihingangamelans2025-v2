<x-global-layout>
    <x-slot:title>
        Detail Katalog
    </x-slot:title>

    <div class="px-20 py-5 font-markazi">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-10">
            <div class="flex gap-8">
                <!-- Gambar Produk & Informasi -->
                <div class="w-2/5 flex flex-col">
                    {{-- Product Image Card --}}
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-[#7A2420] to-[#3A2415] rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                        <div class="relative bg-[#FAF8F3] rounded-2xl p-6 flex items-center justify-center aspect-square">
                            <img src="{{ asset('storage/' . $catalog->gambar) }}" alt="{{ $catalog->nama }}"
                                class="max-w-full max-h-72 object-contain drop-shadow-2xl transition-transform duration-300 group-hover:scale-105">
                        </div>
                    </div>
                    
                    {{-- Product Details Card --}}
                    <div class="mt-6 space-y-5">
                        {{-- Type Badge & Rating --}}
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-4 py-2 bg-[#3A2415] text-[#FAF8F3] text-sm font-semibold rounded-full uppercase tracking-wider">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                                {{ $catalog->jenis }}
                            </span>
                            {{-- Rating Stars --}}
                            <div class="flex items-center gap-1">
                                @php $rating = $catalog->average_rating ?? 0; @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="text-[#3A2415]/60 text-sm ml-1">({{ number_format($rating, 1) }})</span>
                            </div>
                        </div>

                        {{-- Product Name --}}
                        <div>
                            <h1 class="text-4xl lg:text-5xl text-[#3A2415] font-bold leading-tight">{{ $catalog->nama }}</h1>
                        </div>
                        
                        {{-- Description --}}
                        <p class="text-[#3A2415]/80 text-xl leading-relaxed border-l-4 border-[#7A2420] pl-4">
                            {{ $catalog->deskripsi }}
                        </p>
                        
                        {{-- Price Card --}}
                        <div class="bg-[#3A2415] rounded-2xl p-6 flex items-center justify-between">
                            <div>
                                <p class="text-[#FAF8F3]/60 text-sm uppercase tracking-wider mb-1">Harga</p>
                                <p class="text-4xl font-bold text-[#FAF8F3]">
                                    Rp {{ number_format($catalog->harga, 0, ',', '.') }}
                                    @if ($catalog->jenis == 'Workshop')
                                        <span class="text-xs"> / anggota</span>
                                    @elseif ($catalog->jenis == 'Kelas')
                                        <span class="text-xs"> / hari & anggota</span>
                                    @endif
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Pemesanan -->
                <div class="flex-1 p-6">
                    @switch($catalog->jenis)
                        @case('Workshop')
                            @livewire('form-pemesanan-workshop', 
                                ['catalog' => $catalog, 
                                'store' => $store, 
                                'jadwals' => $jadwal], 
                                key($catalog->katalog_id))
                        @break

                        @case('Kelas')
                            @livewire('form-pemesanan-kelas',
                            ['catalog' => $catalog,
                            'store' => $store], 
                            key($catalog->katalog_id))
                            {{-- <x-form-katalog-kelas :store="$store" /> --}}
                        @break

                        @default
                            @livewire('form-pemesanan-gamelan',
                            ['catalog' => $catalog,
                            'store' => $store,],
                            key($catalog->katalog_id))
                        @break
                    @endswitch
                    @if(!Auth::check()) 
                        <p class="mt-4 text-sm text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk di sini</a>
                        </p>
                    @endif
                </div>
            </div>
            <hr class="my-10 border-gray-200">

            <div class="mt-10">
                <h2 class="text-2xl font-bold mb-5 text-primary">Ulasan Pelanggan</h2>
                @livewire('list-ulasan-katalog', ['katalogId' => $catalog->katalog_id])
            </div>
        </div>
    </div>

</x-global-layout>
