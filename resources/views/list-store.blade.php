@php
    $stores = [
        [
            'nama' => 'Gong Sigar',
            'slug' => 'gong-sigar',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'Menjual Gamelan, menyewakan gamelan, kujungan wisatawan untuk melihat proses pembuatan gamelan dan belajar megambel',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'slug' => 'kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'Menjual Gamelan, menyewakan gamelan, kujungan wisatawan untuk melihat proses pembuatan gamelan dan belajar megambel',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'slug' => 'kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'Menjual Gamelan, menyewakan gamelan, kujungan wisatawan untuk melihat proses pembuatan gamelan dan belajar megambel',
            'profile' => 'images/bende1.png',
            'dataAos' => 'fade-up',
            'dataAosDuration' => '1500',
        ],
        [
            'nama' => 'Kendang',
            'slug' => 'kendang',
            'tag_bisnis' => ['learn', 'workshop', 'purchase'],
            'deskripsi' => 'Menjual Gamelan, menyewakan gamelan, kujungan wisatawan untuk melihat proses pembuatan gamelan dan belajar megambel',
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

            <div class="mt-24 grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach ($stores as $store)
                    <x-box-store 
                        :nama="$store['nama']"
                        :slug="$store['slug']"
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
