@php
    $activeRoute = $title ?? '';
    $activeClass = 'text-white bg-primary px-10 py-1 text-center rounded-lg font-medium';
@endphp

<nav class="flex items-center justify-between px-12 py-1 shadow-sm static bg-white top-0 z-50">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo_vektor_02.svg') }}" alt="Logo" class="h-16 w-auto" />
        <h1 class="text-2xl font-markazi tracking-wider">
            <span class="font-bold text-logo">Tihingan</span>
            <span>Gamelans</span>
        </h1>
    </div>

    <div class="flex font-markazi items-center text-xl font-medium gap-10">
        <a class="text-primary {{ request()->is('/') ? $activeClass : '' }} text-xl hover:text-[#7A2C1D] transition"
            href="/">Home</a>
        <a class="text-primary {{ request()->is('gallery-gamelan') ? $activeClass : '' }} hover:text-[#7A2C1D] transition"
            href="/gallery-gamelan">Gallery</a>
        <a class="text-primary {{ request()->is('store') ? $activeClass : ''  }}  hover:text-[#7A2C1D] transition"
            href="/store">Store</a>
        <a class="text-primary {{ request()->is('login') ? $activeClass : ''  }}  hover:text-[#7A2C1D] transition"
            href="{{ route('login') }}">
            Login
        </a>
    </div>

</nav>
