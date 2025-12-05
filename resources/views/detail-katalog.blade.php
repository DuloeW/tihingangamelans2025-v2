<x-global-layout>
    <x-slot:title>
        Detail Katalog
    </x-slot:title>

    <div class="px-20 py-20 font-markazi">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-10">
            <div class="flex gap-8">
                <!-- Gambar Produk & Harga -->
                <div class="w-1/3 flex flex-col items-center">
                    <div class="w-full bg-gray-50 rounded-xl p-6 flex items-center justify-center mb-4">
                        <img src="{{ asset('images/bende1.png') }}" alt="Gamelan" class="w-48 h-48 object-contain drop-shadow-md">
                    </div>
                    <p class="text-3xl font-bold text-[#3A2415]">Rp.500.000,00</p>
                </div>

                <!-- Form Pemesanan -->
                <div class="flex-1 p-6">
                    <form method="POST" action="#" class="space-y-4">
                        @csrf
                        
                        <!-- Jumlah -->
                        <div>
                            <label for="jumlah" class="block text-sm font-semibold text-[#3A2415] mb-1">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" value="0" min="0" 
                                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                        </div>

                        <!-- Nama Penerima -->
                        <div>
                            <label for="nama_penerima" class="block text-sm font-semibold text-[#3A2415] mb-1">Nama Penerima</label>
                            <input type="text" id="nama_penerima" name="nama_penerima" placeholder="Man Lari" 
                                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                        </div>

                        <!-- Provinsi, Kabupaten, Kecamatan -->
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="provinsi" class="block text-sm font-semibold text-[#3A2415] mb-1">Provinsi</label>
                                <input type="text" id="provinsi" name="provinsi" placeholder="Bali" 
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                            </div>
                            <div class="flex-1">
                                <label for="kabupaten" class="block text-sm font-semibold text-[#3A2415] mb-1">Kabupaten</label>
                                <input type="text" id="kabupaten" name="kabupaten" placeholder="Tabanan" 
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                            </div>
                            <div class="flex-1">
                                <label for="kecamatan" class="block text-sm font-semibold text-[#3A2415] mb-1">Kecamatan</label>
                                <input type="text" id="kecamatan" name="kecamatan" placeholder="Kediri" 
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="alamat" class="block text-sm font-semibold text-[#3A2415] mb-1">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" placeholder="Nama Jl, Gang, No Rumah" 
                                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent resize-none"></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex gap-4 pt-2">
                            <a href="#" 
                                class="flex-1 border-2 py-3  border-[#3A2415] text-[#3A2415] text-lg tracking-wide rounded-md text-center font-semibold hover:bg-gray-50 transition">
                                Balik
                            </a>
                            <button type="submit" 
                                class="flex-1 bg-[#3A2415] text-white py-3 text-lg tracking-wide rounded-md font-semibold hover:bg-[#2a180a] transition">
                                Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-global-layout>