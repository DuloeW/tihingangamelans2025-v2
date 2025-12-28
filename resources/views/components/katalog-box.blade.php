@props([
    'nama' => 'Gamelan Name',
    'deskripsi' => 'Gamelan Description',
    'price' => '$XXX.XX',
    'gambar' => 'images/bende1.png',
    'jenis' => '',
    'dataAos' => 'fade-up',
    'dataAosDuration' => '1500',
    'slug' => '',
    'katalog_id' => '',
    'rating' => 0,
    'total_ulasan' => 0,
])

<div data-aos="{{ $dataAos }}" data-aos-duration="{{ $dataAosDuration }}"
    class="group w-full max-w-sm bg-[#FAF8F3] rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-[#3A2415]/5 flex flex-col h-full">
    
    {{-- Image Section --}}
    <div class="relative w-full h-56 bg-white flex items-center justify-center p-6 overflow-hidden">
        <img src="{{ asset('storage/' . $gambar) }}" 
             alt="{{ $nama }}" 
             class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500 drop-shadow-sm">
        
        {{-- Badge Jenis --}}
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1 text-xs font-bold text-white bg-[#7A2420] rounded-full shadow-sm uppercase tracking-wider">
                {{ $jenis }}
            </span>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="flex-1 p-6 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start mb-2">
                <h2 class="text-2xl font-bold text-[#3A2415] font-markazi tracking-wide line-clamp-1 group-hover:text-[#7A2420] transition-colors">
                    {{ $nama }}
                </h2>
            </div>

            {{-- Rating --}}
            <div class="flex items-center gap-1 mb-3">
                <div class="flex text-yellow-500">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= round($rating) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-xs font-medium text-[#3A2415]/60 ml-1">({{ $total_ulasan }} ulasan)</span>
            </div>

            <p class="text-[#3A2415]/80 text-lg leading-snug line-clamp-2 mb-4 font-markazi">
                {{ $deskripsi }}
            </p>
        </div>

        <div class="pt-4 border-t border-[#3A2415]/10 flex items-center justify-between mt-auto">
            <div class="flex flex-col">
                <span class="text-xs text-[#3A2415]/60 font-medium uppercase tracking-wider">Harga</span>
                <span class="text-xl font-bold text-[#3A2415] font-markazi">
                    Rp {{ number_format((int) str_replace(['Rp.', 'Rp', ',', '.'], '', $price), 0, ',', '.') }}
                </span>
            </div>
            
            <a href="{{ route('store.catalog.detail', ['slug' => $slug, 'jenis' => $jenis, 'katalog_id' => $katalog_id]) }}"
               class="px-5 py-2 bg-[#3A2415] text-white rounded-lg text-lg font-markazi tracking-wide shadow-sm hover:bg-[#7A2420] hover:shadow-md transition-all transform hover:-translate-y-0.5">
                Pesan
            </a>
        </div>
    </div>
</div>
