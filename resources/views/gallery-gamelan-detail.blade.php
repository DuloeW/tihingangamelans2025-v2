<x-global-layout>
    <x-slot:title>
        {{ $gamelan->nama }} - Gallery Gamelan
    </x-slot:title>

    <!-- Detail Section -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-br from-[#FAF8F3] to-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Column: Image & Audio -->
                    <div class="space-y-6">
                        <div class="inline-block bg-[#3A2415] text-white px-4 py-2 rounded-full text-sm font-semibold"></div>

                        <!-- Gambar Gamelan -->
                        <div class="relative bg-white rounded-xl shadow-lg p-6 overflow-hidden">
                            <img src="{{ asset('storage/' . $gamelan->gambar) }}" 
                                 alt="{{ $gamelan->nama }}"
                                 class="w-full h-auto object-contain rounded-lg">
                        </div>

                        <!-- Audio Player -->
                        @if($gamelan->audio)
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-[#3A2415] mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                </svg>
                                Dengarkan Suara
                            </h3>
                            <audio controls class="w-full">
                                <source src="{{ asset('storage/' . $gamelan->audio) }}" type="audio/mpeg">
                                <source src="{{ asset('storage/' . $gamelan->audio) }}" type="audio/wav">
                                <source src="{{ asset('storage/' . $gamelan->audio) }}" type="audio/ogg">
                                Browser Anda tidak mendukung audio player.
                            </audio>
                        </div>
                        @endif
                    </div>

                    <!-- Right Column: Information -->
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-5xl font-markazi font-bold text-[#3A2415] mb-4">
                                {{ $gamelan->nama }}
                            </h1>
                            <div class="h-1 w-24 bg-[#3A2415] rounded-full mb-6"></div>
                        </div>

                        <div class="prose prose-lg max-w-none">
                            <h3 class="text-2xl font-semibold text-[#3A2415] mb-3">Deskripsi</h3>
                            <p class="text-[#6B5A4A] leading-relaxed">
                                {{ $gamelan->deskripsi }}
                            </p>
                        </div>

                        <!-- Back Button -->
                        <div class="pt-6">
                            <a href="{{ route('gallery-gamelan.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-white border-2 border-[#3A2415] text-[#3A2415] font-semibold rounded-lg hover:bg-[#3A2415] hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali ke Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-global-layout>