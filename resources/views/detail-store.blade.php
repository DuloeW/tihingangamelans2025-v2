<x-global-layout>

    <x-slot:title>
        Store {{ $slug }}
    </x-slot:title>


    <div class="min-h-[480px] px-20 pb-20 font-markazi" x-data="{ activeTab: '{{ session('activeTab', 'katalog') }}' }">

        <div class="max-w-8xl mx-auto mt-6">
            <div class="flex items-center border text-primary border-gray-300 rounded-xl px-6 py-4 bg-white shadow-sm">
                <!-- Gambar kiri -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('storage/' . $store->gambar) }}" alt="Logo Toko"
                        class="w-20 h-20 rounded-full border border-gray-200 object-cover" />
                </div>
                <!-- Info toko tengah -->
                <div class="flex-1 ml-6">
                    <h2 class="text-3xl font-semibold tracking-wide">{{ $store->nama }}</h2>
                    <p class="text-xl font-medium leading-snug mt-1">{{ $store->deskripsi }}</p>
                </div>
                <!-- Rating kanan -->
                <div class="flex flex-col items-end ml-6">
                    <h2 class="text-3xl font-bold text-primary">Baik</h2>
                    <p class="text-sm text-primary/30 mt-1">Rating & Ulasan</p>
                </div>
            </div>
        </div>

        <div class="w-full max-h-40 flex gap-5 mt-4 border-b-2 py-6">
            <button @click="activeTab = 'katalog'"
                :class="activeTab === 'katalog' ?
                    'bg-primary text-white rounded-md' :
                    'text-primary '"
                class="px-10 py-3 ">
                Katalog
            </button>
            <button @click="activeTab = 'ulasan'"
                :class="activeTab === 'ulasan' ?
                    'bg-primary text-white rounded-md' :
                    'text-primary '"
                class="px-10 py-3 ">
                Ulasan
            </button>
        </div>

        @php
            $jenisBisnis = $store->tags->pluck('jenis')->toArray()    
        @endphp

        {{-- KATALOG --}}
        <div class="w-full mt-10" x-show="activeTab === 'katalog'">
            <div class="flex flex-col gap-10">
                @if (in_array('Purchase', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Gamelans</h2>
                        <p class="text-xl">Gamelan yang kami sediakan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($gamelans as $gamelan)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$gamelan->nama" 
                                        :deskripsi="$gamelan->deskripsi" 
                                        :price="$gamelan->harga"
                                        :slug="$slug"
                                        :jenis="$gamelan->jenis"
                                        :katalog_id="$gamelan->katalog_id"
                                        :gambar="$gamelan->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog gamelan tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                @if (in_array('Workshop', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Workshop</h2>
                        <p class="text-xl">Berbagai macam workshop gamelan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($workshops as $workshop)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$workshop->nama" 
                                        :deskripsi="$workshop->deskripsi" 
                                        :price="$workshop->harga"
                                        :slug="$slug"
                                        :jenis="$workshop->jenis"
                                        :katalog_id="$workshop->katalog_id"
                                        :gambar="$workshop->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog workshop tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                @if (in_array('Learn', $jenisBisnis))
                    <div>
                        <h2 class="text-5xl">Kelas Belajar</h2>
                        <p class="text-xl">Berbagai macam kelas gamelan</p>
                        <div class="w-full overflow-x-auto flex gap-4 p-4 snap-x snap-mandatory scrollbar-hide">
                            @forelse ($classes as $class)
                                <div class="w-1/3 flex-shrink-0">
                                    <x-katalog-box 
                                        :nama="$class->nama" 
                                        :deskripsi="$class->deskripsi" 
                                        :price="$class->harga"
                                        :slug="$slug"
                                        :jenis="$class->jenis"
                                        :katalog_id="$class->katalog_id"
                                        :gambar="$class->gambar" 
                                        :dataAos="'fade-up'" 
                                        :dataAosDuration="'1500'" />
                                </div>
                            @empty
                                <p class="text-primary mx-auto">Tidak ada katalog kelas belajar tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Ulasan Bisnis --}}
        <div class="w-full mt-10" x-show="activeTab === 'ulasan'">
            @livewire('store-review', ['store' => $store])
        </div>
    </div>

</x-global-layout>
