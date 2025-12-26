@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<x-app-layout>
    <div class="min-h-screen bg-[#F3F1EA] text-[#4B3B30] font-sans pb-20">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <h2 class="text-3xl font-bold text-[#3E2C22]">
                Welcome, {{ explode(' ', Auth::user()->user_name)[0] }}
            </h2>
            <p class="text-[#8C8C8C] text-sm mt-1">{{ now()->format('D, d F Y') }}</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex items-center space-x-5 mb-10">
                <div class="relative">
                    <img class="h-20 w-20 rounded-full border-4 border-white shadow-sm object-cover" 
                    
                         src="{{ asset('storage/' . Auth::user()->gambar) }} " 
    
                         alt="{{ Auth::user()->nama }}">
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#3E2C22]">{{ Auth::user()->nama }}</h3>
                    <p class="text-[#8C8C8C]">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('patch')
                <input type="hidden" name="email" value="{{ $user->email }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="group">
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->nama) }}" required
                            class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] focus:ring-2 focus:ring-[#3E2C22]">
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Username</label>
                        <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}" 
                            class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] focus:ring-2 focus:ring-[#3E2C22]"
                            placeholder="Masukkan username">
                        <x-input-error class="mt-2" :messages="$errors->get('user_name')" />
                    </div>
                    @livewire('alamat-selector', ['layout' => 'profile'])
                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Role</label>
                        <input type="text" value="{{ $user->usertype == '1' ? 'Admin' : 'Customer/Student' }}" readonly
                            class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22] cursor-not-allowed opacity-80">
                    </div>

                </div>
                {{-- GRID WRAPPER UNTUK EMAIL & PHONE --}}
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- CARD 1: MY EMAIL ADDRESS --}}
                    <div>
                        <h4 class="text-lg font-bold text-[#3E2C22] mb-4">My Email Address</h4>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            </div>
                            <div>
                                <p class="text-[#3E2C22] font-medium">{{ $user->email }}</p>
                                <p class="text-xs text-gray-400">1 month ago</p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2: MY PHONE NUMBER (Sekarang sudah input type text agar bisa diedit) --}}
                    <div>
                        <h4 class="text-lg font-bold text-[#3E2C22] mb-4">My Phone Number</h4>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-100 rounded-full text-green-600">
                                {{-- Ikon Telepon --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="w-full">
                                {{-- Input No HP --}}
                                <input type="text" name="no_telephone" value="{{ old('no_telephone', $user->no_telephone) }}" 
                                    class="w-full bg-transparent border-none p-0 text-[#3E2C22] font-medium focus:ring-0 placeholder-gray-400"
                                    placeholder="Add phone number...">
                                <x-input-error class="mt-1" :messages="$errors->get('no_telephone')" />
                            </div>
                        </div>
                    </div>

                </div>



                <div class="flex space-x-4 mt-20">
                    <button>
                        
                        <a href="{{ route('profile.show') }}" class="bg-[#3E2C22] text-[#F3F1EA] px-10 py-3 rounded-lg font-medium shadow-md hover:bg-opacity-90 transition flex items-center justify-center">
                        Cancel / Back
                         </a>
                    </button>

                    <button type="submit" 
                        class="bg-[#3E2C22] text-[#F3F1EA] px-10 py-3 rounded-lg font-medium shadow-md hover:bg-opacity-90 transition">
                        Edit
                    </button>
                </div>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-green-600 mt-4 text-right">Saved.</p>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>