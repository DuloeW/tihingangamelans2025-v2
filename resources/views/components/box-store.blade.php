@props([
    'nama' => 'Gamelan Name',
    'slug' => 'gamelan-name',
    'deskripsi' => 'Gamelan Description',
    'tag_bisnis' => ['tag1', 'tag2', 'tag3'],
    'profile' => 'images/bende1.png',
    'rating' => 0,
    'total_ulasan' => 0,
    'dataAos' => 'fade-up',
    'dataAosDuration' => '1500',
])

<div 
    data-aos="{{ $dataAos }}" 
    data-aos-duration="{{ $dataAosDuration }}"
    class="group bg-[#FAF8F3] rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col md:flex-row h-full">
    
    {{-- Image Section --}}
    <div class="w-full md:w-48 h-48 md:h-auto relative bg-white flex-shrink-0 overflow-hidden flex items-center justify-center p-4">
        <img src="{{ asset('storage/' . $profile) }}" 
             alt="{{ $nama }}" 
             class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
    </div>

    {{-- Content Section --}}
    <div class="flex-1 p-6 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start mb-2">
                <h2 class="text-2xl font-bold text-[#3A2415] group-hover:text-[#7A2420] transition-colors line-clamp-1 font-markazi tracking-wide">
                    {{ $nama }}
                </h2>
                
                {{-- Rating Badge --}}
                <div class="flex items-center gap-1 bg-[#3A2415]/5 px-2 py-1 rounded-lg border border-[#3A2415]/10">
                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-bold text-[#3A2415] text-sm">{{ $rating }}</span>
                    <span class="text-xs text-[#3A2415]"> / 5.0</span>
                    <span class="text-xs text-[#3A2415]/60">({{ $total_ulasan }})</span>
                </div>
            </div>

            {{-- Tags --}}
            <div class="flex flex-wrap gap-2 mb-3">
                @foreach ($tag_bisnis as $tag)
                    <span class="px-3 py-1 text-xs font-medium text-[#7A2420] bg-[#7A2420]/10 rounded-full">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>

            <p class="text-[#3A2415]/80 text-lg leading-snug line-clamp-2 mb-4 font-markazi">
                {{ $deskripsi }}
            </p>
        </div>

        <div class="flex items-center justify-end pt-4 border-t border-[#3A2415]/10">
            <a href="{{ url('store/' . $slug) }}"
               class="px-5 py-2 bg-[#3A2415] text-white rounded-md text-lg tracking-wide shadow-sm hover:bg-[#2a180a] transition font-markazi">
                Kunjungi Toko
            </a>
        </div>
    </div>
</div>
