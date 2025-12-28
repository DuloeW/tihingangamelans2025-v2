@props([
    'nama' => 'Gamelan Name',
    'slug' => '',
    'deskripsi' => 'Gamelan Description',
    'gambar' => 'images/bende1.png',
    'dataAos' => 'fade-up',
    'dataAosDuration' => '800',
])

@php
    $deskripsi_limit = Str::limit($deskripsi, 120, '...');
@endphp

<div data-aos="{{ $dataAos }}" data-aos-duration="{{ $dataAosDuration }}" 
     class="group font-markazi bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
    
    <!-- Image Container -->
    <div class="relative h-64 bg-gradient-to-br from-[#FAF8F3] to-[#F5F0E8] overflow-hidden">
        <img src="{{ asset('storage/' . $gambar) }}" 
             alt="{{ $nama }}"
             class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-500">
    </div>

    <!-- Content -->
    <div class="p-6">
        <h3 class="text-3xl font-bold text-[#3A2415] mb-3 font-markazi">
            {{ $nama }}
        </h3>
        <p class="text-[#6B5A4A] text-xl leading-relaxed mb-6 line-clamp-3">
            {{ $deskripsi_limit }}
        </p>

        <!-- Button -->
        <a href="{{ route('gallery-gamelan.detail', ['slug' => $slug]) }}" 
           class="inline-flex items-center justify-center w-full px-6 py-3 bg-[#3A2415] text-white font-semibold rounded-lg hover:bg-[#2a180a] transition-all duration-300 shadow-md hover:shadow-lg group">
            <span>Lihat Detail</span>
            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
