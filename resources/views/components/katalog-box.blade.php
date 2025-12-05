@props([
    'nama' => 'Gamelan Name',
    'deskripsi' => 'Gamelan Description',
    'price' => '$XXX.XX',
    'gambar' => 'images/bende1.png',
    'dataAos' => 'fade-up',
    'dataAosDuration' => '1500',
])

<div data-aos="{{ $dataAos }}" data-aos-duration="{{ $dataAosDuration }}"
    class="w-full max-w-xs bg-[#FAF8F3] rounded-xl shadow-md p-5 flex flex-col items-center mb-6">
    <div class="w-full flex flex-col items-center">
        <img src="{{ asset($gambar) }}" alt="" class="h-24 w-auto object-contain mb-4 drop-shadow-sm">
    </div>
    <div class="w-full flex-1 flex flex-col justify-between">
        <h2 class="text-3xl font-bold text-[#3A2415] mb-1">{{ $nama }}</h2>
        <p class="text-xl text-[#3A2415] mb-4 leading-snug">{{ $deskripsi }}</p>
        <div class="flex justify-between items-center">
            <p class="text-lg font-bold text-[#3A2415]">
                Rp.{{ number_format((int) str_replace(['Rp.', 'Rp', ',', '.'], '', $price), 0, ',', '.') }},00</p>
            <div class="flex justify-end">
                <a class="px-5 py-2 bg-[#3A2415] text-white rounded-md text- xltracking-wide shadow-sm hover:bg-[#2a180a] transition"
                    href="#">
                    Pesan Sekarang
                </a>
            </div>

        </div>
    </div>
</div>
