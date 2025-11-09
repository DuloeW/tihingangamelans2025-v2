<footer class="bg-primary text-white font-markazi px-10 md:px-20 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
        <!-- Kolom 1: Navigasi -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Navigasi</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-yellow-400 transition">Home</a></li>
                <li><a href="#" class="hover:text-yellow-400 transition">Gallery</a></li>
                <li><a href="#" class="hover:text-yellow-400 transition">Store</a></li>
            </ul>
        </div>

        <!-- Kolom 2: Deskripsi -->
        <div class="text-center md:text-left">
            <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
            <p class="text-sm leading-relaxed tracking-wider">
                Gabung bersama kami dan jelajahi jutaan gamelan dari pengerajin terpercaya!  
                Setiap nada, setiap ukiran, adalah warisan budaya yang hidup.
            </p>

            <!-- Ikon Sosial -->
            <div class="flex justify-center md:justify-start gap-5 mt-5">
                <a href="#" class="hover:scale-110 transition">
                    <img src="{{ asset('images/instagram-logo.svg') }}" alt="Instagram Logo" class="h-6 w-6 ">
                </a>
                <a href="#" class="hover:scale-110 transition">
                    <img src="{{ asset('images/youtube-logo.svg') }}" alt="YouTube Logo" class="h-6 w-6">
                </a>
                <a href="#" class="hover:scale-110 transition">
                    <img src="{{ asset('images/telephone-logo.svg') }}" alt="Telephone Logo" class="h-6 w-6">
                </a>
            </div>
        </div>

        <!-- Kolom 3: Map -->
        <div class="flex justify-center md:justify-end">
            <iframe class="rounded-lg shadow-lg"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31565.679682113587!2d115.3631689345516!3d-8.527514004691785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21132054a3c09%3A0x5030bfbca8320b0!2sTihingan%2C%20Kec.%20Banjarangkan%2C%20Kabupaten%20Klungkung%2C%20Bali!5e0!3m2!1sid!2sid!4v1762603691803!5m2!1sid!2sid"
                width="350" height="200" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <!-- Garis pemisah -->
    <div class="border-t border-gray-500 mt-10 pt-4 text-center text-sm">
        &copy; 2025 <span class="text-yellow-400">Tihingan Gamelans</span>. All rights reserved.
    </div>
</footer>
