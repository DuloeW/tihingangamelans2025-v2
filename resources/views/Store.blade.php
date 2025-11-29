@php
    $stores = [
        [
            'nama' => 'Gong Sigar',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Gong Sigar is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It is a large, vertically mounted gong that produces a deep, resonant sound when struck with a padded mallet. The Gong Sigar is often used to mark the beginning and end of musical pieces in gamelan music.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
    ];
@endphp

<x-global-layout>
    <x-slot:title>
        Store
    </x-slot:title>

    <section id="store" class="min-h-[480px] px-20 pb-20 font-markazi">
        <div class="container mx-auto">
            <h2 class="text-center text-8xl py-10">Store</h2>

            <div class="w-full grid place-items-center">
                <div class="max-w-3xl w-full flex justify-center items-stretch gap-3">
                    <div
                        class="flex-1 flex items-center bg-white rounded-lg shadow-[0_4px_15px_-3px_rgba(0,0,0,0.07)] px-4 py-3.5">
                        <x-search-icon />
    
                        <input type="text" placeholder="Cari Toko Kerajinan"
                            class="w-full ml-4 text-lg bg-transparent outline-none border-none text-gray-800 placeholder-gray-800 font-input tracking-wide focus:border-none" />
                    </div>
    
                    <button
                        class="bg-white rounded-lg shadow-[0_4px_15px_-3px_rgba(0,0,0,0.07)] px-4 flex items-center justify-center hover:bg-gray-50 transition-colors">
                        <x-filter-search-icon />
                    </button>
                </div>

            </div>

            <div class="mt-24    grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($stores as $store)
                    <x-box-store 
                        :nama="$store['nama']" 
                        :deskripsi="$store['deskripsi']" 
                        :tag_bisnis="$store['tag_bisnis']" 
                        :profile="$store['profile']" 
                        :dataAos="$store['dataAos']" 
                        :dataAosDuration="$store['dataAosDuration']" 
                    />
                @endforeach
            </div>
        </div>
    </section>
</x-global-layout>
