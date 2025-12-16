@props([
    'nama' => 'Gamelan Name',
    'slug' => '',
    'deskripsi' => 'Gamelan Description',
    'showPrice' => false,
    'price' => '$XXX.XX',
    'gambar' => 'images/bende1.png',
    'dataAos' => 'fade-up',
    'dataAosDuration' => '1500',
    'horizontal' => true,
])

@php
    $deskripsi_limit = Str::limit($deskripsi, 150, '...');
@endphp

<div 
    data-aos="{{ $dataAos }}" 
    data-aos-duration="{{ $dataAosDuration }}"
    class="{{ $horizontal == true ? 'flex flex-row w-fit h-auto mb-10 shadow-lg rounded-lg overflow-hidden' : 'w-full h-auto mb-10 shadow-lg rounded-lg overflow-hidden' }} bg-boxCatalog">
    <div class="w-auto flex justify-center items-center bg-white py-5">
        <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $gambar }}" class="h-40 w-auto object-cover">
    </div>
    <div class="px-10 py-5 h-auto {{ $horizontal == true ? 'w-3/5' : 'w-full' }} flex flex-col justify-between">
        <div>
            <h2 class="text-3xl font-medium mb-2">{{ $nama }}</h2>
            <p class="text-xl tracking-wider">{{ $deskripsi_limit }}</p>
        </div>
        <div class="flex mt-5 {{ $showPrice ? 'justify-between' : 'justify-end' }} items-center">
            @if ($showPrice)
                <p class="text-xl font-semibold mt-2">Price: {{ $price }}</p>
            @endif
            <a 
            href="{{ route('gallery-gamelan.detail', ['slug' => $slug]) }}"
            class="px-6 py-2 bg-primary text-white rounded-lg tracking-wider">
                Selengkapnya
            </a>
        </div>
    </div>
</div>
