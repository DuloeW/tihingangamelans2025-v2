<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="text-5xl font-markazi font-semibold text-primary">Login</h1>
        TODO: VALIDASI USERNAME.
        <!-- User Name -->
        <div class="mt-6 font-markazi text-primary">
            <x-input-label for="user_name" class="text-xl" :value="__('User Name')" />
            <x-text-input id="user_name" class="block mt-1 w-full text-xl" type="text" name="user_name" :value="old('user_name')" required autofocus autocomplete="user_name" />
            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4 font-markazi">
            <x-input-label for="email" class="text-xl" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full text-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 font-markazi">
            <x-input-label for="password" class="text-xl" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full text-xl"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex justify-between mt-4 font-markazi text-xl">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-primary">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-primary/80 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ms-3 p-20">
                {{ __('Log in') }}
            </x-primary-button>
            <a href="/register">
                <button type="button" class="inline-flex items-center px-6 py-4 bg-secondary border border-primary rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-secondary/90 focus:bg-secondary/90 active:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                    {{ __('Register') }}
                </button>
            </a>
        </div>
    </form>
</x-guest-layout>
