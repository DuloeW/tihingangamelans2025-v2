    @props(['item'])

    @php
        $status = strtolower($item->status);
        $statusColor = match ($status) {
            'unpaid', 'pending' => 'bg-yellow-500 text-white',
            'paid', 'lunas' => 'bg-green-500 text-white',
            'processing', 'diproses' => 'bg-blue-500 text-white',
            'shipped', 'dikirim' => 'bg-purple-500 text-white',
            'completed', 'selesai' => 'bg-green-600 text-white',
            'cancelled', 'batal', 'failed' => 'bg-red-500 text-white',
            default => 'bg-gray-500 text-white',
        };

        $statusLabel = match($status) {
            'unpaid' => 'Belum Bayar',
            'paid' => 'Lunas',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($item->status)
        };
    @endphp

<div class="border rounded-xl overflow-hidden hover:shadow-lg transition bg-white flex flex-col">
    <div class="relative h-48 bg-gray-200">
        @if($item->katalog && $item->katalog->gambar)
            <img src="{{ asset('storage/' . $item->katalog->gambar) }}" class="w-full h-full object-cover">
        @else
            <div class="flex items-center justify-center h-full text-gray-400 text-sm">No Image</div>
        @endif
        <span class="absolute top-2 right-2 px-3 py-1 text-xs font-bold rounded-full shadow-sm {{ $statusColor }}">
            {{ $statusLabel }}
        </span>
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h4 class="font-bold text-gray-800 line-clamp-1 mb-1">{{ $item->katalog->nama ?? 'Item' }}</h4>
        @if($item->nama_grup)
            <p class="text-xs text-indigo-600 font-semibold mb-2 uppercase">Grup: {{ $item->nama_grup }}</p>
        @endif
        <div class="text-sm text-gray-600 mt-auto space-y-1">
            
            {{-- Date/Time Logic --}}
            @if($item->katalog->jenis === 'Gamelan')
                 <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Order: {{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d M Y') }}</span>
                </div>
            @else
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <div class="flex flex-col">
                        <span class="font-medium">
                            {{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('dddd, D MMM Y') : ($item->tgl_mulai_booking ? \Carbon\Carbon::parse($item->tgl_mulai_booking)->isoFormat('dddd, D MMM Y') : '-') }}
                        </span>
                        @if($item->jadwal && isset($item->jadwal->waktu_mulai))
                            <span class="text-xs text-indigo-600 font-bold">
                                Pukul {{ \Carbon\Carbon::parse($item->jadwal->waktu_mulai)->format('H:i') }} WITA
                                -
                                Pukul {{ \Carbon\Carbon::parse($item->jadwal->waktu_selesai)->format('H:i') }} WITA
                            </span>
                        @elseif($item->tgl_mulai_booking && $item->tgl_selesai_booking)
                             <span class="text-xs text-indigo-600 font-bold">
                                Pukul {{ \Carbon\Carbon::parse($item->tgl_mulai_booking)->format('H:i') }} WITA
                                -
                                Pukul {{ \Carbon\Carbon::parse($item->tgl_selesai_booking)->format('H:i') }} WITA
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Quantity Logic --}}
            <div class="flex items-center">
                @if($item->katalog->jenis === 'Gamelan')
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>{{ $item->jumlah ?? 1 }} Unit</span>
                @else
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>{{ $item->jumlah ?? 1 }} Peserta</span>
                @endif
            </div>

            <div class="font-bold text-gray-900 pt-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
            <div class="mt-4">
                @if($item->ulasan)
                    <div class="w-full bg-green-100 text-green-700 py-2 rounded-xl font-semibold text-center border border-green-200">
                        ✓ Sudah Diulas
                    </div>
                @else
                    @livewire('form-ulasan-katalog', ['katalogId' => $item->katalog_id, 'pemesananId' => $item->pemesanan_id], key('review-'.$item->pemesanan_id))
                @endif
            </div>
        </div>
    </div>
</div>
