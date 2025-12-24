<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Helper PHP untuk Warna & Label --}}
    @php
        function getStatusColor($status) {
            return match(strtolower($status)) {
                'paid', 'lunas', 'completed', 'selesai' => 'bg-green-100 text-green-800 border border-green-200',
                'processing' => 'bg-blue-100 text-blue-800 border border-blue-200',
                'shipped' => 'bg-purple-100 text-purple-800 border border-purple-200',
                'unpaid', 'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                'cancelled', 'batal', 'failed' => 'bg-red-100 text-red-800 border border-red-200',
                default => 'bg-gray-100 text-gray-800 border border-gray-200'
            };
        }
        function getStatusLabel($status) {
            return match(strtolower($status)) {
                'unpaid' => 'Belum Bayar',
                'paid' => 'Lunas',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
                default => ucfirst($status)
            };
        }

        function getFilterCategory($status) {
            return match(strtolower($status)) {
                'unpaid', 'pending' => 'unpaid',
                'paid', 'lunas', 'processing', 'shipped', 'completed', 'selesai' => 'paid',
                'cancelled', 'batal', 'failed' => 'cancel',
                default => 'all'
            };
        }
    @endphp

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
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-h-[400px]">
                <div class="p-6">

                    {{-- Loop Workshop --}}
                    <div x-show="activeTab === 'workshop'">
                        @if($workshops->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada riwayat workshop.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($workshops as $item)
                                    <div class="border rounded-xl overflow-hidden hover:shadow-lg transition bg-white flex flex-col">
                                        <div class="relative h-48 bg-gray-200">
                                            @if($item->katalog && $item->katalog->gambar)
                                                <img src="{{ asset('storage/' . $item->katalog->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-gray-400 text-sm">No Image</div>
                                            @endif
                                            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-bold rounded-full {{ getStatusColor($item->status) }}">
                                                {{ getStatusLabel($item->status) }}
                                            </span>
                                        </div>
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="font-bold text-gray-800 line-clamp-1 mb-1">{{ $item->katalog->nama ?? 'Workshop' }}</h4>
                                            @if($item->nama_grup)
                                                <p class="text-xs text-indigo-600 font-semibold mb-2 uppercase">Grup: {{ $item->nama_grup }}</p>
                                            @endif
                                            <div class="text-sm text-gray-600 mt-auto space-y-1">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    <div class="flex flex-col">
                                                    <span class="font-medium">
                                                     {{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('dddd, D MMM Y') : '-' }}
                                                    </span>
                                                     @if($item->jadwal && isset($item->jadwal->waktu_mulai))
                                                    <span class="text-xs text-indigo-600 font-bold">
                                                     Pukul {{ \Carbon\Carbon::parse($item->jadwal->waktu_mulai)->format('H:i') }} WITA
                                                     -
                                                     Pukul {{ \Carbon\Carbon::parse($item->jadwal->waktu_selesai)->format('H:i') }} WITA
                                                    </span>
                                            @endif
                                            </div>
                                              </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                                    <span>{{ $item->jumlah ?? 1 }} Peserta</span>
                                                </div>
                                                <div class="font-bold text-gray-900 pt-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                                <div>
                                                    <button class="w-full bg-primary text-white py-2 mt-4 rounded-xl font-semibold hover:bg-primary-dark transition">
                                                       Buat Ulasan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Loop Kelas --}}
                    <div x-show="activeTab === 'kelas'" style="display: none;">
                        @if($classes->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada riwayat kelas.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($classes as $item)
                                    <div class="border rounded-xl overflow-hidden hover:shadow-lg transition bg-white flex flex-col">
                                        <div class="relative h-48 bg-gray-200">
                                            @if($item->katalog && $item->katalog->gambar)
                                                <img src="{{ asset('storage/' . $item->katalog->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-gray-400 text-sm">No Image</div>
                                            @endif
                                            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-bold rounded-full {{ getStatusColor($item->status) }}">
                                                {{ getStatusLabel($item->status) }}
                                            </span>
                                        </div>
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="font-bold text-gray-800 line-clamp-1 mb-1">{{ $item->katalog->nama ?? 'Kelas' }}</h4>
                                            @if($item->nama_grup)
                                                <p class="text-xs text-indigo-600 font-semibold mb-2 uppercase">Grup: {{ $item->nama_grup }}</p>
                                            @endif
                                            <div class="text-sm text-gray-600 mt-auto space-y-1">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    <span>{{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('dddd, D MMM Y') : '' }}</span>
                                                    <span class="text-xs text-indigo-600 font-bold">
                                                     Pukul {{ \Carbon\Carbon::parse($item->tgl_mulai_booking)->format('H:i') }} WITA
                                                     -
                                                     Pukul {{ \Carbon\Carbon::parse($item->tgl_selesai_booking)->format('H:i') }} WITA
                                                    </span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                                    <span>{{ $item->jumlah ?? 1 }} Peserta</span>
                                                </div>
                                                <div class="font-bold text-gray-900 pt-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Loop Gamelan --}}
                    <div x-show="activeTab === 'gamelan'" style="display: none;">
                        @if($gamelans->isEmpty())
                            <div class="text-center py-10 text-gray-400">Belum ada pemesanan gamelan.</div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($gamelans as $item)
                                    <div class="border rounded-xl overflow-hidden hover:shadow-lg transition bg-white flex flex-col">
                                        <div class="relative h-48 bg-gray-200">
                                            @if($item->katalog && $item->katalog->gambar)
                                                <img src="{{ asset('storage/' . $item->katalog->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-gray-400 text-sm">No Image</div>
                                            @endif
                                            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-bold rounded-full {{ getStatusColor($item->status) }}">
                                                {{ getStatusLabel($item->status) }}
                                            </span>
                                        </div>
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="font-bold text-gray-800 line-clamp-1 mb-1">{{ $item->katalog->nama ?? 'Gamelan Set' }}</h4>
                                            
                                            <div class="text-sm text-gray-600 mt-auto space-y-1">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    <span>Order: {{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d M Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    {{-- Icon Kotak untuk Gamelan --}}
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                    <span>{{ $item->jumlah ?? 1 }} Unit</span>
                                                </div>
                                                <div class="font-bold text-gray-900 pt-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
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