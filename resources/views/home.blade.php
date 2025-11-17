@php
    $gamelans = [
        [
            'nama' => 'Gamelan Bonang',
            'deskripsi' => 'The Bonang is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It consists of a series of small, horizontally mounted gongs that are played with padded
                    sticks. The Bonang produces a rich, resonant sound and is often used to play melodic patterns and
                    embellishments in gamelan music.',
            'showPrice' => false,
            'price' => '$1,000.00',
            'gambar' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
            'horizontal' => false,
        ],
        [
            'nama' => 'Gamelan Saron',
            'deskripsi' => 'The Saron is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It consists of a set of bronze or iron bars that are laid out horizontally and played with
                    a mallet. The Saron produces a bright, metallic sound and is often used to play the main melody in
                    gamelan music.',
            'showPrice' => false,
            'price' => '$800.00',
            'gambar' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
            'horizontal' => false,
        ],
        [
            'nama' => 'Gamelan Kendang',
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum made from wood and animal skin, and it is played with the hands.
                    The Kendang provides the rhythmic foundation for gamelan music and is used to signal changes in tempo
                    and dynamics.',
            'showPrice' => false,
            'price' => '',
            'gambar' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
            'horizontal' => false,
        ],
        [
            'nama' => 'Gamelan Gambang',
            'deskripsi' => 'The Gambang is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It consists of a set of wooden bars that are laid out horizontally and played with mallets.
                    The Gambang produces a warm, mellow sound and is often used to play melodic patterns and
                    embellishments in gamelan music.',
            'showPrice' => false,
            'price' => '',
            'gambar' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
            'horizontal' => false,
        ],
    ];
@endphp


