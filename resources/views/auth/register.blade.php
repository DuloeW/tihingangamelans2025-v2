<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <h1 class="text-5xl font-markazi font-semibold text-primary">Register</h1>

        <div class="flex justify-between">
            <!-- User_Name -->
            <div class="mt-4">
                <x-input-label for="user_name" :value="__('User Name')" />
                <x-text-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')"
                    required autofocus autocomplete="user_name" />
                <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-between">
            <!-- No Telepon -->
            <div class="mt-4">
                <x-input-label for="no_telephone" :value="__('No Telepon')" />
                <x-text-input id="no_telephone" class="block mt-1 w-full" type="text" name="no_telephone"
                    :value="old('no_telephone')" required autofocus autocomplete="no_telephone" />
                <x-input-error :messages="$errors->get('no_telephone')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="nama" :value="__('Nama')" />
                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')"
                    required autofocus autocomplete="nama" />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
        </div>


        <!-- Jenis Kelamin -->
        <div class="mt-4">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select name="jenis_kelamin" id="jenis_kelamin" class="block mt-1 w-full rounded-lg">
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Alamat Selector  -->
        <div class="mt-4">
            @livewire('alamat-selector', ['layout' => 'register'])
        </div>

        <div class="mt-4">
            <x-input-label for="gambar" :value="__('Profile')" />
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-l-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-800 file:text-white
                    hover:file:bg-gray-700"
                id="file_input" name="gambar" type="file" />

            <p class="mt-1 text-xs text-gray-500">
                PNG, JPG, atau JPEG.
            </p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-primary/80 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
