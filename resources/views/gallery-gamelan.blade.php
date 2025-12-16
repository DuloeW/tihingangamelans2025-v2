{{-- @php
    $gamelans = [
        [
            'id' => 1,
            'nama' => 'Gamelan Bonang',
            'deskripsi' => 'The Bonang is a traditional Indonesian musical instrument that is part of the gamelan ensemble. It consists of a series of small, horizontally mounted gongs that are played with padded sticks.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'Perkusi',
        ],
        [
            'id' => 2,
            'nama' => 'Gamelan Saron',
            'deskripsi' => 'The Saron is a traditional Indonesian musical instrument that is part of the gamelan ensemble. It consists of a set of bronze or iron bars that are laid out horizontally and played with a mallet.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'Melodis',
        ],
        [
            'id' => 3,
            'nama' => 'Gamelan Kendang',
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan ensemble. It is a double-headed drum made from wood and animal skin, and it is played with the hands.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'Drum',
        ],
        [
            'id' => 4,
            'nama' => 'Gamelan Gambang',
            'deskripsi' => 'The Gambang is a traditional Indonesian musical instrument that is part of the gamelan ensemble. It consists of a set of wooden bars that are laid out horizontally and played with mallets.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'Melodis',
        ],
        [
            'id' => 5,
            'nama' => 'Gamelan Gong',
            'deskripsi' => 'The Gong is a large suspended metal disc that produces a deep, resonant sound when struck. It is used to mark important moments in gamelan performances.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'Perkusi',
        ],
        [
            'id' => 6,
            'nama' => 'Gamelan Rebab',
            'deskripsi' => 'The Rebab is a bowed string instrument used in gamelan music. It has a distinctive sound that adds melodic depth to the ensemble.',
            'gambar' => 'images/bende1.png',
            'kategori' => 'String',
        ],
    ];
@endphp --}}

<x-global-layout>
    <x-slot:title>
        Gallery Gamelan
    </x-slot:title>

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-[#FAF8F3] to-white py-16 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-6xl md:text-7xl font-markazi font-bold text-[#3A2415] mb-4">
                Gamelan Gallery
            </h1>
            <p class="text-xl text-[#6B5A4A] max-w-2xl mx-auto">
                Explore the rich heritage of traditional Indonesian gamelan instruments
            </p>
        </div>
    </section>

    <!-- Gallery Grid Section -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($gamelans as $gamelan)
                    <div data-aos="fade-up" data-aos-duration="800" 
                         class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                        
                        <!-- Image Container -->
                        <div class="relative h-64 bg-gradient-to-br from-[#FAF8F3] to-[#F5F0E8] overflow-hidden">
                            <img src="{{ asset('storage/' . $gamelan->gambar) }}" 
                                 alt="{{ $gamelan->nama }}"
                                 class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-500">
                            
                            {{-- <!-- Category Badge -->
                            <div class="absolute top-4 right-4 bg-[#3A2415] text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-md">
                                {{ $gamelan['kategori'] }}
                            </div> --}}
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-[#3A2415] mb-3 font-markazi">
                                {{ $gamelan->nama }}
                            </h3>
                            <p class="text-[#6B5A4A] leading-relaxed mb-6 line-clamp-3">
                                {{ $gamelan->deskripsi }}
                            </p>

                            <!-- Button -->
                            <a href="{{ route('gallery-gamelan.detail', ['slug' => $gamelan->slug]) }}" 
                               class="inline-flex items-center justify-center w-full px-6 py-3 bg-[#3A2415] text-white font-semibold rounded-lg hover:bg-[#2a180a] transition-all duration-300 shadow-md hover:shadow-lg group">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-6 bg-gradient-to-r from-[#3A2415] to-[#4A3020]">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-markazi font-bold text-white mb-4">
                Interested in Learning More?
            </h2>
            <p class="text-xl text-[#FAF8F3] mb-8">
                Discover the beauty and cultural significance of traditional gamelan music
            </p>
            <a href="{{ route('store.index') }}" 
               class="inline-block px-8 py-4 bg-white text-[#3A2415] font-bold rounded-lg hover:bg-[#FAF8F3] transition-all duration-300 shadow-lg hover:shadow-xl">
                Explore Our Collection
            </a>
        </div>
    </section>

</x-global-layout>
