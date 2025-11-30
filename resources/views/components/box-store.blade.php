@props([
    'nama' => 'Gamelan Name',
    'deskripsi' => 'Gamelan Description',
    'tag_bisnis' => ['tag1', 'tag2', 'tag3'],
    'profile' => 'images/bende1.png',
    'dataAos' => 'fade-up',
    'dataAosDuration' => '1500',
])

<div 
    data-aos="{{ $dataAos }}" 
    data-aos-duration="{{ $dataAosDuration }}"
    class="w-full h-auto mb-10 shadow-lg rounded-lg overflow-hidden bg-boxCatalog">
    <div class="w-auto flex justify-center items-center bg-white py-5">
        <img src="{{ asset($profile) }}" alt="" class="h-40 w-auto object-cover">
    </div>
    <div class="px-10 py-5 h-auto w-full flex flex-col justify-between">
        <div>
            <h2 class="text-3xl font-medium">{{ $nama }}</h2>
            <div>
                @foreach ($tag_bisnis as $tag)
                    <span class="inline-block text-orange-500 tracking-wider text-md rounded-full mr-2 mb-2">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
            <p class="text-xl tracking-wider">{{ $deskripsi }}</p>
        </div>
        <div class="flex mt-5 justify-end items-center">
            <a class="px-6 py-2 bg-primary text-white rounded-lg tracking-wider" href="">
                Selengkapnya
            </a>
        </div>
    </div>
</div>
