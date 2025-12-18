<div class="p-6 bg-white shadow rounded-lg mt-10">
    <h3 class="text-xl font-semibold mb-4 text-gray-800">Tulis Ulasan</h3>

    @if (session()->has('message'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-3 mb-4 text-red-700 bg-red-100 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="simpanUlasan">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Rating Bintang</label>
            <select wire:model="skor" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                <option value="3">⭐⭐⭐ (Cukup)</option>
                <option value="2">⭐⭐ (Kurang)</option>
                <option value="1">⭐ (Buruk)</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Komentar</label>
            <textarea wire:model="komentar" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ceritakan pengalaman Anda memesan produk ini..."></textarea>
            @error('komentar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Kirim Ulasan
        </button>
    </form>
</div>