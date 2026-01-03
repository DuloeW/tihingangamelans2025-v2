<x-global-layout>
    <x-slot:title>
        Gallery Gamelan
    </x-slot:title>

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-[#FAF8F3] to-white py-12 md:py-20 px-4 md:px-20">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-8xl font-markazi font-bold text-[#3A2415] mb-4">
                Gamelan Gallery
            </h1>
            <p class="text-lg md:text-2xl text-[#6B5A4A] max-w-2xl mx-auto">
                Jelajahi koleksi gamelan kami yang indah dan temukan cerita di balik setiap instrumen.
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

    <section class="h-auto md:h-[480px] px-4 md:px-20 py-10 flex flex-col justify-center items-center bg-gradient-to-r from-[#3A2415] to-[#4A3020]">
        <div class="max-w-4xl mx-auto text-center flex flex-col justify-center items-center gap-2 md:gap-0">
            <h2 class="text-4xl md:text-8xl font-markazi font-bold text-white mb-4">
                Tertarik Belajar Lebih Lanjut?
            </h2>
            <p class="text-lg md:text-2xl text-[#FAF8F3] mb-8">
                Temukan keindahan dan makna budaya musik gamelan tradisional di website kami.
            </p>
            <a href="{{ route('store.index') }}" 
               class="inline-block text-xl md:text-3xl px-6 py-3 md:px-10 md:py-5 bg-white text-[#3A2415] font-bold rounded-full hover:bg-[#FAF8F3] transition-all duration-300 shadow-lg hover:shadow-xl">
                Jelajahi Store Kami
            </a>
        </div>
    </section>

</x-global-layout>
