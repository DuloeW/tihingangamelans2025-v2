@php
    $stores = [
        [
            'nama' => 'Gong Sigar',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Gong Sigar is a traditional Indonesian musical instrument that is part of the gamelan
                    ensemble. It is a large, vertically mounted gong that produces a deep, resonant sound when struck with a padded mallet. The Gong Sigar is often used to mark the beginning and end of musical pieces in gamelan music.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500'
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500'
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500'
        ],
        [
            'nama' => 'Kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'The Kendang is a traditional Indonesian drum that is an essential part of the gamelan
                    ensemble. It is a double-headed drum that is played with the hands and produces a variety of rhythms and sounds. The Kendang is often used to lead the ensemble and provide rhythmic accompaniment to other instruments.',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500'
        ],
    ]
@endphp

<x-global-layout>
    <x-slot:title>
        Store
    </x-slot:title>

    <section id="store" class="min-h-[480px] px-20 pb-20 font-markazi">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-8xl py-10">Store</h2>
            <div>
                //TODO pencarian store
            </div>
            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
            </div> --}}
        </div>
    </section>
</x-global-layout>