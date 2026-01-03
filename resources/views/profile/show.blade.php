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
                         src="{{ asset('storage/' . Auth::user()->gambar) }}" 
                         alt="{{ Auth::user()->nama }}">
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#3E2C22]">{{ Auth::user()->nama }}</h3>
                    <p class="text-[#8C8C8C]">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="mt-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="group">
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Nama</label>
                        <div class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22]">
                            {{ $user->nama }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Username</label>
                        <div class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22]">
                            {{ $user->user_name }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Provinsi</label>
                        <div class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22]">
                            {{ $province_name ?? '-' }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Kabupaten</label>
                        <div class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22]">
                            {{ $city_name ?? 'Not Specified' }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#6B5B50] mb-2">Kecamatan</label>
                        <div class="w-full bg-white border-none rounded-lg py-3 px-4 shadow-sm text-[#3E2C22]">
                             {{ $district_name ?? 'Not Specified' }}
                        </div>
                    </div>

                </div>
                
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">    
                    {{-- CARD 1: EMAIL --}}
                    <div>
                        <h4 class="text-lg font-bold text-[#3E2C22] mb-4">Alamat Email</h4>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            </div>
                            <div>
                                <p class="text-[#3E2C22] font-medium">{{ $user->email }}</p>
                                <p class="text-xs text-gray-400">Registered Account</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold text-[#3E2C22] mb-4">No Telephone</h4>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-100 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[#3E2C22] font-medium">{{ $user->no_telephone ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Registered Phone</p>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="mt-20">
                    <a href="{{ route('profile.edit') }}" 
                       class="bg-[#3E2C22] text-[#F3F1EA] px-10 py-3 rounded-lg font-medium shadow-md hover:bg-opacity-90 transition inline-block text-center">
                        Go to Edit Profile
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>