<x-global-layout>

    <x-slot:title>
        Home
    </x-slot:title>

    {{-- Hero Section --}}
    <section class="relative min-h-[100svh] md:h-[600px] bg-primary md:bg-transparent font-markazi flex items-center justify-center text-center text-white">
        <img class="hidden md:block absolute inset-0 w-full h-full object-cover object-center brightness-50"
            src="{{ asset('images/hero-bg.jpg') }}" alt="">

        <div class="relative z-10 px-4 md:px-0 md:text-white max-w-4xl">
            <h1 class="text-4xl md:text-6xl mb-3 tracking-wider animate__animated animate__fadeIn">TIHINGAN GAMELANS</h1>
            <p class="text-base md:text-xl tracking-wider font-light animate__animated animate__fadeIn animate__delay-1s">
                Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Totam quas fuga sapiente rerum, explicabo quia corrupti assumenda !</p>
        </div>
    </section>

    {{-- What Can You Do Section --}}
    <section class="py-16 px-4 md:px-20 grid place-items-center font-markazi text-primary">
        <div class="h-fit w-auto flex flex-col gap-10">
            <h1 class="text-4xl md:text-6xl lg:text-8xl text-center mb-7" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-sine">Apa Yang bisa Anda Lakukan ?</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="text-xl md:text-2xl text-center tracking-wider px-5" data-aos="zoom-in" data-aos-duration="1510" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Pesan Gamelan</h3>
                    <p>Gak tau dimana tempat beli gamelan ?

                        Beli Disini !
                    </p>
                </div>
                <div class="text-xl md:text-2xl text-center tracking-wider px-5 py-5 md:py-0 border-y-2 md:border-y-0 md:border-x-2 border-primary/50"
                    data-aos="zoom-in" data-aos-duration="1590" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Belajar Bermain Gamelan</h3>
                    <p>Anda bisa mulai belajar gamelan disini.</p>
                </div>
                <div class="text-xl md:text-2xl text-center tracking-wider px-5" data-aos="zoom-in" data-aos-duration="1680" data-aos-easing="ease-in-sine">
                    <h3 class="font-bold">Join Workshop</h3>
                    <p>Ikut Bantu dan meraskan bagaimana rasanya jadi pengrajin gamelan sungguhan!</p>
                </div>
            </div>
        </div>
    </section>

    {{-- THE MOST POPULAR STORE --}}
    <section class="w-full py-12 md:py-20">
        <div class="w-auto font-markazi px-4 py-12 md:px-20 md:py-20 ">
            <h1 class="text-center text-primary text-4xl md:text-6xl lg:text-8xl" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-sine">Toko dan Galeri Terpopuler</h1>
            <p class="mt-4 text-center text-primary text-base md:text-2xl" data-aos="fade-up" data-aos-duration="1500">Yuk intip toko dan galeri gamelan terpopuler dari para pengrajin Tihingan berikut ini!
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 md:px-20">
            @foreach ($stores as $store)
                    <x-box-store 
                        :nama="$store->nama"
                        :slug="$store->slug"
                        :deskripsi="$store->deskripsi" 
                        :tag_bisnis="$store->tags->pluck('jenis')" 
                        :profile="$store->gambar" 
                        :rating="$store->average_rating"
                        :total_ulasan="$store->total_ulasan"
                        :dataAos="'fade-up'" 
                        :dataAosDuration="'1500'" 
                    />
            @endforeach
        </div>
    </section>

    {{-- Gamelan Gallery Section --}}
    <section class="w-full py-12 md:py-20">
        <div class="font-markazi px-4 md:px-20 mb-10 ">
            <h1 class="text-center text-primary text-4xl md:text-6xl lg:text-8xl" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-sine">Gamelan</h1>
            <p class="mt-4 text-center text-primary text-base md:text-2xl" data-aos="fade-up" data-aos-duration="1500">penasaran dengan produk gamelan dari tangan tangan pengrajin Tihingan ?</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 md:px-20">
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
       
    </section>

    {{-- Hapus condition --}}
    @if ($ulasan != null)
        {{-- Pengguna Reviews Section --}}
        <section class="h-auto md:h-[480px] font-markazi pb-20 md:pb-0">
            <div class="w-auto grid place-items-center mt-20 md:mt-44">
                <h1 data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-sine" 
                class="text-3xl md:text-5xl lg:text-7xl text-center w-11/12 md:w-10/12 text-primary">Beberapa
                    Pengguna Menyukai Tihingan Gamelans</h1>
            </div>
            <div class="relative mx-auto w-full px-4 md:px-20 mt-10 overflow-hidden group">
                <div
                    class="flex gap-10 space-x-4 flex-nowrap py-4 animate-infinite-scroll group-hover:[animation-play-state:paused] cursor-default">
                    <div class="flex-shrink-0 flex gap-10 space-x-4 px-5">
                        @forelse ($ulasan as $ulasanItem)
                            <x-ulasan-box 
                                :nama="$ulasanItem->nama_pengulas" 
                                :gambar="$ulasanItem->pengguna->gambar" 
                                :rating="$ulasanItem->rating" 
                                :komentar="$ulasanItem->isi_ulasan" 
                            />
                        @empty
                            
                        @endforelse
                    </div>

                    <div class="flex-shrink-0 flex gap-10 space-x-4 px-5" aria-hidden="true">
                        @foreach ($ulasan as $ulasanItem)
                            <x-ulasan-box 
                                :nama="$ulasanItem->nama_pengulas ?? $ulasanItem->pengguna->nama" 
                                :gambar="$ulasanItem->pengguna->gambar ?? 'images/ulasan_profile.png'" 
                                :rating="$ulasanItem->rating" 
                                :komentar="$ulasanItem->isi_ulasan" 
                            />
                        @endforeach
                    </div>
                    
                    <div class="flex-shrink-0 flex gap-10 space-x-4 px-5" aria-hidden="true">
                        @foreach ($ulasan as $ulasanItem)
                            <x-ulasan-box 
                                :nama="$ulasanItem->nama_pengulas ?? $ulasanItem->pengguna->nama" 
                                :gambar="$ulasanItem->pengguna->gambar ?? 'images/ulasan_profile.png'" 
                                :rating="$ulasanItem->rating" 
                                :komentar="$ulasanItem->isi_ulasan" 
                            />
                        @endforeach
                    </div>
                </div>

                <div
                    class="absolute top-0 bottom-0 left-0 w-12 md:w-56
            bg-gradient-to-r from-white to-transparent
            pointer-events-none">
                </div>

                <div
                    class="absolute top-0 bottom-0 right-0 w-12 md:w-56
            bg-gradient-to-l from-white to-transparent
            pointer-events-none">
                </div>
            </div>

        </section>
    @endif

    {{-- Pengguna Call to Action Section  --}}
    <section class="h-auto md:h-[480px] font-markazi bg-boxCatalog px-4 md:px-20 py-10 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center gap-2 md:gap-0">
            <h1 class="text-4xl md:text-8xl text-center">Siap Memulai?</h1>
            <p class="text-lg md:text-2xl tracking-wider text-center">Gabung bersama kami dan jelajahi jutaan gamelan dari pengerajin
                terpercaya!</p>
        </div>
        <div class="w-auto grid place-items-center mt-8">
            <a href="{{ route('register') }}" class="inline-block text-xl md:text-3xl px-6 py-3 md:px-10 md:py-5 bg-primary text-white rounded-full">Gabung
                Sekarang</a>
        </div>
    </section>

    {{-- Owner Call to Action Section  --}}
    <section class="h-auto md:h-[480px] font-markazi px-4 md:px-20 py-10 md:py-20 flex flex-col md:flex-row text-primary overflow-x-hidden">
        <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" class="flex-1">
            <h1 class="text-4xl md:text-8xl text-center md:text-left mb-4 md:mb-0">Tentang Kami</h1>
            <p class="text-justify md:text-left text-lg md:text-2xl">Desa Tihingan yang terletak di Kecamatan Banjarangkan, Kabupaten Klungkung, dikenal luas
                sebagai desa pengrajin gamelan Bali yang telah mewariskan keahlian turun-temurun sejak berabad-abad
                silam. Desa ini menjadi pusat pembuatan gamelan tradisional yang sangat dihormati di Bali, di mana
                hampir setiap keluarga memiliki keterampilan dalam menempa logam perunggu dan menciptakan instrumen
                gamelan dengan nada khas yang sakral.</p>
        </div>
        <div class="hidden md:block" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine"
            class="flex-1 grid place-items-center">
            <img class=" hidden md:block w-96" src="{{ asset('images/logo_vektor_02.svg') }}" alt="">
        </div>
    </section>

    {{-- Owner Call to Action Section  --}}
    <section class="min-h-[480px] font-markazi bg-boxCatalog px-4 md:px-20 py-10 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center gap-2 md:gap-0">
            <h1 class="text-4xl md:text-8xl text-center">Seniman Tihingan?</h1>
            <p class="text-lg md:text-2xl tracking-wider text-center">Gabung bersama kami dan luaskan jangkauan pasar anda!</p>
        </div>
        <div class="w-auto grid place-items-center mt-8">
            <a href="{{ route('filament.owner.auth.register') }}" class="inline-block text-xl md:text-3xl px-6 py-3 md:px-10 md:py-5 bg-primary text-white rounded-full">Gabung
                Sekarang</a>
        </div>
    </section>
</x-global-layout>
