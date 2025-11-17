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
            'horizontal' => true,
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
            'horizontal' => true,
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
            'horizontal' => true,
        ],
        [
            'nama' => 'Gamelan Gambang',
            'deskripsi' => 'The Gambang is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It consists of a set of wooden bars that are laid out horizontally and played with mallets.
                    The Gambang produces a warm, mellow sound and is often used to play melodic patterns and
                    embellishments in gamelan music.',
            'showPrice' => false,
            'price' => '$29230293',
            'gambar' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
            'horizontal' => true,
        ],
    ];
@endphp

<x-global-layout>
    <x-slot:title>
        Gallery
    </x-slot:title>

    <section class="min-h-[480px] px-20 pb-20 font-markazi">
        <h1 class="text-center text-8xl py-10">Gamelan</h1>

        {{-- <div class="flex flex-col gap-10 w-full">
            @foreach ($gamelans as $gamelan)
                <x-gamelan-box 
                :nama="$gamelan['nama']" 
                :deskripsi="$gamelan['deskripsi']" 
                :showPrice="$gamelan['showPrice']" 
                :price="$gamelan['price']" 
                :gambar="$gamelan['gambar']"
                :dataAos="$gamelan['dataAos']" 
                :dataAosDuration="$gamelan['dataAosDuration']" 
                :horizontal="$gamelan['horizontal']" />
            @endforeach
        </div> --}}



        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($gamelans as $gamelan)
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-base" 
                        src="{{ asset($gamelan['gambar']) }}" 
                        alt="{{ $gamelan['nama'] }}">
                    </div>
                    <div class="pt-2">
                        <h3 class="text-lg font-semibold">{{ $gamelan['nama'] }}</h3>
                        <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($gamelan['deskripsi'], 80) }}</p>
                    </div>
                </div>
            @endforeach
        </div>


    </section>

</x-global-layout>
