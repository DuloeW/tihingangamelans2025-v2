<div class="space-y-6">
    @forelse($ulasan as $review)
        <div class="bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr($review->nama_pengulas, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">{{ $review->nama_pengulas }}</div>
                        <div class="text-gray-400 text-xs">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="flex text-yellow-400">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" 
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
            </div>
            <p class="text-gray-600 leading-relaxed">{{ $review->komentar }}</p>
        </div>
    @empty
        <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
        </div>
    @endforelse

    <div class="mt-6">
        {{ $ulasan->links() }}
    </div>
</div>
