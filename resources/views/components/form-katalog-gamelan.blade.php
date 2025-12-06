<div>
    <form method="POST" action="#" class="space-y-4">
        @csrf

        <!-- Jumlah -->
        <div>
            <label for="jumlah" class="block text-xl font-semibold text-[#3A2415] mb-1">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" value="0" min="0"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
        </div>

        <!-- Nama Penerima -->
        <div>
            <label for="nama_penerima" class="block text-xl font-semibold text-[#3A2415] mb-1">Nama Penerima</label>
            <input type="text" id="nama_penerima" name="nama_penerima" placeholder="Man Lari"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
        </div>

        <!-- Provinsi, Kabupaten, Kecamatan -->
        @livewire('alamat-selector')

        <!-- Alamat Lengkap -->
        <div>
            <label for="alamat" class="block text-xl font-semibold text-[#3A2415] mb-1">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" rows="3" placeholder="Nama Jl, Gang, No Rumah"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent resize-none"></textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-4 pt-2">
            <a href="{{ url('store/' . $store->slug) }}"
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
