@php
    $activeRoute = $title ?? '';
    // Minimalist active state: bold text with the logo color (reddish brown)
    $activeClass = 'text-logo font-bold';
    $inactiveClass = 'text-primary font-medium hover:text-logo';
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full bg-[#FDFBF7]/90 backdrop-blur-sm border-b border-[#E5DDBF]/50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 sm:px-12 h-20 flex items-center justify-between">
        {{-- Logo Section --}}
        <a href="/" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo_vektor_02.svg') }}" alt="Logo" class="h-12 w-auto transition-transform duration-300 group-hover:scale-105" />
            <h1 class="text-2xl font-markazi tracking-wide">
                <span class="font-bold text-logo">Tihingan</span><span class="text-primary">Gamelans</span>
            </h1>
        </a>

        {{-- Navigation Links --}}
        <div class="hidden md:flex items-center gap-10 font-markazi text-xl tracking-wide">
            <a class="{{ request()->is('/') ? $activeClass : $inactiveClass }} transition-colors duration-300 relative group" href="/">
                Home
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-logo transition-all duration-300 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
            </a>
            
            <a class="{{ request()->is('gallery-gamelan*') ? $activeClass : $inactiveClass }} transition-colors duration-300 relative group" href="/gallery-gamelan">
                Gallery
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-logo transition-all duration-300 group-hover:w-full {{ request()->is('gallery-gamelan*') ? 'w-full' : '' }}"></span>
            </a>
            
            <a class="{{ request()->is('store*') ? $activeClass : $inactiveClass }} transition-colors duration-300 relative group" href="/store">
                Store
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-logo transition-all duration-300 group-hover:w-full {{ request()->is('store*') ? 'w-full' : '' }}"></span>
            </a>

            @auth
                <a class="{{ request()->is('dashboard') ? $activeClass : $inactiveClass }} transition-colors duration-300 relative group" href="{{ route('dashboard') }}">
                    Dashboard
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-logo transition-all duration-300 group-hover:w-full {{ request()->is('dashboard') ? 'w-full' : '' }}"></span>
                </a>
            @else
                <a class="{{ request()->is('login') ? $activeClass : $inactiveClass }} transition-colors duration-300 relative group" href="{{ route('login') }}">
                    Login
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-logo transition-all duration-300 group-hover:w-full {{ request()->is('login') ? 'w-full' : '' }}"></span>
                </a>
            @endauth
        </div>
            <button
                x-ref="mobileButton"
                @click="open = !open"
                class="md:hidden text-primary focus:outline-none"
            >
                {{-- Icon Hamburger (Muncul saat open == false) --}}
                <svg x-show="close" class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                
                {{-- Icon Close/Silang (Muncul saat open == true) --}}
                <svg x-show="open" x-cloak class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    {{-- Mobile Menu --}}
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.outside="if (!$refs.mobileButton.contains($event.target)) open = false"
            class="md:hidden bg-[#FDFBF7] border-t border-[#E5DDBF]/50 px-6 py-6 space-y-4 font-markazi text-xl shadow-lg absolute w-full left-0"
        >
            <a href="/" class="block text-primary hover:text-logo">Home</a>
            <a href="/gallery-gamelan" class="block text-primary hover:text-logo">Gallery</a>
            <a href="/store" class="block text-primary hover:text-logo">Store</a>

            @auth
                <a href="{{ route('dashboard') }}" class="block text-primary font-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-primary font-bold">Login</a>
            @endauth
    </div>
</nav>
