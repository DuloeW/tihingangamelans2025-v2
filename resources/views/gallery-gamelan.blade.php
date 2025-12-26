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
                    <x-gamelan-box 
                        :nama="$gamelan->nama" 
                        :slug="$gamelan->slug"
                        :deskripsi="$gamelan->deskripsi" 
                        :gambar="$gamelan->gambar"
                        :dataAos="'fade-up'"
                        :dataAosDuration="1500"
                    />
                @endforeach
            </div>
        </div>
    </section>

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
