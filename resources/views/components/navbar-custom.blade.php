@php
    $activeRoute = $title ?? '';
    // Minimalist active state: bold text with the logo color (reddish brown)
    $activeClass = 'text-logo font-bold';
    $inactiveClass = 'text-primary font-medium hover:text-logo';
@endphp

<nav class="sticky top-0 z-50 w-full bg-[#FDFBF7]/90 backdrop-blur-sm border-b border-[#E5DDBF]/50 transition-all duration-300">
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
    </div>
</nav>
