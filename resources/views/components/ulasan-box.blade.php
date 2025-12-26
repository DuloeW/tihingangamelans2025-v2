@props([
    'nama' => 'Nino Sanjaya',
    'komentar' => 'Pengalaman yang luar biasa!',
    'gambar' => 'images/ulasan_profile.png',
    'rating' => 5,
])

<div class="min-w-[350px] flex-shrink-0 bg-[#FAF8F3] rounded-2xl shadow-md p-6 border border-[#3A2415]/5 flex flex-col gap-4 hover:shadow-lg transition-all duration-300 group">
    <div class="flex items-center gap-4">
        <div class="relative flex-shrink-0">
            <img class="w-16 h-16 rounded-full object-cover border-2 border-[#3A2415]/10 shadow-sm group-hover:border-[#7A2420]/30 transition-colors" 
                 src="{{ asset('storage/' . $gambar) }}" 
                 alt="{{ $nama }}">
        </div>
        <div>
            <h3 class="text-xl font-bold text-[#3A2415] font-markazi tracking-wide line-clamp-1">{{ $nama }}</h3>
            <div class="flex text-yellow-500 gap-0.5">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
        </div>
    </div>
    
    <div class="relative">
        <svg class="absolute -top-2 -left-1 w-8 h-8 text-[#7A2420]/10 transform rotate-180" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9.55228 16 10 15.5523 10 15V9C10 8.44772 9.55228 8 9 8H5C4.44772 8 4 8.44772 4 9V18C4 19.6569 5.34315 21 7 21H14.017ZM21.017 21L21.017 18C21.017 16.8954 20.1216 16 19.017 16H16C16.5523 16 17 15.5523 17 15V9C17 8.44772 16.5523 8 16 8H12C11.4477 8 11 8.44772 11 9V18C11 19.6569 12.3431 21 14 21H21.017Z"/></svg>
        <p class="text-[#3A2415]/80 text-lg italic leading-relaxed font-markazi pl-6 line-clamp-3">
            "{{ $komentar }}"
        </p>
    </div>
</div>
