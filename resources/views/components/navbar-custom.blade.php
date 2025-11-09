<nav class="flex items-center justify-between px-12 py-1 shadow-sm static bg-white top-0 z-50">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo_vektor_02.svg') }}" alt="Logo" class="h-16 w-auto" />
        <h1 class="text-2xl font-markazi tracking-wider">
            <span class="font-bold text-logo">Tihingan</span>
            <span>Gamelans</span>
        </h1>
    </div>

    <div class="flex font-markazi items-center text-xl font-medium gap-10">
        <a href="" class="text-primary text-xl hover:text-[#7A2C1D] transition">Home</a>
        <a href="" class="text-primary hover:text-[#7A2C1D] transition">Gamelan</a>
        <a href="" class="text-primary hover:text-[#7A2C1D] transition">Store</a>
        <a href="{{ route('login') }}"
            class="bg-primary text-white px-10 py-1 text-center rounded-lg font-medium hover:bg-[#7A2C1D] transition">
            Login
        </a>
    </div>

</nav>
