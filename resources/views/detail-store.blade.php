<x-global-layout>

    <x-slot:title>
        Store {{ $slug }}
    </x-slot:title>


    <div class="min-h-[480px] px-20 pb-20 font-markazi" x-data="{ activeTab: '{{ session('activeTab', 'katalog') }}' }">

        <div class="max-w-7xl mx-auto mt-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="relative h-32 bg-gradient-to-r from-primary/80 to-primary/90">
                    <div class="absolute -bottom-12 left-8">
                        <img src="{{ asset('storage/' . $store->gambar) }}" alt="Logo Toko"
                            class="w-24 h-24 rounded-2xl border-4 border-white shadow-lg object-cover bg-white" />
                    </div>
                </div>
                
                <div class="pt-14 px-8 pb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                        <!-- Info Toko -->
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-2">{{ $store->nama }}</h1>
                            <div class="flex items-center gap-4 text-gray-500 mb-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span class="text-sm">{{ $store->email }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="font-bold text-xl text-gray-900">{{ $rating }}</span>
                                    <span class="text-xs text-gray-400">/ 5.0</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-lg leading-relaxed max-w-3xl">{{ $store->deskripsi }}</p>
                        </div>

                        {{-- //TODO nomer harus di configure formatnya supaya menjadi +62xxxxxxx --}}
                        <!-- Contact Persons -->
                        <div class="w-full md:w-72 bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Hubungi Kami
                            </h3>
                            <div class="space-y-3">
                                @forelse($store->contactPerson as $cp)
                                    <div class="flex items-center justify-between text-sm group">
                                        <span class="text-gray-600 font-medium">{{ $cp->nama }}</span>
                                        <a href="https://wa.me/{{ $cp->no_telephone }}" target="_blank" class="flex items-center gap-1 text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-2 py-1 rounded-md transition-colors">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                            {{ $cp->no_telephone }}
                                        </a>
                                    </div>
                                @empty
                                    <div class="text-gray-400 text-sm italic">Belum ada kontak.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
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
                                        :rating="$gamelan->average_rating"
                                        :total_ulasan="$gamelan->total_ulasan"
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
                                        :rating="$workshop->average_rating"
                                        :total_ulasan="$workshop->total_ulasan"
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
                                        :rating="$class->average_rating"
                                        :total_ulasan="$class->total_ulasan"
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
