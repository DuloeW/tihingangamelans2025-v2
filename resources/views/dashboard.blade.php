<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'workshop' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang, ") }} <strong>{{ Auth::user()->nama ?? Auth::user()->name }}</strong>!
                </div>
            </div>

            <div class="mb-6 border-b border-gray-200 flex space-x-6 overflow-x-auto px-2">
                <button @click="activeTab = 'workshop'" 
                        :class="activeTab === 'workshop' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-3 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                    Riwayat Workshop
                </button>
                <button @click="activeTab = 'kelas'" 
                        :class="activeTab === 'kelas' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-3 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                    Riwayat Kelas
                </button>
                <button @click="activeTab = 'gamelan'" 
                        :class="activeTab === 'gamelan' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-3 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                    Pemesanan Gamelan
                </button>
                <button @click="activeTab = 'ulasan'" 
                        :class="activeTab === 'ulasan' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-3 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                    Ulasan Saya
                </button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-[400px]">
                <div class="p-6">

                    <div x-show="activeTab === 'workshop'">
                        @if($workshops->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada riwayat workshop.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($workshops as $item)
                                    <x-dashboard.pemesanan-card :item="$item" />
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div x-show="activeTab === 'kelas'" style="display: none;">
                        @if($classes->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada riwayat kelas.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($classes as $item)
                                    <x-dashboard.pemesanan-card :item="$item" />
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div x-show="activeTab === 'gamelan'" style="display: none;">
                        @if($gamelans->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada pemesanan gamelan.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($gamelans as $item)
                                    <x-dashboard.pemesanan-card :item="$item" />
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div x-show="activeTab === 'ulasan'" style="display: none;">
                        @if($ulasanSaya->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada ulasan yang Anda buat.</div>
                        @else
                            <div class="space-y-4">
                                @foreach($ulasanSaya as $review)
                                    <div class="bg-white border rounded-xl p-6 hover:shadow-md transition">
                                        <div class="flex justify-between items-start">
                                            <div class="flex gap-4">
                                                <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                                    @if($review->katalog && $review->katalog->gambar)
                                                        <img src="{{ asset('storage/' . $review->katalog->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="flex items-center justify-center h-full text-gray-400 text-xs">No Img</div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-800 text-lg">{{ $review->katalog->nama ?? 'Produk Dihapus' }}</h4>
                                                    <div class="flex items-center text-yellow-400 my-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" 
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endfor
                                                        <span class="text-gray-400 text-sm ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-gray-600 mt-2">{{ $review->isi_ulasan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>