<div>
    <form method="POST" action="#" class="space-y-4">
        @csrf

        {{-- <!-- Nama Group -->
        <div>
            <label for="nama_group" class="block text-xl font-semibold text-[#3A2415] mb-1">Nama Group</label>
            <input type="text" id="nama_group" name="nama_group" placeholder="Man Lari"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
        </div> --}}

        {{-- <div class="flex gap-5 justify-between">
            <!-- Pilih hari mulai -->
            <div class="flex-1">
                <label for="tanggal_workshop" class="block text-xl font-semibold text-[#3A2415] mb-1">Pilih Hari Mulai</label>
                <input type="date" id="tanggal_workshop" name="tanggal_workshop"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
            </div>
            <!-- Pilih hari selesai -->
            <div class="flex-1">
                <label for="tanggal_workshop" class="block text-xl font-semibold text-[#3A2415] mb-1">Pilih Hari Selesai</label>
                <input type="date" id="tanggal_workshop" name="tanggal_workshop"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">
            </div>
        </div> --}}

        <!-- Jumlah Anggota -->
        <div>
            <label for="jumlah_anggota" class="block text-xl font-semibold text-[#3A2415] mb-1">Banyak Anggota</label>
            <input type="number" id="jumlah_anggota" name="jumlah_anggota" value="0" min="0"
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-[#3A2415] focus:outline-none focus:ring-2 focus:ring-[#3A2415] focus:border-transparent">  
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
