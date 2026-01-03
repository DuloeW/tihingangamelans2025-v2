<x-global-layout>
    <x-slot:title>
        Store
    </x-slot:title>

    <section id="store" class="min-h-[480px] px-4 md:px-20 pb-20 font-markazi">
        <div class="container mx-auto">
            <h2 class="text-center text-primary text-4xl md:text-8xl py-10">Store</h2>

            <div class="w-full grid place-items-center">
                <form action="{{ route('store.index') }}" method="GET" class="w-full flex justify-center">
                    <div class="max-w-3xl w-full flex flex-col gap-6">
                        {{-- Search Input --}}
                        <div class="flex flex-col md:flex-row justify-center items-stretch gap-3">
                            <div
                                class="flex-1 flex items-center bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3 md:px-5 md:py-4 focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all duration-300">
                                <x-search-icon class="text-gray-400 w-5 h-5 md:w-6 md:h-6" />
            
                                <input type="text" name="search" placeholder="Cari Toko Kerajinan..." value="{{ $search ?? '' }}"
                                    class="w-full ml-3 md:ml-4 text-base md:text-lg bg-transparent outline-none border-none text-gray-800 placeholder-gray-400 font-sans tracking-wide focus:border-none focus:ring-0" />
                            </div>
            
                            <button type="submit"
                                class="bg-primary text-white rounded-xl shadow-md px-8 py-3 md:py-0 flex items-center justify-center hover:bg-primary/90 active:scale-95 transition-all duration-200 font-medium text-lg tracking-wide">
                                Cari
                            </button>
                        </div>

                        {{-- Filter Buttons --}}
                        <div class="flex flex-wrap justify-center items-center gap-2 md:gap-3">
                            <a href="{{ route('store.index', ['search' => $search ?? '']) }}"
                                class="px-4 py-2 md:px-6 md:py-2.5 rounded-full text-sm md:text-base font-medium transition-all duration-200 border {{ !isset($selectedJenis) || $selectedJenis == '' ? 'bg-primary text-white border-primary shadow-md' : 'bg-white text-primary border-primary/30 hover:border-primary hover:bg-primary/5' }}">
                                Semua
                            </a>
                            @foreach ($jenisOptions ?? [] as $jenis)
                                <a href="{{ route('store.index', ['jenis' => $jenis, 'search' => $search ?? '']) }}"
                                    class="px-4 py-2 md:px-6 md:py-2.5 rounded-full text-sm md:text-base font-medium transition-all duration-200 border {{ isset($selectedJenis) && $selectedJenis == $jenis ? 'bg-primary text-white border-primary shadow-md' : 'bg-white text-primary border-primary/30 hover:border-primary hover:bg-primary/5' }}">
                                    {{ $jenis }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </form>

            </div>

            <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse ($stores as $store)
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
                @empty
                    <div class="col-span-2 text-center py-12">
                        <p class="text-2xl text-gray-500">Tidak ada toko yang ditemukan.</p>
                        @if(isset($search) && $search)
                            <p class="text-gray-400 mt-2">Coba kata kunci pencarian yang berbeda.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-global-layout>