<x-global-layout>

    <x-slot:title>
        Home
    </x-slot:title>

    {{-- Hero Section --}}
    <section class="relative h-[600px] font-markazi flex items-center justify-center text-center text-white">
        <img class="absolute top-0 left-0 w-full h-full object-cover object-center brightness-50"
            src="{{ asset('images/hero-bg.jpg') }}" alt="">

        <div class="relative z-10">
            <h1 class="text-6xl mb-3 tracking-wider animate__animated animate__fadeIn">TIHINGAN GAMELANS</h1>
            <p class="text-xl tracking-wider text-center font-light animate__animated animate__fadeIn animate__delay-1s">
                Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Totam quas fuga sapiente rerum, explicabo quia corrupti assumenda !</p>
        </div>
    </section>

    {{-- What Can You Do Section --}}
    <section class="h-[480px] w-auto px-20 grid place-items-center font-markazi text-primary">
        <div class="h-fit w-auto flex flex-col gap-10">
            <h1 class="text-8xl text-center mb-7" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-sine">What Can You Do ?</h1>
            <div class="flex justify-around gap-10">
                <div class="text-2xl text-center tracking-wider px-5" data-aos="zoom-in" data-aos-duration="1510" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Shop Gamelans</h3>
                    <p>Don't Know where to buy the Gamelan ?
                        buy here !</p>
                </div>
                <div class="text-2xl text-center tracking-wider px-5 border-r-2 border-l-2 border-primary/50"
                    data-aos="zoom-in" data-aos-duration="1590" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Learn How To Play</h3>
                    <p>You can feel the experience to play the Gamelan from here.</p>
                </div>
                <div class="text-2xl text-center tracking-wider px-5" data-aos="zoom-in" data-aos-duration="1680" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Join The Workshop</h3>
                    <p>Witness the fascinating process of making the Gamelan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gamelan Gallery Section --}}
    <section class="h-fit min-h-[480px] px-20">
        {{-- TODO contoh menggunakan animasi --}}
        <div class="w-auto font-markazi py-20 ">
            <h1 class="text-center text-primary text-8xl" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-sine">Gamelans</h1>
            <p class="text-center text-primary text-2xl" data-aos="fade-up" data-aos-duration="1500">Lorem ipsum dolor
                sit amet consectetur adipisicing elit. Id
                illo provident a quam repellendus eos.</p>
        </div>
        <div class="grid grid-cols-2 grid-rows-2 gap-24">
            @foreach ($gamelans as $gamelan)
                <x-gamelan-box 
                    :nama="$gamelan['nama']" 
                    :showPrice="$gamelan['showPrice']" 
                    :deskripsi="$gamelan['deskripsi']" 
                    :price="$gamelan['price']"
                    :gambar="$gamelan['gambar']"
                    :dataAos="$gamelan['dataAos']"
                    :dataAosDuration="$gamelan['dataAosDuration']"
                    :horizontal="$gamelan['horizontal']"
                />
            @endforeach
        </div>
    </section>

    {{-- Pengguna Reviews Section --}}
    <section class="h-[480px] font-markazi">
        <div class="w-auto grid place-items-center mt-44">
            <h1 data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-sine" 
            class="text-7xl text-center w-10/12 text-primary">Beberapa
                Pengguna Menyukai Tihingan Gamelans</h1>
        </div>
        <div class="relative mx-auto w-full px-20 mt-10 overflow-hidden group">
            <div
                class="flex gap-10 space-x-4 flex-nowrap py-4 animate-infinite-scroll group-hover:[animation-play-state:paused] cursor-default">
                <div class="flex-shrink-0 flex gap-10 space-x-4 px-5">
                    <x-ulasan-box />
                    <x-ulasan-box />
                    <x-ulasan-box />
                    <x-ulasan-box />
                </div>

                <div class="flex-shrink-0 flex gap-10 space-x-4 px-5" aria-hidden="true">
                    <x-ulasan-box />
                    <x-ulasan-box />
                    <x-ulasan-box />
                    <x-ulasan-box />
                </div>
            </div>

            <div
                class="absolute top-0 bottom-0 left-0 w-56
           bg-gradient-to-r from-white to-transparent
           pointer-events-none">
            </div>

            <div
                class="absolute top-0 bottom-0 right-0 w-56
           bg-gradient-to-l from-white to-transparent
           pointer-events-none">
            </div>
        </div>

    </section>

    {{-- Pengguna Call to Action Section  --}}
    <section class="h-[480px] font-markazi bg-boxCatalog px-20 py-10 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <h1 class="text-8xl">Siap Memulai?</h1>
            <p class="text-2xl tracking-wider">Gabung bersama kami dan jelajahi jutaan gamelan dari pengerajin
                terpercaya!</p>
        </div>
        <div class="w-auto grid place-items-center mt-8">
            <a href="#" class="inline-block text-3xl px-10 py-5 bg-primary text-white rounded-full">Gabung
                Sekarang</a>
        </div>
    </section>

    {{-- Owner Call to Action Section  --}}
    <section class="h-[480px] font-markazi px-20 py-20 flex text-primary overflow-x-hidden">
        <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" class="flex-1">
            <h1 class="text-8xl">Tentang Kami</h1>
            <p class="text-2xl">Desa Tihingan yang terletak di Kecamatan Banjarangkan, Kabupaten Klungkung, dikenal luas
                sebagai desa pengrajin gamelan Bali yang telah mewariskan keahlian turun-temurun sejak berabad-abad
                silam. Desa ini menjadi pusat pembuatan gamelan tradisional yang sangat dihormati di Bali, di mana
                hampir setiap keluarga memiliki keterampilan dalam menempa logam perunggu dan menciptakan instrumen
                gamelan dengan nada khas yang sakral.</p>
        </div>
        <div data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine"
            class="flex-1 grid place-items-center">
            <img class="w-96" src="{{ asset('images/logo_vektor_02.svg') }}" alt="">
        </div>
    </section>

    {{-- Owner Call to Action Section  --}}
    <section class="min-h-[480px] font-markazi bg-boxCatalog px-20 py-10 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <h1 class="text-8xl text-center">Seniman Tihingan?</h1>
            <p class="text-2xl tracking-wider">Gabung bersama kami dan luaskan jangkauan pasar anda!</p>
        </div>
        <div class="w-auto grid place-items-center mt-8">
            <a href="#" class="inline-block text-3xl px-10 py-5 bg-primary text-white rounded-full">Gabung
                Sekarang</a>
        </div>
    </section>
</x-global-layout>
