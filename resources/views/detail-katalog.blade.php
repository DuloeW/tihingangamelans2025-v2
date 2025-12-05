<x-global-layout>
    <x-slot:title>
        Detail Katalog
    </x-slot:title>

    <div class="px-20 py-5 font-markazi">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-10">
            <div class="flex gap-8">
                <!-- Gambar Produk & Harga -->
                <div class="w-1/3 flex flex-col">
                    <div class="w-full bg-gray-50 rounded-xl p-6 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/bende1.png') }}" alt="Gamelan"
                            class="w-48 h-48 object-contain drop-shadow-md">
                    </div>
                    <p class="text-4xl text-primary font-semibold">{{ $catalog->nama_produk }}</p>
                    <p class="text-primary text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem
                        blanditiis porro numquam nihil magni rerum dolorum, fuga consectetur nam. Quod.</p>
                    <p class="text-3xl mt-4 font-bold text-[#3A2415]">Rp.500.000,00</p>
                </div>

                <!-- Form Pemesanan -->
                <div class="flex-1 p-6">
                    @switch($catalog->jenis)
                        @case('workshop')
                            <x-form-katalog-workshop :store="$store" />
                        @break

                        @case('kelas')
                            <x-form-katalog-kelas :store="$store" />
                        @break

                        @default
                            <x-form-katalog-gamelan :store="$store" />
                        @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</x-global-layout>
