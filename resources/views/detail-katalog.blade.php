<x-global-layout>
    <x-slot:title>
        Detail Katalog
    </x-slot:title>

    <div class="px-20 py-5 font-markazi">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-10">
            <div class="flex gap-8">
                <!-- Gambar Produk & Harga -->
                <div class="w-1/3 flex flex-col">
                    {{-- //TODO seperti ini cara memanggil gambar --}}
                    <div class="w-full bg-gray-50 rounded-xl p-6 flex items-center justify-center mb-4">
                        <img src="{{ asset('storage/' . $catalog->gambar) }}" alt="Gamelan"
                            class="w-48 h-48 object-contain drop-shadow-md">
                    </div>
                    <p class="text-4xl text-primary font-semibold">{{ $catalog->nama}}</p>
                    <p class="text-primary text-lg">{{ $catalog->deskripsi }}</p>
                    <p class="text-3xl mt-4 font-bold text-[#3A2415]">Rp.{{ number_format($catalog->harga, 0, ',', '.') }},00</p>
                </div>

                <!-- Form Pemesanan -->
                <div class="flex-1 p-6">
                    @switch($catalog->jenis)
                        @case('Workshop')
                            @livewire('form-pemesanan-workshop', 
                                ['catalog' => $catalog, 
                                'store' => $store, 
                                'jadwals' => $jadwal, 
                                'pemesanan' => $pemesanan], 
                                key($catalog->katalog_id))
                        @break

                        @case('Kelas')
                            <x-form-katalog-kelas :store="$store" />
                        @break

                        @default
                            @livewire('form-pemesanan-gamelan',
                            ['catalog' => $catalog,
                            'store' => $store,
                            'isAuthenticated' => $isAuthenticated],
                            key($catalog->katalog_id))
                            {{-- <x-form-katalog-gamelan :store="$store" /> --}}
                        @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</x-global-layout>
