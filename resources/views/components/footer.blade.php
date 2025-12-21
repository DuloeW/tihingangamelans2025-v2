<footer class="bg-primary text-white py-16 border-t border-white/5">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="flex flex-col lg:flex-row justify-between gap-12">
            
            <!-- Brand & Contact -->
            <div class="lg:w-1/3 space-y-6">
                <div>
                    <h2 class="font-markazi text-4xl font-bold text-white mb-2">Tihingan Gamelan</h2>
                    <p class="text-gray-400 text-sm leading-relaxed font-sans max-w-xs">
                        Warisan budaya dalam setiap nada. Jelajahi koleksi gamelan terbaik dari pengerajin Desa Tihingan.
                    </p>
                </div>


                <div class="flex gap-5 pt-2">
                    <a href="#" class="hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('images/instagram-logo.svg') }}" alt="Instagram" class="h-5 w-5" style="filter: invert(68%) sepia(63%) saturate(462%) hue-rotate(354deg) brightness(93%) contrast(88%);">
                    </a>
                    <a href="#" class="hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('images/youtube-logo.svg') }}" alt="YouTube" class="h-5 w-5" style="filter: invert(68%) sepia(63%) saturate(462%) hue-rotate(354deg) brightness(93%) contrast(88%);">
                    </a>
                    <a href="#" class="hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('images/telephone-logo.svg') }}" alt="Contact" class="h-5 w-5" style="filter: invert(68%) sepia(63%) saturate(462%) hue-rotate(354deg) brightness(93%) contrast(88%);">
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="lg:w-1/4">
                <h3 class="font-markazi text-2xl mb-6 text-amber-500">Menu</h3>
                <ul class="space-y-3 font-sans text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Home</a></li>
                    <li><a href="{{ route('gallery-gamelan.index') }}" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Gallery</a></li>
                    <li><a href="{{ route('store.index') }}" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Store</a></li>
                </ul>
            </div>

            <!-- Map -->
            <div class="lg:w-1/3">
                <div class="rounded-xl overflow-hidden bg-white/5 p-1">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31565.679682113587!2d115.3631689345516!3d-8.527514004691785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21132054a3c09%3A0x5030bfbca8320b0!2sTihingan%2C%20Kec.%20Banjarangkan%2C%20Kabupaten%20Klungkung%2C%20Bali!5e0!3m2!1sid!2sid!4v1762603691803!5m2!1sid!2sid"
                        width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-lg grayscale hover:grayscale-0 transition-all duration-500 opacity-80 hover:opacity-100">
                    </iframe>
                </div>
                <div class="mt-4 flex items-start gap-3 text-amber-600 text-xs font-sans">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p>Desa Tihingan, Kec. Banjarangkan,<br>Kabupaten Klungkung, Bali</p>
                </div>
            </div>
        </div>

        <div class="border-t border-amber-900 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-amber-600 text-xs font-sans">
                &copy; {{ date('Y') }} Tihingan Gamelans. All rights reserved.
            </p>
            <div class="flex gap-6 text-xs text-amber-600 font-sans">
                <a href="#" class="hover:text-amber-400 transition-colors">Privacy</a>
                <a href="#" class="hover:text-amber-400 transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>
