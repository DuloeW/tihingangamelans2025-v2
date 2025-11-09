import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                markazi: ['"Markazi Text"', 'serif'],
            },
            colors: {
                primary: '#331F12',
                boxCatalog: '#F7F2E3',
                logo: '#7A2420',
            },
            backgroundImage: {
                hero: "url('/images/hero-bg.jpg')",
            },
            animation: {
                'infinite-scroll': 'infinite-scroll 25s linear infinite',
            },
            keyframes: {
                'infinite-scroll': {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(-100%)' },
                },
            },
        },
    },

    plugins: [
        forms,
        require('tailwind-scrollbar-hide'),
    ],
};
